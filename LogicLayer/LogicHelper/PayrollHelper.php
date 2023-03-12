<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class PayrollHelper
{
    public static function GenerateMonthlySalary(OMonthlySalary $ms) : void
    {
        PayrollHelper::ResetMonthlySalary($ms);

        if ($ms->InMonth === NULL)
            $ms->GenerateMessage .= "InMonth is undefined | ";
        if ($ms->FromDate === NULL || $ms->ToDate === NULL)
            $ms->GenerateMessage .= "FromDate, ToDate is undefined | ";
        if ($ms->ExchangeRate == NULL)
            $ms->GenerateMessage .= "Exchange Rate is undefined | ";
        if ($ms->Employment === NULL)
            $ms->GenerateMessage .= "No Employment | ";
        
        if ($ms->GenerateMessage !== "")
            return;

        PayrollHelper::GenerateBasicSalary($ms);
        PayrollHelper::CalculateAllowance($ms);
        PayrollHelper::CalculateBonus($ms);
        PayrollHelper::CalculateDeduction($ms);
        PayrollHelper::CalculateTax($ms);
        PayrollHelper::CalculateMonthlySalary($ms);

        if ($ms->GenerateMessage == "")
            $ms->GenerateMessage = "Success";
    }

    private static function ResetMonthlySalary(OMonthlySalary $ms) : void
    {
        $msID = $ms->ObjectID->ForQuery();
        MonthlySalaryAllowance::PhysicalDelete("MonthlySalaryID = $msID");
        MonthlySalaryBonus::PhysicalDelete("MonthlySalaryID = $msID");
        MonthlySalaryDeduction::PhysicalDelete("MonthlySalaryID = $msID");

        $ms->MonthlySalaryAllowances->Clear();
        $ms->MonthlySalaryBonuses->Clear();
        $ms->MonthlySalaryDeductions->Clear();

        $ms->GenerateMessage = "";
        $ms->BasicSalaryEarned = 0;
        $ms->AllowanceAmount = 0;
        $ms->BonusAmount = 0;
        $ms->DeductionAmount = 0;
        $ms->SalaryAmount = 0;
        $ms->AmountToBeTax = 0;
        $ms->TaxAmount = 0;
        $ms->TaxAmountKH = 0;
    }

    private static function GenerateBasicSalary(OMonthlySalary $ms) : void
    {
        try
        {
            $amount = 0;
    
            $careerList = WorkforceHelper::GetCareerHistoryRange($ms->EmploymentID, $ms->FromDate, $ms->ToDate);
            $totalDay = DateTimeHelper::DayDiff($ms->FromDate, $ms->ToDate) + 1;
            $ms->TotalDay = $totalDay;
            foreach ($careerList as $career)
            {
                $fromDate = $ms->FromDate > $career->EffectiveDate ? $ms->FromDate : $career->EffectiveDate;
                $toDate = ($ms->ToDate < $career->EndDate) || $career->EndDate === null ? $ms->ToDate : $career->EndDate;
                $wkDay = DateTimeHelper::DayDiff($fromDate, $toDate) + 1;
                $prorate = $career->NewSalary * ($wkDay / $totalDay);
                $amount += $prorate;
            }
    
            $ms->BasicSalaryEarned = round($amount, 2);
        }
        catch (Exception)
        {
            $ms->GenerateMessage .= "Error Generate Basic Salary | ";
        }
    }

    private static function CalculateAllowance(OMonthlySalary $ms) : void
    {
        try
        {
            $list = PayrollHelper::GetApplicableAllowance($ms);
            foreach ($list as $item)
            {
                $allowance = MonthlySalaryAllowance::Create();
                $allowance->AllowanceTypeID = $item->AllowanceTypeID;
                $allowance->Amount = $item->Amount;
                $ms->MonthlySalaryAllowances->Add($allowance);
            }

            $ms->AllowanceAmount = $ms->TotalAllowance;
        }
        catch (Exception)
        {
            $ms->GenerateMessage .= "Error Calculate Allowance | ";
        }
    }

    private static function CalculateBonus(OMonthlySalary $ms) : void
    {
        try
        {
            $list = PayrollHelper::GetApplicableBonus($ms);
            foreach ($list as $item)
            {
                $bonus = MonthlySalaryBonus::Create();
                $bonus->BonusTypeID = $item->BonusTypeID;
                $bonus->Amount = $item->Amount;
                $ms->MonthlySalaryBonuses->Add($bonus);
            }

            $ms->BonusAmount = $ms->TotalBonus;
        }
        catch (Exception)
        {
            $ms->GenerateMessage .= "Error Calculate Bonus | ";
        }
    }

    private static function CalculateDeduction(OMonthlySalary $ms) : void
    {
        try
        {
            $list = PayrollHelper::GetApplicableDeduction($ms);
            foreach ($list as $item)
            {
                $deduction = MonthlySalaryDeduction::Create();
                $deduction->DeductionTypeID = $item->DeductionTypeID;
                $deduction->Amount = $item->Amount;
                $ms->MonthlySalaryDeductions->Add($deduction);
            }

            $ms->DeductionAmount = $ms->TotalDeduction;
        }
        catch (Exception)
        {
            $ms->GenerateMessage .= "Error Calculate Deduction | ";
        }
    }

    private static function CalculateTax(OMonthlySalary $ms) : void
    {
        try
        {
            $amounttobetax = $ms->BasicSalaryEarned +
                $ms->AllowanceAmount +
                $ms->BonusAmount -
                $ms->DeductionAmount;
            $ms->AmountToBeTax = $amounttobetax;

            $amounttobetaxkh = $amounttobetax * $ms->ExchangeRate;
            $ms->AmountToBeTaxKH = $amounttobetaxkh;

            $taxamount = 0;
            $taxamountkh = 0;

            $payrollSetting = OPayrollSetting::Current();

            foreach ($payrollSetting->TaxContributions as $contribution)
            {
                if ($contribution->FromAmount <= $amounttobetaxkh && $amounttobetaxkh <= $contribution->ToAmount)
                {
                    $taxamountkh = $amounttobetaxkh * ($contribution->TaxRate / 100) - $contribution->CumulativeDeduction;
                    break;
                }
            }
            
            $taxamountkh = round($taxamountkh, 0);
            $taxamount = round($taxamountkh / $ms->ExchangeRate, 2);

            $ms->TaxAmount = $taxamount;
            $ms->TaxAmountKH = $taxamountkh;
        }
        catch (Exception)
        {
            $ms->GenerateMessage .= "Error Calculate Tax | ";
        }
    }

    private static function CalculateMonthlySalary(OMonthlySalary $ms) : void
    {
        try
        {
            $ms->SalaryAmount = $ms->BasicSalaryEarned +
                $ms->AllowanceAmount +
                $ms->BonusAmount -
                $ms->DeductionAmount -
                $ms->TaxAmount;
        }
        catch (Exception)
        {
            $ms->GenerateMessage .= "Error Calcualte Monthly Salary | ";
        }
    }

    private static function GetApplicableAllowance(OMonthlySalary $ms) : Array
    {
        $result = array();
        $empId = $ms->EmploymentID->ForQuery();
        $qInMonth = DateTimeHelper::ForQuery($ms->InMonth);
        $where = "EmploymentID = $empId
            AND FromMonth <= $qInMonth
            AND (ToMonth IS NULL OR ToMonth >= $qInMonth)
        ";
        $result = Allowance::LoadList($where);
        return $result;
    }

    private static function GetApplicableBonus(OMonthlySalary $ms) : Array
    {
        $result = array();
        $empId = $ms->EmploymentID->ForQuery();
        $qInMonth = DateTimeHelper::ForQuery($ms->InMonth);
        $where = "EmploymentID = $empId
            AND FromMonth <= $qInMonth
            AND (ToMonth IS NULL OR ToMonth >= $qInMonth)
        ";
        $result = Bonus::LoadList($where);
        return $result;
    }

    private static function GetApplicableDeduction(OMonthlySalary $ms) : Array
    {
        $result = array();
        $empId = $ms->EmploymentID->ForQuery();
        $qInMonth = DateTimeHelper::ForQuery($ms->InMonth);
        $where = "EmploymentID = $empId
            AND FromMonth <= $qInMonth
            AND (ToMonth IS NULL OR ToMonth >= $qInMonth)
        ";
        $result = Deduction::LoadList($where);
        return $result;
    }
}

?>
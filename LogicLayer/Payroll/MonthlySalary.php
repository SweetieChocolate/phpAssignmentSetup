<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class MonthlySalary extends DataModel
{
    protected ?UUID $MonthlySalaryGenerateID;
    protected ?MonthlySalaryGenerate $MonthlySalaryGenerate;

    protected ?UUID $EmploymentID;
    protected ?Employment $Employment;

    protected ?DateTime $InMonth;
    protected ?DateTime $FromDate;
    protected ?DateTime $ToDate;
    protected ?float $TotalDay;
    protected ?float $ExchangeRate;

    protected ?string $GenerateMessage;

    protected ?float $BasicSalaryEarned;
    protected ?float $AllowanceAmount;
    protected ?float $BonusAmount;
    protected ?float $DeductionAmount;
    protected ?float $SalaryAmount;

    protected ?float $AmountToBeTax;
    protected ?float $AmountToBeTaxKH;
    protected ?float $TaxAmount;
    protected ?float $TaxAmountKH;

    protected function __construct()
    {
        $this->MonthlySalaryAllowances = DataList::Init("MonthlySalaryAllowance", "MonthlySalaryID");
        $this->MonthlySalaryBonuses = DataList::Init("MonthlySalaryBonus", "MonthlySalaryID");
        $this->MonthlySalaryDeductions = DataList::Init("MonthlySalaryDeduction", "MonthlySalaryID");
    }

    protected DataList $MonthlySalaryAllowances;
    protected DataList $MonthlySalaryBonuses;
    protected DataList $MonthlySalaryDeductions;
}

class OMonthlySalary extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            case "InMonthText":
                return $this->InMonth !== NULL ? DateTimeHelper::ConvertToStringMonth($this->InMonth) : "";
            case "FromDateText":
                return $this->FromDate !== NULL ? DateTimeHelper::ConvertToStringDate($this->FromDate) : "";
            case "ToDateText":
                return $this->ToDate !== NULL ? DateTimeHelper::ConvertToStringDate($this->ToDate) : "";
            case "TotalAllowance":
                return $this->TotalAllowance();
            case "TotalBonus":
                return $this->TotalBonus();
            case "TotalDeduction":
                return $this->TotalDeduction();
            default:
                return parent::__get($name);
        }
    }

    private function TotalAllowance() : float
    {
        $result = 0;
        foreach ($this->MonthlySalaryAllowances as $item)
        {
            if ($item->Amount !== NULL)
                $result += $item->Amount;
        }
        return $result;
    }
    private function TotalBonus() : float
    {
        $result = 0;
        foreach ($this->MonthlySalaryBonuses as $item)
        {
            if ($item->Amount !== NULL)
                $result += $item->Amount;
        }
        return $result;
    }
    private function TotalDeduction() : float
    {
        $result = 0;
        foreach ($this->MonthlySalaryDeductions as $item)
        {
            if ($item->Amount !== NULL)
                $result += $item->Amount;
        }
        return $result;
    }
}

?>
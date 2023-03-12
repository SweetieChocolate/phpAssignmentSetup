<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class MonthlySalaryGenerate extends DataModel
{
    protected ?DateTime $InMonth;
    protected ?DateTime $FromDate;
    protected ?DateTime $ToDate;

    protected ?float $ExchangeRate;

    protected function __construct()
    {
        $this->MonthlySalaries = DataList::Init("MonthlySalary", "MonthlySalaryGenerateID");
    }

    protected DataList $MonthlySalaries;
}

class OMonthlySalaryGenerate extends ODataModel
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
            case "TotalEmployment":
                return count($this->MonthlySalaries);
            case "TotalBasicSalary":
                return $this->TotalBasicSalary();
            case "TotalAllowance":
                return $this->TotalAllowance();
            case "TotalBonus":
                return $this->TotalBonus();
            case "TotalDeduction":
                return $this->TotalDeduction();
            case "TotalTax":
                return $this->TotalTax();
            case "TotalSalary":
                return $this->TotalSalary();
            default:
                return parent::__get($name);
        }
    }

    private function TotalBasicSalary()
    {
        $result = 0;
        foreach ($this->MonthlySalaries as $item)
            $result += $item->BasicSalaryEarned;
        return $result;
    }
    private function TotalAllowance()
    {
        $result = 0;
        foreach ($this->MonthlySalaries as $item)
            $result += $item->AllowanceAmount;
        return $result;
    }
    private function TotalBonus()
    {
        $result = 0;
        foreach ($this->MonthlySalaries as $item)
            $result += $item->BonusAmount;
        return $result;
    }
    private function TotalDeduction()
    {
        $result = 0;
        foreach ($this->MonthlySalaries as $item)
            $result += $item->DeductionAmount;
        return $result;
    }
    private function TotalTax()
    {
        $result = 0;
        foreach ($this->MonthlySalaries as $item)
            $result += $item->TaxAmount;
        return $result;
    }
    private function TotalSalary()
    {
        $result = 0;
        foreach ($this->MonthlySalaries as $item)
            $result += $item->SalaryAmount;
        return $result;
    }
}

?>
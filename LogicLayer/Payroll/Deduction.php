<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class Deduction extends DataModel
{
    protected ?UUID $EmploymentID;
    protected ?Employment $Employment;

    protected ?DateTime $FromMonth;
    protected ?DateTime $ToMonth;
    protected ?UUID $DeductionTypeID;
    protected ?CodeField $DeductionType;
    protected ?float $Amount;
}

class ODeduction extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            case "FromMonthText":
                return $this->FromMonth !== NULL ? DateTimeHelper::ConvertToStringMonth($this->FromMonth) : "";
            case "ToMonthText":
                return $this->ToMonth !== NULL ? DateTimeHelper::ConvertToStringMonth($this->ToMonth) : "";
            default:
                return parent::__get($name);
        }
    }
}

?>
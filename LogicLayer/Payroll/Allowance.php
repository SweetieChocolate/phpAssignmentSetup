<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class Allowance extends DataModel
{
    protected ?UUID $EmploymentID;
    protected ?Employment $Employment;

    protected ?DateTime $FromMonth;
    protected ?DateTime $ToMonth;
    protected ?UUID $AllowanceTypeID;
    protected ?CodeField $AllowanceType;
    protected ?float $Amount;
}

class OAllowance extends ODataModel
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
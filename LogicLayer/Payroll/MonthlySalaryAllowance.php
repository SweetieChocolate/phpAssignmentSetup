<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class MonthlySalaryAllowance extends DataModel
{
    protected ?UUID $MonthlySalaryID;
    protected ?MonthlySalary $MonthlySalary;

    protected ?UUID $AllowanceTypeID;
    protected ?CodeField $AllowanceType;
    protected ?float $Amount;
}

class OMonthlySalaryAllowance extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            default:
                return parent::__get($name);
        }
    }
}

?>
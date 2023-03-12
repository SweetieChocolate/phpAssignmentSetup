<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class MonthlySalaryDeduction extends DataModel
{
    protected ?UUID $MonthlySalaryID;
    protected ?MonthlySalary $MonthlySalary;

    protected ?UUID $DeductionTypeID;
    protected ?CodeField $DeductionType;
    protected ?float $Amount;
}

class OMonthlySalaryDeduction extends ODataModel
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
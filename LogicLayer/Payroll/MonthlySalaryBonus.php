<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class MonthlySalaryBonus extends DataModel
{
    protected ?UUID $MonthlySalaryID;
    protected ?MonthlySalary $MonthlySalary;

    protected ?UUID $BonusTypeID;
    protected ?CodeField $BonusType;
    protected ?float $Amount;
}

class OMonthlySalaryBonus extends ODataModel
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
<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class TaxContribution extends DataModel
{
    protected ?UUID $PayrollSettingID;
    protected ?PayrollSetting $PayrollSetting;

    protected ?float $FromAmount;
    protected ?float $ToAmount;
    protected ?float $TaxRate;
    protected ?float $CumulativeDeduction;
}

class OTaxContribution extends ODataModel
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
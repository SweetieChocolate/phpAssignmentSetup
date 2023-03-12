<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class PayrollSetting extends DataModel
{
    protected function __construct()
    {
        $this->TaxContributions = DataList::Init("TaxContribution", "PayrollSettingID");
    }

    protected DataList $TaxContributions;
}

class OPayrollSetting extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            default:
                return parent::__get($name);
        }
    }

    public static function Current() : OPayrollSetting
    {
        $current = PayrollSetting::Where("1");
        if ($current === NULL)
        {
            $con = new DBConnection();
            $current = PayrollSetting::Create();
            $current->save($con);
            $con->commit();
        }
        return $current;
    }
}

?>
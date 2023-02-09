<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class FunctionRoleDetail extends DataModel
{
    protected UUID $FunctionModuleID;
    protected FunctionModule $FunctionModule;
    protected UUID $RoleModuleID;
    protected RoleModule $RoleModule;
}

class OFunctionRoleDetail extends ODataModel
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
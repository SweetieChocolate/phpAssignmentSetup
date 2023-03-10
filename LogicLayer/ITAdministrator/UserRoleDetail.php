<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class UserRoleDetail extends DataModel
{
    protected ?UUID $UserID;
    protected ?User $User;
    protected ?UUID $RoleModuleID;
    protected ?RoleModule $RoleModule;
}

class OUserRoleDetail extends ODataModel
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
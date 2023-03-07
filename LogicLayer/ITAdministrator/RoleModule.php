<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class RoleModule extends DataModel
{

    protected function __construct()
    {
        $this->FunctionRoleDetails = DataList::Init('FunctionRoleDetail', 'RoleModuleID');
    }

    protected DataList $FunctionRoleDetails;
}

class ORoleModule extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            default:
                return parent::__get($name);
        }
    }

    public static function GetAllRoles(string $_sid) : array
    {
        $roles = array();
        $list = RoleModule::LoadList("1", "ObjectNumber");
        
        foreach ($list as $item)
        {
            $roles[$item->ObjectID->Encrypt($_sid)] = $item->ObjectName;
        }

        return $roles;
    }
}

?>
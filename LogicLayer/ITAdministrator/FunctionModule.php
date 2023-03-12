<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class FunctionModule extends DataModel
{
    protected ?string $Category;
    protected ?string $SubCategory;
    protected ?string $FunctionName;
    protected ?int $DisplayOrder;
    protected ?string $URL;
    protected ?string $SubURL;
    protected ?bool $IsEnable;

    protected function __construct()
    {
        $this->FunctionRoleDetails = DataList::Init('FunctionRoleDetail', 'FunctionModuleID');
    }

    protected DataList $FunctionRoleDetails;
}

class OFunctionModule extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            case "IsEnabledText":
                return $this->Get("IsEnable") == true ? "Yes" : "No";
            default:
                return parent::__get($name);
        }
    }

    public function IsAvailableForThisRole(UUID $roleID) : bool
    {
        foreach ($this->FunctionRoleDetails as $role)
        {
            if ($roleID->EqualUUID($role->RoleModuleID))
            {
                return true;
            }
        }
        return false;
    }

    // load function base on user permission
    public static function GetAvailableFunction(string $userID)
    {
        $user = User::Load($userID);
        if ($user == null)
            return array();

        $functionList = FunctionModule::LoadList("IsEnable = 1", "DisplayOrder ASC");
        if ($user->IsAdministrator)
            return $functionList;

        $availableFunction = array();
        foreach ($functionList as $function)
        {
            foreach ($user->UserRoleDetail as $role)
            {
                if ($function->IsAvailableForThisRole($role->RoleModuleID))
                {
                    array_push($availableFunction, $function);
                    break;
                }
            }
        }

        return $availableFunction;
    }
}

?>
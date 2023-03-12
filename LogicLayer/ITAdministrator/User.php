<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class User extends DataModel
{
    protected ?string $UserName;
    protected ?string $Password;
    protected ?string $UserEmail;
    protected ?bool $IsAdministrator;
    protected ?bool $IsBan;
    protected ?bool $RequirePasswordChange;
    protected ?DateTime $LastLoginTime;
    protected ?UUID $EmploymentID;
    protected ?Employment $Employment;

    protected function __construct()
    {
        $this->UserRoleDetail = DataList::Init('UserRoleDetail', 'UserID');
    }

    protected DataList $UserRoleDetail;
}

class OUser extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            case "IsAdminText":
                return \GlobalConstant\GetYesNo($this->IsAdministrator);
            case "IsBanText":
                return \GlobalConstant\GetYesNo($this->IsBan);
            case "RequirePasswordChangeText":
                return \GlobalConstant\GetYesNo($this->RequirePasswordChange);
            default:
                return parent::__get($name);
        }
    }

    public static function GetUserByUserNamePassword(string $username, string $password) : OUser | null
    {
        $users = User::LoadList("IsBan = 0");
        foreach ($users as $user)
        {
            if ($user->UserName == $username && $user->Password == $password)
            {
                return $user;
            }
        }
        return null;
    }

    public function HasThisRole(UUID $roleID) : bool
    {
        foreach ($this->UserRoleDetail as $role)
        {
            if ($roleID->EqualUUID($role->RoleModuleID))
                return true;
        }
        return false;
    }
}

?>
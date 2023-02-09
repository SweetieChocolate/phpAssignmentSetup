<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class User extends DataModel
{
    protected string $UserName;
    protected string $Password;
    protected string $UserEmail;
    protected bool $IsAdministrator;
    protected bool $IsBan;
    protected bool $RequirePasswordChange;
    protected DateTime $LastLoginTime;
}

class OUser extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
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
}

?>
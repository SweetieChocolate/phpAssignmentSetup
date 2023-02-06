<?php

require_once dirname(__FILE__) . "/../TablesLogic.php";

class User extends DataModel
{
    protected string $UserName;
    protected string $Password;
    protected string $UserEmail;
    protected bool $IsAdministrator;
    protected bool $IsBan;
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
}

?>
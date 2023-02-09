<?php

require_once dirname(__FILE__) . "/../../LogicLayer.php";

class Person extends DataModel
{
    protected string $FamilyName;
    protected string $GivenName;
    protected string $Gender;
    protected string $BirthDay;

    protected function __construct()
    {
        $this->Phones = DataList::Init('PersonPhone', 'PersonID');
    }

    protected DataList $Phones;
}

class OPerson extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            case "FullName":
                return $this->obj->FamilyName . " " . $this->obj->GivenName;
            default:
                return parent::__get($name);
        }
    }
}

?>
<?php

require_once dirname(__FILE__) . "/../../TablesLogic.php";

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

?>
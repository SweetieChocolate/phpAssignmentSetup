<?php

require_once dirname(__FILE__) . "/../../LogicLayer.php";

class Person extends DataModel
{
    protected ?string $FamilyName;
    protected ?string $GivenName;
    protected ?string $Gender;
    protected ?DateTime $BirthDay;

    protected function __construct()
    {
        $this->Phones = DataList::Init('PersonPhone', 'PersonID');
        $this->Emails = DataList::Init('PersonEmail', 'PersonID');
    }

    protected DataList $Phones;
    protected DataList $Emails;
}

class OPerson extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            case "FullName":
                return $this->FullName();
            default:
                return parent::__get($name);
        }
    }

    private function FullName() : string
    {
        $result = "";
        $result .= $this->FamilyName !== NULL ? $this->FamilyName : "";
        $result .= empty($result) ? "" : " ";
        $result .= $this->GivenName !== NULL ? $this->GivenName : "";
        return $result;
    }
}

?>
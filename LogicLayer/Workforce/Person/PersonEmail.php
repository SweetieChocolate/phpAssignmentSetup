<?php

require_once dirname(__FILE__) . "/../../LogicLayer.php";

class PersonEmail extends DataModel
{
    protected ?UUID $PersonID;
    protected ?string $Type;
}

class OPersonEmail extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            case "TypeText":
                return $this->Type !== NULL ? GlobalConstant\ContactType::GetContactTypeText($this->Type) : "";
            default:
                return parent::__get($name);
        }
    }
}

?>
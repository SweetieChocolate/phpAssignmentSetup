<?php

require_once dirname(__FILE__) . "/../../LogicLayer.php";

class PersonPhone extends DataModel
{
    protected UUID $PersonID;
    protected string $Type;
}

class OPersonPhone extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            case "TypeText":
                return GlobalConstant\ContactType::GetContactTypeText($this->Type);
            default:
                return parent::__get($name);
        }
    }
}

?>
<?php

require_once dirname(__FILE__) . "/../../LogicLayer.php";

class PersonPhone extends DataModel
{
    protected string $PersonID;
}

class OPersonPhone extends ODataModel
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
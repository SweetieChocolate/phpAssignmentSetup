<?php

require_once dirname(__FILE__) . "/../../LogicLayer.php";

class PersonEmail extends DataModel
{
    protected UUID $PersonID;
}

class OPersonEmail extends ODataModel
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
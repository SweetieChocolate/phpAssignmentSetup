<?php

class ODataModel
{
    protected $obj;
    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    public function __get($name)
    {
        return $this->obj->$name;
    }

    public function __set($name, $value)
    {
        $this->obj->$name = $value;
    }

    public function toDataModel()
    {
        return $this->obj;
    }
}

?>
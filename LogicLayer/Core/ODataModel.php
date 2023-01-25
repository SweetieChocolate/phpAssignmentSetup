<?php

class ODataModel
{
    public static function GetPropertyValue(ODataModel $item, string $prop) : mixed
    {
        $ps = explode("->", $prop);
        $value = $item;
        foreach ($ps as $p)
        {
            if ($value == null)
                return null;
            $value = $value->$p;
        }
        return $value;
    }

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
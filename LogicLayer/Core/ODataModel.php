<?php

class ODataModel
{
    public static function GetPropertyValue(ODataModel $item, string $prop, string $delimiter = "->") : mixed
    {
        $ps = explode($delimiter, $prop);
        $temp = $item;
        foreach ($ps as $p)
        {
            if ($temp == null)
                return null;
            $temp = $temp->$p;
        }
        return $temp;
    }

    public static function SetPropertyValue(ODataModel $item, string $prop, mixed $value, string $delimiter = "->") : bool
    {
        $ps = explode($delimiter, $prop);
        $count = count($ps);
        $temp = $item;
        for ($i = 0; $i < $count; $i++)
        {
            $p = $ps[$i];
            if ($i == $count - 1)
            {
                $temp->$p = $value;
                return true;
            }
            $temp = $temp->$p;
            if ($temp == null)
                return false;
        }
        return true;
    }

    protected DataModel $obj;
    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    public function __get($name)
    {
        switch($name)
        {
            case "CreatedDateTimeText":
                return $this->obj->CreatedDateTime->format("Y/m/d H:i:s.u");
            case "LastModifiedDateTimeText":
                return $this->obj->LastModifiedDateTime->format("Y/m/d H:i:s.u");
            default:
                return $this->obj->$name;
        }
    }

    public function __set($name, $value)
    {
        $this->obj->$name = $value;
    }

    public function toDataModel() : DataModel
    {
        return $this->obj;
    }

    public function save(DBConnection $connection) : void
    {
        $this->obj->save($connection);
    }

    public function delete(DBConnection $connection) : void
    {
        $this->obj->delete($connection);
    }
}

?>
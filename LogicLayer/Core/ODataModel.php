<?php

class ODataModel
{
    public static function GetPropertyValue(ODataModel $item, string $prop) : mixed
    {
        $delimiter = "->";
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

    public static function SetPropertyValue(ODataModel $item, string $prop, mixed $value) : bool
    {
        $delimiter = "->";
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

    public function IsNew() : bool { return $this->obj->IsNew(); }
    public function IsModified() : bool { return $this->obj->IsModified(); }

    public function Get($name)
    {
        return $this->__get($name);
    }

    public function __get($name)
    {
        switch($name)
        {
            case "CreatedDateTimeText":
                return $this->obj->CreatedDateTime->format("Y/m/d H:i:s");
            case "LastModifiedDateTimeText":
                return $this->obj->LastModifiedDateTime->format("Y/m/d H:i:s");
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

    public function GetPropertyType(string $property) : string
    {
        return $this->obj->GetPropertyType($property);
    }
}

?>
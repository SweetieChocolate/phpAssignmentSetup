<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class DataList extends ArrayObject
{
    public UUID $masterID;
    private string $foreignClassName = "-";
    private string $foreignKey = "-";
    
    private function __construct()
    {
        
    }

    public static function Init(string $foreignClassName, string $foreignKey) : DataList
    {
        if (!is_subclass_of($foreignClassName, 'DataModel'))
            throw new Exception("DataList support class inherit from DataModel only");
        $obj = new DataList();
        $obj->masterID = UUID::New();
        $obj->foreignClassName = $foreignClassName;
        $obj->foreignKey = $foreignKey;
        return $obj;
    }

    public static function InitWithMasterID(UUID $masterID, string $foreignClassName, string $foreignKey) : DataList
    {
        if (!is_subclass_of($foreignClassName, 'DataModel'))
            throw new Exception("DataList support class inherit from DataModel only");
        $obj = new DataList();
        $obj->masterID = $masterID;
        $obj->foreignClassName = $foreignClassName;
        $obj->foreignKey = $foreignKey;
        return $obj;
    }

    public function append(mixed $object): void
    {
        if (!is_subclass_of($object, 'ODataModel'))
            throw new Exception("Appending/Adding to DataList support class inherit from ODataModel only");
        $key = $this->foreignKey;
        $object->$key = $this->masterID;
        parent::append($object);
    }

    public function Add(mixed $object) : void
    {
        $this->append($object);
    }

    public function Reload() : void
    {
        $this->Clear();
        $masterID = UUID::ID_FOR_QUERY($this->masterID);
        $array = $this->foreignClassName::LoadList("$this->foreignKey = $masterID");
        foreach ($array as $a)
        {
            parent::append($a);
        }
    }

    public function CreateNewObject()
    {
        if ($this->foreignClassName == "-" || $this->foreignKey == "-")
            return null;
        $className = $this->foreignClassName;
        $foreignKey = $this->foreignKey;
        $obj = $className::Create();
        $obj->$foreignKey = $this->masterID;
        return $obj;
    }

    public function FindWithUUID(UUID $ObjectID)
    {
        foreach ($this as $o)
        {
            if ($o->IsDeleted == true) continue;
            if ($o->ObjectID->EqualUUID($ObjectID))
            {
                return $o;
            }
        }
        return null;
    }

    public function FindWithID(string $ObjectID)
    {
        foreach ($this as $o)
        {
            if ($o->IsDeleted == true) continue;
            if ($o->ObjectID->EqualString($ObjectID))
            {
                return $o;
            }
        }
        return null;
    }

    public function RemoveWithUUID(UUID $ObjectID)
    {
        foreach ($this as $o)
        {
            if ($o->IsDeleted == true) continue;
            if ($o->ObjectID->EqualUUID($ObjectID))
            {
                $o->IsDeleted = true;
            }
        }
    }

    public function RemoveWithID(string $ObjectID)
    {
        foreach ($this as $o)
        {
            if ($o->IsDeleted == true) continue;
            if ($o->ObjectID->EqualString($ObjectID))
            {
                $o->IsDeleted = true;
            }
        }
    }

    public function Clear()
    {
        foreach ($this as $key => $value)
        {
            parent::offsetUnset($key);
        }
    }
}

?>
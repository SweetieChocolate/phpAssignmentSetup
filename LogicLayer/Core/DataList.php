<?php

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

    public function Refresh() : void
    {
        $masterID = UUID::ID_FOR_QUERY($this->masterID);
        $array = $this->foreignClassName::LoadList("$this->foreignKey = $masterID");
        foreach ($array as $a)
        {
            parent::append($a);
        }
    }
}

?>
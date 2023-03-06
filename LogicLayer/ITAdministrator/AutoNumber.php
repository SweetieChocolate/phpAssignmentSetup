<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

interface IAutoNumber
{

}

class AutoNumber extends DataModel
{
    protected string $ObjectClassType;
    protected string $Format;
    protected int $CurrentNumber;
    protected function __construct()
    {
        
    }

    public static function Create() : OAutoNumber
    {
        $obj = parent::Create();
        $obj->CurrentNumber = 0;
        return $obj;
    }
}

class OAutoNumber extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            case "NumberExample": return sprintf($this->obj->Format, $this->obj->CurrentNumber);
            default:
                return parent::__get($name);
        }
    }

    public function GetNextNumber() : string
    {
        $this->obj->CurrentNumber += 1;
        $number = sprintf($this->obj->Format, $this->obj->CurrentNumber);
        return $number;
    }

    public static function GetAllClassWithAutoNumber() : array
    {
        $classArray = array();
        $classArray[''] = "";
        
        foreach (TablesLogic::$tables as $class)
        {
            $oclass = "O".$class;
            if (is_subclass_of($oclass, "IAutoNumber"))
            {
                $classArray[$oclass] = $class;
            }
        }
        
        return $classArray;
    }
}

?>
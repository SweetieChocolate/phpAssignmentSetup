<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

interface IAutoNumber
{

}

class AutoNumber extends DataModel
{
    protected ?string $ObjectClassType;
    protected ?string $Format;
    protected ?int $CurrentNumber;
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
            case "NumberExample": return $this->NumberExample();
            default:
                return parent::__get($name);
        }
    }

    public function PreSave() : void
    {
        if ($this->obj->IsNew())
        {
            $this->CurrentNumber = 0;
        }
    }

    private function NumberExample() : string
    {
        $result = "";
        if ($this->Format !== NULL && $this->CurrentNumber !== NULL)
            $result = sprintf($this->Format, $this->CurrentNumber);
        return $result;
    }

    public function GetNextNumber() : string
    {
        $result = "";
        if ($this->Format !== NULL && $this->CurrentNumber !== NULL)
        {
            $this->CurrentNumber += 1;
            $result = sprintf($this->Format, $this->CurrentNumber);
        }
        return $result;
    }

    public static function GetAllClassWithAutoNumber() : array
    {
        $classArray = array();
        
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
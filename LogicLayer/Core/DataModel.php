<?php

require_once "Connection.php";
require_once "Helpers/Database.php";
require_once "Helpers/StringHelper.php";
require_once "Helpers/DateTimeHelper.php";
require_once "UUID.php";
require_once "DataList.php";

class DataModel
{
    // private property is work with current class only and will not store to database
    private bool $IsLock = false;
    private bool $IsNew = false;
    public function IsNew() : bool { return $this->IsNew; }

    // every property that need to map with database must be protected
    // default database field
    protected UUID $ObjectID;
    protected string $ObjectNumber = "";
    protected string $ObjectName = "";
    protected string $CreatedBy = "";
    protected string $LastModifiedBy = "";
    protected DateTime $CreatedDateTime;
    protected DateTime $LastModifiedDateTime;
    protected bool $IsDeleted = false;

    // constructor need to be protected or private
    // because property IsNew suppose to automate assign by system
    // initialize the object with ClassName::Create() instead
    // the same rule also apply to child class
    protected function __construct()
    {

    }

    /** Create an DataModel Object with a new ObjectID and Set flag IsNew to true **/
    public static function Create() : DataModel
    {
        $classname = get_called_class();
        $obj = new $classname();
        $obj->IsNew = true;
        $obj->ObjectID = UUID::New();
        $obj->CreatedDateTime = DateTimeHelper::Now();
        $obj->LastModifiedDateTime = DateTimeHelper::Now();
        return $obj;
    }

    /** Load a DataModel Object from DataBase **/
    public static function Load(string $objectID) : DataModel
    {
        $classname = get_called_class();
        $sql = "SELECT * FROM $classname WHERE IsDeleted = 0 AND ObjectID = " . UUID::ID_FOR_QUERY($objectID) . " LIMIT 1;";
        /* load sql select top 1 from database and map every column to the obj below */
        $con = new Connection();
        $result = $con->ExecuteQuery($sql);
        /* map the dataset get from query to obj*/
        $dataModel = new ReflectionClass($classname);
        $pros = $dataModel->getProperties(ReflectionProperty::IS_PROTECTED);
        $obj = new $classname();
        while ($row = $result->fetch_assoc())
        {
            $obj = new $classname();
            foreach ($pros as $pro)
            {
                $pro->setAccessible(true); // only required prior to PHP 8.1.0
                
                $proName = $pro->getName();
                $isInit = isset($row[$proName]);
                $isID = $pro->getType()->getName() == "UUID";
                $isString = $pro->getType()->getName() == "string";
                $isBoolean = $pro->getType()->getName() == "bool";
                $isDateTime = $pro->getType()->getName() == "DateTime";
    
                if (!$isInit) continue;

                $value = $row[$proName];
                if (is_object($value) && !$isID && !$isDateTime) continue;

                if ($isID) $value = UUID::FromBinary($value);
                //if ($isString) $value = $value;
                if ($isBoolean) $value = $value == 1 ? true : false;
                if ($isDateTime) $value = DateTimeHelper::FromString($value);
                
                $pro->setValue($obj, $value);
            }
        }
        return $obj;
    }

    /** Load a list of DataModel Object from DataBase with or without where condition **/
    public static function LoadList(string $where = "1", string $orderby = "CreatedDateTime DESC") : array
    {
        $classname = get_called_class();
        $sql = "SELECT * FROM $classname WHERE IsDeleted = 0 AND $where ORDER BY $orderby ;";
        /* load sql select * from database and map every column to the obj below */
        $con = new Connection();
        $result = $con->ExecuteQuery($sql);
        /* pull every data row from sql to array */
        $dataModel = new ReflectionClass($classname);
        $pros = $dataModel->getProperties(ReflectionProperty::IS_PROTECTED);
        $array = array();
        /* map the dataset get from query to obj*/
        while ($row = $result->fetch_assoc())
        {
            $obj = new $classname();
            foreach ($pros as $pro)
            {
                $pro->setAccessible(true); // only required prior to PHP 8.1.0
                
                $proName = $pro->getName();
                $isInit = isset($row[$proName]);
                $isID = $pro->getType()->getName() == "UUID";
                $isString = $pro->getType()->getName() == "string";
                $isBoolean = $pro->getType()->getName() == "bool";
                $isDateTime = $pro->getType()->getName() == "DateTime";
    
                if (!$isInit) continue;

                $value = $row[$proName];
                if (is_object($value) && !$isID && !$isDateTime) continue;

                if ($isID) $value = UUID::FromBinary($value);
                //if ($isString) $value = $value;
                if ($isBoolean) $value = $value == 1 ? true : false;
                if ($isDateTime) $value = DateTimeHelper::FromString($value);
                
                $pro->setValue($obj, $value);
            }
            array_push($array, $obj);
        }
        return $array;
    }
    
    public function __get($var)
    {
        $classname = get_called_class();
        if (property_exists($classname, $var))
        {
            $reflectionProperty = new ReflectionProperty($classname, $var);
            $type = $reflectionProperty->getType()->getName();
            if (is_subclass_of($type, 'DataModel'))
            {
                $varID = $var."ID";
                if (property_exists($classname, $varID))
                {
                    if (isset($this->$var) && isset($this->$varID))
                    {
                        if ($this->$varID != $this->$var->ObjectID)
                            $this->$var = $type::Load($this->$varID);
                        else if (isset($this->$var))
                            return $this->$var;
                        else return NULL;
                    }
                    else if (isset($this->$varID))
                    {
                        $temp = $type::Load($this->$varID);
                        $this->$var = $temp;
                        return $this->$var;
                    }
                    else return NULL;
                }
                else
                {
                    throw new Exception("Accessing DataModel property $var without $varID property declare");
                }
            }
            else if ($type == 'DataList')
            {
                if (isset($this->$var))
                {
                    if ($this->ObjectID != $this->$var->masterID)
                    {
                        $this->$var->masterID = $this->ObjectID;
                        $this->$var->Refresh();
                    }
                    return $this->$var;
                }
                else
                {
                    throw new Exception("Using '$var' datalist in class $classname without DataList::Init in constructor");
                }
            }
            else return $this->$var;
        }
        else
        {
            throw new Exception("Property '$var' is not exist in class $classname");
        }
    }
    
    public function __set($var, $val) : void
    {
        if ($this->IsLock) {
            throw new Exception("Object is lock, commit the connection and close before assign any new value");
        }
        if ($var == "ObjectID") {
            throw new Exception("ObjectID is suppose to assign by the system");
        }
        $classname = get_called_class();
        if (property_exists($classname, $var))
        {
            $reflectionProperty = new ReflectionProperty($classname, $var);
            //if ($reflectionProperty->isPrivate()) return;
            $type = $reflectionProperty->getType()->getName();
            $reflectionProperty = new ReflectionProperty($classname, $var);
            $type = $reflectionProperty->getType()->getName();
            if (is_subclass_of($type, 'DataModel'))
            {
                $varID = $var."ID";
                if (property_exists($classname, $varID))
                {
                    $this->$var = $val;
                    $this->$varID = $val->ObjectID;
                }
                else
                {
                    throw new Exception("Assigning DataModel property $var without $varID property declare");
                }
            }
            else if ($type == 'DataList')
            {
                throw new Exception("Property with DataList type is not accept any value, use Add() instead");
            }
            else $this->$var = $val;
        }
        else
        {
            throw new Exception("Property '$var' is not exist in class $classname");
        }
    }
    
    public function save(Connection $connection) : void
    {
        if ($this->IsLock) return;
        $this->IsLock = true;
        array_push($connection->object, $this);
    }

    public function delete(Connection $connection) : void
    {
        $this->IsDeleted = true;
        if ($this->IsLock) return;
        $this->IsLock = true;
        array_push($connection->object, $this);
    }
    
    private function GetPropertiesWithValues() : Array
    {
        $dataModel = new ReflectionClass(get_class($this));
        $pros = $dataModel->getProperties(ReflectionProperty::IS_PROTECTED);

        $array = array();

        foreach ($pros as $pro)
        {
            $pro->setAccessible(true); // only required prior to PHP 8.1.0
            
            $proName = $pro->getName();
            $isInit = $pro->isInitialized($this);
            $isID = $pro->getType()->getName() == "UUID";
            $isString = $pro->getType()->getName() == "string";
            $isBoolean = $pro->getType()->getName() == "bool";
            $isDateTime = $pro->getType()->getName() == "DateTime";

            if (!$isInit) continue;
            
            $value = $pro->getValue($this);
            if (is_object($value) && !$isID && !$isDateTime) continue;

            if ($isID)
                $value = "UUID_TO_BIN('{$value->ToString()}')";
            if ($isString) $value = "'$value'";
            if ($isBoolean) $value = $value ? 1 : 0;
            if ($isDateTime) $value = "'" . DateTimeHelper::ConvertToString($value) . "'";
            
            $array[$proName] = $value;
        }
        return $array;
    }

    /** Get Raw Sql command that correspond to the object **/
    public function GenerateRawInsertUpdateSql() : string
    {
        $sql = "";
        $tablename = get_class($this);
        $table = $this->GetPropertiesWithValues();
        if ($this->IsNew)
        {
            $insert = "";
            $values = "";
            
            foreach ($table as $col => $val)
            {
                $insert .= empty($insert) ? $col : ", $col";
                $values .= empty($values) ? $val : ", $val";
            }

            $insert = "INSERT INTO $tablename ($insert)";
            $values = "VALUES ($values)";

            $sql = "$insert $values";
        }
        else
        {
            $update = "";
            
            foreach ($table as $col => $val)
            {
                $set = "$col = $val";
                $update .= empty($update) ? $set : ", $set";
            }

            $sql = "UPDATE $tablename SET $update WHERE ObjectID = " . $table['ObjectID'];
        }
        return "$sql ;";
    }
}

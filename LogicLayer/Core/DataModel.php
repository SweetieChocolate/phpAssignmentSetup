<?php

require_once "Connection.php";
require_once "Helpers/Database.php";
require_once "Helpers/StringHelper.php";
require_once "Helpers/DateTimeHelper.php";
require_once "Helpers/SessionHelper.php";
require_once "UUID.php";
require_once "DataList.php";

require_once dirname(__FILE__) . "/../TablesLogic.php";

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
    public static function Create() : ODataModel
    {
        $user = GetCurrentUser();
        $classname = get_called_class();
        $obj = new $classname();
        $obj->IsNew = true;
        $obj->ObjectID = UUID::New();
        $obj->CreatedDateTime = DateTimeHelper::Now();
        $obj->LastModifiedDateTime = DateTimeHelper::Now();
        if ($user != null)
        {
            $obj->CreatedBy = $user->ObjectName;
            $obj->LastModifiedBy = $user->ObjectName;
        }
        else
        {
            $obj->CreatedBy = "--SYSTEM--";
            $obj->LastModifiedBy = "--SYSTEM--";
        }
        $oClass = "O" . $classname;
        return new $oClass($obj);
    }
    public static function CreateWithID(UUID $ObjectID) : ODataModel
    {
        $classname = get_called_class();
        $obj = new $classname();
        $obj->IsNew = true;
        $obj->ObjectID = $ObjectID;
        $obj->CreatedDateTime = DateTimeHelper::Now();
        $obj->LastModifiedDateTime = DateTimeHelper::Now();
        $oClass = "O" . $classname;
        return new $oClass($obj);
    }

    /** Load a DataModel Object from DataBase **/
    private static function LoadDataModel(string $objectID)
    {
        $classname = get_called_class();
        $sql = "SELECT * FROM $classname WHERE IsDeleted = 0 AND ObjectID = " . UUID::ID_FOR_QUERY($objectID) . " LIMIT 1;";
        /* load sql select top 1 from database and map every column to the obj below */
        $con = new DBConnection();
        $result = $con->ExecuteQuery($sql);
        /* map the dataset get from query to obj*/
        $dataModel = new ReflectionClass($classname);
        $pros = $dataModel->getProperties(ReflectionProperty::IS_PROTECTED);
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
            return $obj;
        }
        return null;
    }
    public static function Load(string $objectID)
    {
        $classname = get_called_class();
        $sql = "SELECT * FROM $classname WHERE IsDeleted = 0 AND ObjectID = " . UUID::ID_FOR_QUERY($objectID) . " LIMIT 1;";
        /* load sql select top 1 from database and map every column to the obj below */
        $con = new DBConnection();
        $result = $con->ExecuteQuery($sql);
        /* map the dataset get from query to obj*/
        $dataModel = new ReflectionClass($classname);
        $pros = $dataModel->getProperties(ReflectionProperty::IS_PROTECTED);
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
            $oClass = "O".$classname;
            return new $oClass($obj);
        }
        return null;
    }
    public static function Where(string $where = "1")
    {
        $classname = get_called_class();
        $sql = "SELECT * FROM $classname WHERE IsDeleted = 0 AND $where LIMIT 1;";
        /* load sql select top 1 from database and map every column to the obj below */
        $con = new DBConnection();
        $result = $con->ExecuteQuery($sql);
        /* map the dataset get from query to obj*/
        $dataModel = new ReflectionClass($classname);
        $pros = $dataModel->getProperties(ReflectionProperty::IS_PROTECTED);
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
            $oClass = "O".$classname;
            return new $oClass($obj);
        }
        return null;
    }

    /** Load a list of DataModel Object from DataBase with or without where condition **/
    public static function LoadList(string $where = "1", string $orderby = "CreatedDateTime DESC") : array
    {
        $classname = get_called_class();
        $sql = "SELECT * FROM $classname WHERE IsDeleted = 0 AND $where ORDER BY $orderby ;";
        /* load sql select * from database and map every column to the obj below */
        $con = new DBConnection();
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
            $oClass = "O".$classname;
            array_push($array, new $oClass($obj));
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
                        {
                            $temp = $type::LoadDataModel($this->$varID);
                            if ($temp == null)
                                return null;
                            $this->$var = $temp;
                        }
                        return $this->$var->toObject();
                    }
                    else if (isset($this->$varID))
                    {
                        $temp = $type::LoadDataModel($this->$varID);
                        if ($temp == null)
                            return null;
                        $this->$var = $temp;
                        return $this->$var->toObject();
                    }
                    else return null;
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
            else if (isset($this->$var)) return $this->$var;
            else return null;
        }
        else
        {
            throw new Exception("Property '$var' is not exist in class $classname");
        }
    }

    public function toObject()
    {
        $classname = get_called_class();
        $oClass = "O".$classname;
        return new $oClass($this);
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
                    $this->$var = $val->toDataModel();
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
    
    public function save(DBConnection $connection) : void
    {
        $user = GetCurrentUser();
        if ($user != null)
        {
            $this->LastModifiedBy = $user->ObjectName;
        }
        else
        {
            $this->LastModifiedBy = "--SYSTEM--";
        }
        $this->LastModifiedDateTime = DateTimeHelper::Now();
        if ($this->IsLock) return;
        $this->IsLock = true;
        array_push($connection->object, $this);
    }

    public function delete(DBConnection $connection) : void
    {
        $this->IsDeleted = true;
        $this->save($connection);
    }

    /** Get Raw Sql command that correspond to the object **/
    public function GenerateRawInsertUpdateSql() : string
    {
        $sql = "";
        $tablename = get_class($this);
        $table = $this->GetPropertiesWithValuesForDB();
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
    
    private function GetPropertiesWithValuesForDB() : Array
    {
        $array = array();
        
        $props = $this->GetPropertiesAsReflectionProperty();

        foreach ($props as $prop)
        {
            $prop->setAccessible(true); // only required prior to PHP 8.1.0
            
            $proName = $prop->getName();
            $isInit = $prop->isInitialized($this);
            $isID = $prop->getType()->getName() == "UUID";
            $isString = $prop->getType()->getName() == "string";
            $isBoolean = $prop->getType()->getName() == "bool";
            $isDateTime = $prop->getType()->getName() == "DateTime";

            if (!$isInit && !$isString) continue;

            if (!$isInit) $value = '';
            else $value = $prop->getValue($this);
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

    private function GetPropertiesAsReflectionProperty() : Array
    {
        $className = get_class($this);
        return DataModel::GetSortedProperties($className);
    }

    private static function GetSortedProperties(string $className) : Array
    {
        $props_arr = array();
        $ref = new ReflectionClass($className);
        if($parentClass = $ref->getParentClass())
        {
            $parent_props = DataModel::GetSortedProperties($parentClass->getName()); //RECURSIVE
    
            if(count($parent_props) > 0)
            {
                $props_arr = array_merge($parent_props, $props_arr);
            }
        }

        $props = $ref->getProperties(ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop)
        {
            if ($prop->class != $className)
                continue;
            array_push($props_arr, $prop);
        }

        return $props_arr;
    }

    /** Get Raw Sql command that correspond to the object for creating or altering table **/
    public function GetDBTableQuery() : string
    {
        $className = get_class($this);
        return DataModel::GetDBTableQueryWithName($className);
    }

    public static function GetDBTableQueryWithName(string $className) : string
    {
        $con = new DBConnection();
        $query = "SHOW TABLE STATUS FROM " . $con->DataBase() . " WHERE Name = '" . $className . "';";
        $result = $con->ExecuteQuery($query);
        if ($result->num_rows < 1)
        {
            return DataModel::GenerateCreateTable($className);
        }
        else
        {
            return DataModel::GenerateAlterTable($className);
        }
    }

    private static function GenerateCreateTable(string $className) : string
    {
        $cols = DataModel::GetPropertiesForDB($className);
        $query = "CREATE TABLE " . $className . " ";
        $columns = "";
        foreach ($cols as $col)
        {
            $colName = $col->getName();
            $colType = DataModel::GetPropertyTypeForDB($col->getType());
            $columns .= empty($columns) ? "$colName $colType NULL" : ", $colName $colType NULL";
        }
        $query = $query . "(" . $columns . ");";
        return $query;
    }

    private static function GenerateAlterTable(string $className)
    {
        $con = new DBConnection();
        $cols = DataModel::GetPropertiesForDB($className);
        $query = "SHOW COLUMNS FROM " . $className . ";";
        $result = $con->ExecuteQuery($query);
        $exists = array();
        while ($row = $result->fetch_assoc())
        {
            array_push($exists, $row['Field']);
        }
        $query = "ALTER TABLE " . $className . " ";
        $columns = "";
        foreach ($cols as $col)
        {
            $colName = $col->getName();
            if (in_array($colName, $exists)) continue;
            $colType = DataModel::GetPropertyTypeForDB($col->getType());
            $columns .= empty($columns) ? "ADD $colName $colType NULL" : ", ADD $colName $colType NULL";
        }
        if (empty($columns)) return "";
        $query = $query . $columns . ";";
        return $query;
    }

    private static function GetPropertiesForDB(string $className) : Array
    {
        $temp = DataModel::GetSortedProperties($className);
        $props = array();
        foreach ($temp as $prop)
        {
            $isID = $prop->getType()->getName() == "UUID";
            $isInt = $prop->getType()->getName() == "int";
            $isFloat = $prop->getType()->getName() == "float";
            $isString = $prop->getType()->getName() == "string";
            $isBoolean = $prop->getType()->getName() == "bool";
            $isDateTime = $prop->getType()->getName() == "DateTime";

            if (
                !$isID &&
                !$isInt &&
                !$isFloat &&
                !$isString &&
                !$isBoolean &&
                !$isDateTime
            )
                continue;

            array_push($props, $prop);
        }
        return $props;
    }

    private static function GetPropertyTypeForDB(string $phpType) : string
    {
        $dbType = "";
        switch ($phpType)
        {
            case "UUID": $dbType = "binary(16)"; break;
            case "float": $dbType = "double"; break;
            case "bool": $dbType = "bit"; break;
            case "string": $dbType = "text"; break;
            case "DateTime": $dbType = "DateTime(6)"; break;
            default: $dbType = $phpType; break;
        }
        return strtoupper($dbType);
    }
}

?>
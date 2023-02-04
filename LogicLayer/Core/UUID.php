<?php

require_once "Connection.php";
require_once "Helpers/StringHelper.php";

class UUID
{
    private string $ID_String;
    private string $ID_Binary;

    private function __construct()
    {
        // $this->ID_String = UUID::NewUUID();
        // $this->ID_Binary = UUID::STRING_TO_BIN($this->ID_String);
    }

    public function __toString() : string
    {
        return $this->ID_String;
    }

    public function ToString() : string
    {
        return $this->ID_String;
    }

    public function ToBinary() : string
    {
        return $this->ID_Binary;
    }

    public static function New() : UUID
    {
        $obj = new UUID();
        $obj->ID_String = UUID::NewUUID();
        $obj->ID_Binary = UUID::STRING_TO_BIN($obj->ID_String);
        return $obj;
    }

    public static function FromString(string $str) : UUID
    {
        $obj = new UUID();
        $obj->ID_String = $str;
        $obj->ID_Binary = UUID::STRING_TO_BIN($obj->ID_String);
        return $obj;
    }

    public static function FromBinary(string $bin) : UUID
    {
        $obj = new UUID();
        $obj->ID_Binary = $bin;
        $obj->ID_String = UUID::BIN_TO_STRING($obj->ID_Binary);
        return $obj;
    }

    private static function NewUUID() : string
    {
        $con = new DBConnection();
        $query = "SELECT UUID() AS NEWID;";
        $result = $con->ExecuteQuery($query);
        if ($result->num_rows < 1)
        {
            throw new Exception("Failed to retrieve new ObjectID from the database");
        }
        while ($row = $result->fetch_assoc())
        {
            $newUUID = $row['NEWID'];
        }
        if (!isset($newUUID))
        {
            throw new Exception("Database return new ObjectID with null value");
        }
        return $newUUID;
    }

    public static function ID_FOR_QUERY(string $id) : string
    {
        return "0x" . str_replace('0x', '', str_replace('-', '', $id));
    }
    
    public static function STRING_TO_BIN($str) : string
    {
        return pack("H*", str_replace('-', '', $str));
    }
    
    public static function BIN_TO_STRING($bin) : string
    {
        if (startsWith($bin, "0x"))
        {
            $str = substr($bin, 2);
            str_replace('-', '', $str);
            $str = preg_replace("/([0-9a-f]{8})([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{12})/", "$1-$2-$3-$4-$5", $str);
            return $str;
        }
        else
        {
            $str = unpack("H*", $bin);
            $str = preg_replace("/([0-9a-f]{8})([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{12})/", "$1-$2-$3-$4-$5", $str);
            return $str[1];
        }
    }
}

?>
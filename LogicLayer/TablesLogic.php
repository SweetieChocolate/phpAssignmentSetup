<?php

require_once "Core/Connection.php";
require_once "Core/DataModel.php";

require_once "Workforce/Employment.php";
require_once "Workforce/Person/Person.php";
require_once "Workforce/Person/PersonPhone.php";

class TablesLogic
{
    public static $tables = [
        "Employment",
        "Person",
        "PersonPhone"
    ];

    public static function GetSynchronizeDB() : string
    {
        $query = "";
        foreach (TablesLogic::$tables as $t)
        {
            $q = DataModel::GetDBTableQueryWithName($t);
            $query .= $q . "\n";
        }
        return $query;
    }

    public static function SynchronizeDB() : string
    {
        try
        {
            $con = new Connection();
            foreach (TablesLogic::$tables as $t)
            {
                $query = DataModel::GetDBTableQueryWithName($t);
                if (empty($query)) continue;
                $con->ExecuteQuery($query);
            }
        }
        catch (Exception e)
        {

        }
        if (empty($query)) return "All Table Synchronize";
        if ($con->ExecuteMultipleQuery($query)) return "All Table Synchronize";
        return "Failed to Synchronize the table";
    }
}

?>
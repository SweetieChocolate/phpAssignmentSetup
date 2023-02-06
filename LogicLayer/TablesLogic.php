<?php

require_once "Core/Connection.php";
require_once "Core/DataModel.php";
require_once "Core/DataList.php";
require_once "Core/UUID.php";
require_once "Core/ODataModel.php";

require_once "ITAdministrator/User.php";
require_once "ITAdministrator/FunctionModule.php";
require_once "ITAdministrator/RoleModule.php";
require_once "ITAdministrator/FunctionRoleDetail.php";

require_once "Workforce/Employment.php";
require_once "Workforce/Person/Person.php";
require_once "Workforce/Person/PersonPhone.php";

class TablesLogic
{
    public static $tables = [
        // IT Administrator
        "User",
        "FunctionModule",
        "RoleModule",
        "FunctionRoleDetail",
        // Workforce
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

    public static function SynchronizeDB() : void
    {
        try
        {
            $con = new DBConnection();
            foreach (TablesLogic::$tables as $t)
            {
                echo "Started Synchronizing table: " . $t . "<br>";
                $query = DataModel::GetDBTableQueryWithName($t);
                if (!empty($query))
                {
                    echo "Executing: <br>" . $query . "<br>";
                    $con->ExecuteQuery($query);
                }
                echo "Finished Synchronizing table: " . $t . "<br><br>";
            }
            echo "All Table Synchronize";
        }
        catch (Exception $e)
        {
            echo "Failed to Synchronize the table with error:<br>";
            echo $e->getMessage();
        }
    }
}

?>
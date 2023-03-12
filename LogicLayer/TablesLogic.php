<?php

require_once "Core/Connection.php";
require_once "Core/DataModel.php";
require_once "Core/DataList.php";
require_once "Core/UUID.php";
require_once "Core/ODataModel.php";

require_once "ITAdministrator/User.php";
require_once "ITAdministrator/UserRoleDetail.php";
require_once "ITAdministrator/FunctionModule.php";
require_once "ITAdministrator/RoleModule.php";
require_once "ITAdministrator/FunctionRoleDetail.php";
require_once "ITAdministrator/CodeField.php";
require_once "ITAdministrator/AutoNumber.php";

require_once "Workforce/Employment.php";
require_once "Workforce/CareerHistory.php";
require_once "Workforce/Person/Person.php";
require_once "Workforce/Person/PersonPhone.php";
require_once "Workforce/Person/PersonEmail.php";

require_once "Payroll/PayrollSetting.php";
require_once "Payroll/TaxContribution.php";
require_once "Payroll/Allowance.php";
require_once "Payroll/Bonus.php";
require_once "Payroll/Deduction.php";
require_once "Payroll/MonthlySalaryGenerate.php";
require_once "Payroll/MonthlySalary.php";
require_once "Payroll/MonthlySalaryAllowance.php";
require_once "Payroll/MonthlySalaryBonus.php";
require_once "Payroll/MonthlySalaryDeduction.php";

class TablesLogic
{
    public static $tables = [
        // IT Administrator
        "User",
        "UserRoleDetail",
        "FunctionModule",
        "RoleModule",
        "FunctionRoleDetail",
        "CodeField",
        "AutoNumber",
        // Workforce
        "Employment",
        "CareerHistory",
        "Person",
        "PersonPhone",
        "PersonEmail",
        // Payroll
        "PayrollSetting",
        "TaxContribution",
        "Allowance",
        "Bonus",
        "Deduction",
        "MonthlySalaryGenerate",
        "MonthlySalary",
        "MonthlySalaryAllowance",
        "MonthlySalaryBonus",
        "MonthlySalaryDeduction"
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
            echo "<h1>All Table Is Being Synchronize</h1>";
            $con = new DBConnection();
            foreach (TablesLogic::$tables as $t)
            {
                echo "<b>Started Synchronizing table: " . $t . "</b><br>";
                $query = DataModel::GetDBTableQueryWithName($t);
                if (!empty($query))
                {
                    echo "Executing: <br>" . $query . "<br>";
                    $con->ExecuteQuery($query);
                }
                echo "<b>Finished Synchronizing table: " . $t . "</b><br><br>";
            }
            echo "<h1>All Table Synchronize</h1>";
        }
        catch (Exception $e)
        {
            echo "Failed to Synchronize the table with error:<br>";
            echo $e->getMessage();
        }
    }
}

?>
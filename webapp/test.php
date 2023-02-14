<?php

session_start();

require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/LogicLayer.php";

for ($i = 0; $i < 100; $i++)
{
    $con = new DBConnection();
    $emp = Employment::Create();
    $emp->Person->FamilyName = "DOV";
    $emp->Person->GivenName = "Ratha";
    $emp->Salary = 500;
    $emp->save($con);
    $con->commit();
}

?>
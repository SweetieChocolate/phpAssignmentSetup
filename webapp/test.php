<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['ISINITIALIZE']))
    exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/TablesLogic.php";

// $emp = Employment::Create();
// $emp->Person->FamilyName = "DOV";
// $emp->Person->GivenName = "Ratha";
// $emp->Salary = 500;

// echo "Inserting new Employment:" . "<br>";
// echo $emp->ObjectID . "<br>";
// echo $emp->Person->FamilyName . "<br>";
// echo $emp->Person->GivenName . "<br>";
// echo $emp->Salary . "<br>";

// $con = new DBConnection();
// $emp->toDataModel()->save($con);
// $con->commit();
// echo "Success";

require_once $_SESSION['PROJECT_ROOTPATH'] . "webapp/web-navigation.php";

?>
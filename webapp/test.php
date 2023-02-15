<?php

session_start();

require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/LogicLayer.php";

$emp = Employment::Create();
$emp->Person->FamilyName = "DOV";
$emp->Person->GivenName = "Ratha";
$emp->Salary = 500;
echo serialize($emp);

?>
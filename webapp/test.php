<?php

session_start();

require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/LogicLayer.php";

$con = new DBConnection();
$emp = Employment::Create();
$emp->save($con);
$con->commit();

?>
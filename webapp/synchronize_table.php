<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['ISINITIALIZE']))
    exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/TablesLogic.php";

TablesLogic::SynchronizeDB();

?>
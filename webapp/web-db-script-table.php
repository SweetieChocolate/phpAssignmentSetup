<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['ISINITIALIZE']))
    exit();


$_whitelist = array("127.0.0.1", "::1");
if (!in_array($_SERVER['REMOTE_ADDR'], $_whitelist))
    return;

require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/TablesLogic.php";

TablesLogic::SynchronizeDB();

?>
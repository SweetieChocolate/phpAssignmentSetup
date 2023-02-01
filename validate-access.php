<?php

if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
$valid = true;
if (!isset($_SESSION["USERID"]))
    $valid = false;

if (!$valid)
    header("Location: " . $_SESSION['ROOTURI'] . "deny.php");

$uri = $_SERVER['REQUEST_URI'];

// in db -> function table will have url with ~/test.php
// uri will get phpAssignmentSetup/webapp/test.php
// we will select function from db that has the same url as uri
// remember to replace "~/" with $_SESSION['ROOTURI']
// so that it will find the function correctly

?>
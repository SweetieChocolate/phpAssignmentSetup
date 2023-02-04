<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['ISINITIALIZE']))
    exit();

$sid = session_id();
$valid = true;
if (!isset($_SESSION["USERID"]))
    $valid = false;

if (!$valid)
{
    header("Location: " . $_SESSION['WEB_ROOTURL_SERVER'] . "deny.php");
    //header("Location: " . $_SESSION['WEB_ROOTURL_LOCAL'] . "deny.php");
}

$uri = $_SERVER['REQUEST_URI'];

if (basename($uri) == "home.php")
    return;

// in db -> function table will have url with ~/test.php
// uri will get phpAssignmentSetup/webapp/test.php
// we will select function from db that has the same url as uri
// remember to replace "~/" with $_SESSION['WEBROOTURL_LOCAL']
// so that it will find the function correctly

?>
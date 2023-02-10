<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['ISINITIALIZE']))
    exit();

function RedirectDeny()
{
    //header("Location: " . $_SESSION['WEB_ROOTURL_SERVER'] . "deny.php");
    header("Location: " . $_SESSION['WEB_ROOTURL_LOCAL'] . "deny.php");
}

$sid = session_id();

if (!isset($_SESSION["USERID"])) RedirectDeny();

$uri = strtok($_SERVER['REQUEST_URI'], '?');

if ($requestURI == $_SESSION['HOME_PAGE'])
    return;

$user = User::Load($userID);
if ($user == null) RedirectDeny();

if ($user->IsAdministrator) return;

// in db -> function table will have url with ~/test.php
// uri will get phpAssignmentSetup/webapp/test.php
// we will select function from db that has the same url as uri
// remember to replace "~/" with $_SESSION['WEBROOTURL_LOCAL']
// so that it will find the function correctly

//$valid = false;
if (!$valid && !$user->IsAdministrator)
{
    header("Location: " . $_SESSION['WEB_ROOTURL_LOCAL'] . "deny.php");
}

?>
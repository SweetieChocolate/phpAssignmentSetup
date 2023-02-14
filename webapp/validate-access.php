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

$_sid = session_id();

if (!isset($_SESSION['USERID'])) RedirectDeny();

$_uri = strtok($_SERVER['REQUEST_URI'], '?');

if ($_requestURI == $_SESSION['HOME_PAGE'])
    return;

$_user = User::Load(StringDecryption($_SESSION['USERID'], $_sid));
if ($_user == null) RedirectDeny();

if ($_user->IsAdministrator) return;

// in db -> function table will have url with ~/test.php
// uri will get phpAssignmentSetup/webapp/test.php
// we will select function from db that has the same url as uri
// remember to replace "~/" with $_SESSION['WEBROOTURL_LOCAL']
// so that it will find the function correctly
// return if user have access to the function else it will redirect to page deny

header("Location: " . $_SESSION['WEB_ROOTURL_LOCAL'] . "deny.php");

?>
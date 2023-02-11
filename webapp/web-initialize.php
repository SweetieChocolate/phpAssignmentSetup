<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

$_SESSION['COMPANY_NAME'] = "phpAssignmentSetup";
$_SESSION['PROJECT_FOLDER'] = "/" . $_SESSION['COMPANY_NAME'] . "/";
$_SESSION['PROJECT_ROOTPATH'] = $_SERVER['DOCUMENT_ROOT'] . $_SESSION['PROJECT_FOLDER'];
$_SESSION['WEB_ROOTURL_LOCAL'] = $_SESSION['PROJECT_FOLDER'] . "webapp/";
$_SESSION['WEB_ROOTPATH'] = $_SERVER['DOCUMENT_ROOT'] . $_SESSION['WEB_ROOTURL_LOCAL'];
$_SESSION['HOME_PAGE'] = $_SESSION['WEB_ROOTURL_LOCAL'] . "home.php";
$_SESSION['NULL_TEXT'] = "NA";

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $_rooturl = "https";
else
    $_rooturl = "http";
$_rooturl .= "://";
$_rooturl .= $_SERVER['HTTP_HOST'];

$_SESSION['WEB_ROOTURL_SERVER'] = $_rooturl . $_SESSION['WEB_ROOTURL_LOCAL'];

$_SESSION['EDIT_BUTTON'] = "bx bxs-edit-alt";

$_SESSION['ISINITIALIZE'] = true;

?>
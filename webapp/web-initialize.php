<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

$_SESSION['PROJECT_FOLDER'] = "/phpAssignmentSetup/";
$_SESSION['PROJECT_ROOTPATH'] = $_SERVER['DOCUMENT_ROOT'] . $_SESSION['PROJECTFOLDER'];
$_SESSION['WEB_ROOTURL_LOCAL'] = $_SESSION['PROJECTFOLDER'] . "webapp/";
$_SESSION['WEB_ROOTPATH'] = $_SERVER['DOCUMENT_ROOT'] . $_SESSION['WEBROOTURL_LOCAL'];
$_SESSION['HOME_PAGE'] = $_SESSION['WEBROOTURL_LOCAL'] . "home.php";

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $rooturl = "https";
else
    $rooturl = "http";
$rooturl .= "://";
$rooturl .= $_SERVER['HTTP_HOST'];

$_SESSION['WEB_ROOTURL_SERVER'] = $rooturl . $_SESSION['WEBROOTURL_LOCAL'];

$_SESSION['ISINITIALIZE'] = true;

?>
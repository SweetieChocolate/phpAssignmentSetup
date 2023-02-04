<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

$_SESSION['PROJECTFOLDER'] = "/phpAssignmentSetup/";
$_SESSION['PROJECTROOTPATH'] = $_SERVER['DOCUMENT_ROOT'] . $_SESSION['PROJECTFOLDER'];
$_SESSION['WEBROOTURL_LOCAL'] = $_SESSION['PROJECTFOLDER'] . "webapp/";
$_SESSION['WEBROOTPATH'] = $_SERVER['DOCUMENT_ROOT'] . $_SESSION['WEBROOTURL_LOCAL'];

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $rooturl = "https";
else
    $rooturl = "http";
$rooturl .= "://";
$rooturl .= $_SERVER['HTTP_HOST'];

$_SESSION['WEBROOTURL_SERVER'] = $rooturl . $_SESSION['WEBROOTURL_LOCAL'];

$_SESSION['ISINITIALIZE'] = true;

?>
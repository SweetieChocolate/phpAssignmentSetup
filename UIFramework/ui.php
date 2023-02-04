<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['ISINITIALIZE']))
    exit();

require_once $_SESSION['WEB_ROOTPATH'] . "validate-access.php";
require_once "UIHelper.php";
require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/TablesLogic.php";

$sid = session_id();

// $tmpdir = $_SESSION['PROJECT_ROOTPATH'] . "tmp/" . $sid . "/";
// $tmpdir = $_SESSION['WEB_ROOTPATH'] . "tmp/" . $sid . "/";
$tmpdir = session_save_path() . "/" . $sid . "/";
if (!is_dir($tmpdir))
{
    if (!mkdir($tmpdir, 0777, true))
    {
        //echo "failed to make directory $tmpdir \n";
        exit();
    }
}

$action = $_GET['ACTION'];

$requestURI = strtok($_SERVER['REQUEST_URI'], '?');
$path = $_SERVER['DOCUMENT_ROOT'] . $requestURI;
$dom = new DOMDocument();
$dom->formatOutput = true;
$dom->load($path, LIBXML_NOEMPTYTAG);
$domXPath = new DOMXPath($dom);

// ALL UI FRAMEWORK MUST START HERE

$nulltext = $_SESSION['NULL_TEXT'];

// MANIPULATE DATA

require_once "gridview.php";

// xpath query element with id
// $ele = $xpath->query("//*[@id='id_here']")->item(0);




// ALL UI FRAMEWORK MUST END HERE



// store raw html into a string
$result = $dom->saveXML($dom->documentElement, LIBXML_NOEMPTYTAG);
$result = str_replace("</br>", "", $result);

// save the result html to a temp file
$tmpfile = substr(str_replace("/", "_", $requestURI), 1);
$filepath = $tmpdir . $tmpfile;
file_put_contents($filepath, $result);
include($filepath);

// exit to prevent the code in main file being execute
// because the action if view only not edit the information
if ($action == "VIEW")
    exit();

header("Location: $requestURI" . "?ACTION=VIEW");

?>
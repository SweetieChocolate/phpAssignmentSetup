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

$path = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];
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

// there is two ways to output the result

// 1. using echo will not run the php script inside html tag
// 2. using include will run the php script inside html tag
//    using include will need the save the result into a temp file first

// first method
// echo $result;

// second method
// save the result html to a temp file
$tmpfile = substr(str_replace("/", "_", $_SERVER['REQUEST_URI']), 1);
$filepath = $tmpdir . $tmpfile;
file_put_contents($filepath, $result);
include($filepath);

// exit to prevent the code below being execute
// because everything already print out at this point
exit();

?>
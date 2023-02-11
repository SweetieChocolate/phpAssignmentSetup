<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['ISINITIALIZE']))
    exit();

require_once "UIHelper.php";
require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/LogicLayer.php";

$_sid = session_id();

// $_tmpdir = $_SESSION['PROJECT_ROOTPATH'] . "tmp/" . $_sid . "/";
// $_tmpdir = $_SESSION['WEB_ROOTPATH'] . "tmp/" . $_sid . "/";
$_tmpdir = session_save_path() . "/" . $_sid . "/";
if (!is_dir($_tmpdir))
{
    if (!mkdir($_tmpdir, 0777, true))
    {
        //echo "failed to make directory $_tmpdir \n";
        exit();
    }
}

$_requestURI = strtok($_SERVER['REQUEST_URI'], '?');
$_requestFileName = basename($_requestURI);

if ($_requestURI != $_SESSION['HOME_PAGE'])
    require_once $_SESSION['WEB_ROOTPATH'] . "validate-access.php";

$_path = $_SERVER['DOCUMENT_ROOT'] . $_requestURI;
$_dom = new DOMDocument();
$_dom->formatOutput = true;
$_dom->load($_path, LIBXML_NOEMPTYTAG);
$_domXPath = new DOMXPath($_dom);

if (!isset($_GET['ACTION']) && $_requestURI != $_SESSION['HOME_PAGE'])
    header("Location: $_requestURI" . "?ACTION=VIEW");

// ALL UI FRAMEWORK MUST START HERE

// xpath query element with id
// $_ele = $_xpath->query("//*[@id='id_here']")->item(0);

$_action = GetAndUnsetGET('ACTION');
$_button = GetAndUnsetPOST('BUTTON');

$_forms = $_domXPath->query("//form");
foreach ($_forms as $_form)
{
    $_formaction = GetAttribute($_form, "id");
    if ($_formaction != $_action)
    {
        RemoveSelfNode($_form);
    }
}
$_forms = $_domXPath->query("//form");
if ($_forms->length <= 0) exit();

$_basetablename = '';
$_basetablename = GetAttribute($_forms->item(0), "BaseTableName");
if ($_basetablename == null) $_basetablename = '';

$_datakeyEncrypted = isset($_GET['DATAKEY']) ? $_GET['DATAKEY'] : '';
$_datakey = $_datakeyEncrypted != '' ? StringDecryption($_datakeyEncrypted, $_sid) : '';

$_nulltext = $_SESSION['NULL_TEXT'];

require_once "ui-function.php";

?>
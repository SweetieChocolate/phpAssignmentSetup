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

// action on this page
// action get by $_GET
// map with id of the form
$_action = GetAndUnsetGET('ACTION');
$_button = GetAndUnsetPOST('BUTTON');
$_isPendingDelete = false;
if ($_action == 'DELETE')
{
    $_isPendingDelete = true;
    $_action = 'VIEW';
}

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
$_basetablename = $_basetablename ?? '';

$_datakeyEncrypted = isset($_GET['DATAKEY']) ? $_GET['DATAKEY'] : '';
$_datakey = $_datakeyEncrypted != '' ? StringDecryption($_datakeyEncrypted, $_sid) : '';

if ($_isPendingDelete)
{
    if ($_basetablename != '' && $_datakey != '')
    {
        $_object = $_basetablename::Load($_datakey);
        if ($_object != null)
        {
            $_con = new DBConnection();
            $_object->delete($_con);
            $_con->commit();
            header("Location: $_requestURI" . "?ACTION=VIEW");
        }
    }
}

$_formedit = $_domXPath->query("//form[@id='EDIT']")->item(0);

$_nulltext = $_SESSION['NULL_TEXT'];

$_cookiename = str_replace(".", "", substr(str_replace("/", "_", $_tmpdir . $_requestURI), 1));

require_once "ui-function.php";

?>
<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['ISINITIALIZE']))
    exit();

require_once "UIHelper.php";
require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/LogicLayer.php";

$_sid = session_id();
$sessionId = $_sid;

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

$_requestURIWithGetVar = $_SERVER['REQUEST_URI'];
$_requestURI = strtok($_requestURIWithGetVar, '?');
$_requestFileName = basename($_requestURI);

if ($_requestURI != $_SESSION['HOME_PAGE'])
    require_once $_SESSION['WEB_ROOTPATH'] . "validate-access.php";

$_path = $_SERVER['DOCUMENT_ROOT'] . $_requestURI;
$_dom = new DOMDocument();
$_dom->formatOutput = true;
$_dom->load($_path, LIBXML_NOEMPTYTAG);
$_domXPath = new DOMXPath($_dom);
$_head = $_domXPath->query("//head")->item(0);
$_body = $_domXPath->query("//body")->item(0);

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
    if ($_formaction != $_action && $_form->parentNode != null && $_form->parentNode->nodeName == "body")
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
$_methodName = array();

$_editDefaultBtn = <<<RAW
<button type="submit" class="btn btn-primary" name="BUTTON" value="Save">Save</button>
<button type="submit" class="btn btn-primary" name="BUTTON" value="SaveClose">Save and Close</button>
<button type="submit" class="btn btn-primary" name="BUTTON" value="Close">Close</button>
<br />
RAW;

if ($_formedit != null)
{
    $_methodName['Save'] = GetAttribute($_formedit, "Save");
    $_rawSource = new DOMDocument();
    $_rawSource->loadHTML($_editDefaultBtn);
    $_btn = $_dom->importNode($_rawSource->documentElement, true);
    if ($_form->firstChild != null)
        $_formedit->insertBefore($_btn, $_form->firstChild);
    else
        $_formedit->appendChild($_btn);
}

$_nulltext = $_SESSION['NULL_TEXT'];
$_deleteConfirmMsg = $_SESSION['DELETE_MESSAGE'];
$_buttonWidth = $_SESSION['BUTTON_WIDTH_SIZE'];
$_editButton = $_SESSION['EDIT_BUTTON'];
$_deleteButton = $_SESSION['DELETE_BUTTON'];

$_sessionname = str_replace(".", "", substr(str_replace("/", "_", $_tmpdir . $_requestURI), 1));

if ($_action == 'VIEW')
{
    if (isset($_SESSION[$_sessionname])) unset($_SESSION[$_sessionname]);
}

require_once "ui-function.php";

?>
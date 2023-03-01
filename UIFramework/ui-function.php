<?php

function GetCurrentObject()
{
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_sessionname, $_datakeyEncrypted, $_datakey;
    return isset($_SESSION[$_sessionname]) ? unserialize($_SESSION[$_sessionname]) : null;
}

if ($_datakey == '' && $_datakeyEncrypted == '')
{
    $_object = GetCurrentObject();
    if ($_object != null)
    {
        $_datakey = $_object->ObjectID;
        $_datakeyEncrypted = $_object->ObjectID->Encrypt($_sid);
    }
}

function BindFormToObject()
{
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_sessionname, $_datakeyEncrypted, $_datakey;
    $_bindProps = array();
    foreach ($_POST as $_key => $_value)
    {
        if (str_starts_with($_key, "->"))
        {
            $_bindProps[substr($_key, 2)] = $_value;
        }
    }
    $_object = GetCurrentObject();
    if ($_object == null) return null;
    foreach ($_bindProps as $_key => $_value)
    {
        ODataModel::SetPropertyValue($_object, $_key, $_value);
    }
    $_SESSION[$_sessionname] = serialize($_object);
    return $_object;
}

function BindObjectToForm($_objectSource)
{
    if ($_objectSource == null) return;
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_sessionname, $_datakeyEncrypted, $_datakey;
    $_SESSION[$_sessionname] = serialize($_objectSource);
    foreach ($_formedit->ownerDocument->getElementsByTagName("input") as $_prop)
    {
        $_name = GetAttribute($_prop, "name");
        if (!str_starts_with($_name, "->") || $_prop->parentNode !== $_formedit) continue;
        $_value = ODataModel::GetPropertyValue($_objectSource, substr($_name, 2));
        $_value = $_value ?? '';
        $_prop->setAttribute("value", $_value);
    }
}

function BindFormToObject_OTM()
{
    $_bindProps = array();
    foreach ($_POST as $_key => $_value)
    {
        if (str_starts_with($_key, "->"))
        {
            $_bindProps[substr($_key, 2)] = $_value;
        }
    }
    $_object = GetCurrentObject();
    if ($_object == null) return null;
    // it will have id and property when submit from form
    // check if id exist or not, if not create new, else bind submitted info to existing object
    // after binding return the child object
}

function BindObjectToForm_OTM($_objectSource, $_formModal)
{
    if ($_objectSource == null) return;
    $_formResult = $_formModal->cloneNode(true);
    foreach ($_formResult->ownerDocument->getElementsByTagName("input") as $_prop)
    {
        $_name = GetAttribute($_prop, "name");
        if (!str_starts_with($_name, "->") || $_prop->parentNode !== $_formResult) continue;
        $_value = ODataModel::GetPropertyValue($_objectSource, substr($_name, 2));
        $_value = $_value ?? '';
        $_prop->setAttribute("value", $_value);
    }
    return $_formResult;
}

function RefreshPage(bool $_loadFromDb = false)
{
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_sessionname, $_datakeyEncrypted, $_datakey;
    if ($_loadFromDb && isset($_SESSION[$_sessionname])) unset($_SESSION[$_sessionname]);
    $_getdatakey = urlencode($_datakeyEncrypted);
    header("Location: $_requestURI" . "?ACTION=EDIT&DATAKEY=$_getdatakey");
}

function ClosePage()
{
    global $_sid, $_requestURI, $_formedit, $_basetablename;
    header("Location: $_requestURI");
}

$_rawPopUpTop = <<<RAW
<div class="modal fade" id="[ID]]" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="" method="post">
RAW;
$_rawPopUpBot = <<<RAW
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="BUTTON" value="Save">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
RAW;
function GeneratePopUpForm(DOMNode $_sourceForm)
{
    $_sourceDocument = $_sourceForm->ownerDocument;
    global $_rawPopUpTop, $_rawPopUpBot;
    $_rawPopUp = $_rawPopUpTop . $_sourceDocument->saveXML($_sourceDocument->documentElement, LIBXML_NOEMPTYTAG) . $_rawPopUpBot;
    $_domDocument = new DOMDocument();
    $_domDocument->loadXML($_rawPopUp, LIBXML_NOEMPTYTAG);
    return $_domDocument->documentElement;
}

?>
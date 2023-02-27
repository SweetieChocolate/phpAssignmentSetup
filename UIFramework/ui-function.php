<?php

function GetCurrentObject()
{
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_sessionname, $_datakeyEncrypted, $_datakey;
    return isset($_SESSION[$_sessionname]) ? unserialize($_SESSION[$_sessionname]) : null;
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

?>
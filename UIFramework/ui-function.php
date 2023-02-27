<?php

function BindFormToObject()
{
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_cookiename, $_datakeyEncrypted, $_datakey, $_object;
    $_bindProps = array();
    foreach ($_POST as $_key => $_value)
    {
        if (str_starts_with($_key, "->"))
        {
            $_bindProps[substr($_key, 2)] = $_value;
        }
    }
    if ($_object == null) return null;
    foreach ($_bindProps as $_key => $_value)
    {
        ODataModel::SetPropertyValue($_object, $_key, $_value);
    }
    $_SESSION[$_cookiename] = serialize($_object);
    //setcookie($_cookiename, serialize($_object), time() + 60*60*24);
    return $_object;
}

function BindObjectToForm($_object)
{
    if ($_object == null) return;
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_cookiename, $_datakeyEncrypted, $_datakey, $_object;
    $_SESSION[$_cookiename] = serialize($_object);
    //setcookie($_cookiename, serialize($_object), time() + 60*60*24);
    foreach ($_formedit->ownerDocument->getElementsByTagName("input") as $_prop)
    {
        $_name = GetAttribute($_prop, "name");
        if (!str_starts_with($_name, "->") || $_prop->parentNode !== $_formedit) continue;
        $_value = ODataModel::GetPropertyValue($_object, substr($_name, 2));
        $_value = $_value ?? '';
        $_prop->setAttribute("value", $_value);
    }
}

function RefreshPage()
{
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_cookiename, $_datakeyEncrypted, $_datakey, $_object;
    $_SESSION[$_cookiename] = serialize($_object);
    //setcookie($_cookiename, serialize($_object), time() + 60*60*24);
    $_getdatakey = urlencode($_datakeyEncrypted);
    header("Location: $_requestURI" . "?ACTION=EDIT&DATAKEY=$_getdatakey");
}

function ClosePage()
{
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_cookiename;
    header("Location: $_requestURI");
}

?>
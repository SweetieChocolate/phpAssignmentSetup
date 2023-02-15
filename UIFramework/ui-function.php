<?php

function BindFormToObject()
{
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_cookiename;
    $_bindProps = array();
    foreach ($_POST as $_key => $_value)
    {
        if (str_starts_with($_key, "->"))
        {
            $_bindProps[substr($_key, 2)] = $_value;
        }
    }
    if (!isset($_COOKIE[$_cookiename])) return null;
    $_object = unserialize($_COOKIE[$_cookiename]);
    foreach ($_bindProps as $_key => $_value)
    {
        ODataModel::SetPropertyValue($_object, $_key, $_value);
    }
    return $_object;
}

function BindObjectToForm($_object)
{
    if ($_object == null) return;
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_cookiename;
    setcookie($_cookiename, serialize($_object), time() + 60*60*24);
    $_xpathEdit = new DOMXPath($_formedit->ownerDocument);
    $_props = $_xpathEdit->query("//input[contains(@name, '->')]");
    foreach ($_props as $_prop)
    {
        $_name = GetAttribute($_prop, "name");
        $_value = ODataModel::GetPropertyValue($_object, substr($_name, 2));
        $_value = $_value ?? '';
        $_prop->setAttribute("value", $_value);
    }
}

function RefreshPage()
{
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_cookiename;
    $_object = BindFormToObject();
    $_datakey = urlencode($_object->ObjectID->Encrypt($_sid));
    header("Location: $_requestURI" . "?ACTION=EDIT&DATAKEY=$_datakey");
}

function ClosePage()
{
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_cookiename;
    header("Location: $_requestURI");
}

?>
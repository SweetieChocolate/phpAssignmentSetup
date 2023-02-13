<?php

function BindFormToObject()
{
    global $_basetablename, $_datakey;
    $_bindProps = array();
    foreach ($_POST as $_key => $_value)
    {
        if (str_starts_with($_key, "->"))
        {
            $_bindProps[substr($_key, 2)] = $_value;
        }
    }
    if ($_datakey == '')
        $_object = $_basetablename::Create();
    else
        $_object = $_basetablename::Load($_datakey);
    foreach ($_bindProps as $_key => $_value)
    {
        ODataModel::SetPropertyValue($_object, $_key, $_value);
    }
    return $_object;
}

function BindObjectToForm($_object)
{
    if ($_object == null) return;
    global $_dom;
    global $_formedit, $_basetablename, $_datakey;
    $_xpathEdit = new DOMXPath($_formedit->ownerDocument);
    $_props = $_xpathEdit->query("//input[contains(@name, '->')]");
    foreach ($_props as $_prop)
    {
        $_name = GetAttribute($_prop, "name");
        $_value = ODataModel::GetPropertyValue($_object, substr($_name, 2));
        $_prop->setAttribute("value", $_value);
    }
}

?>
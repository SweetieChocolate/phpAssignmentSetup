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

function NeedBindingObjectToForm(string $type) : bool
{
    switch ($type)
    {
        case null: case "": return false;
        case "DataList": return false;
        default: return true;
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
        $_otype = $_object->GetPropertyType($_key);
        $_value = GetApplicableValueFromFormToObject($_value, $_otype);
        if ($_value == null) continue;
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
    foreach ($_formedit->ownerDocument->getElementsByTagName("input") as $_input)
    {
        $_name = GetAttribute($_input, "name");
        if (!str_starts_with($_name, "->")) continue;

        $_name = substr($_name, 2);
        $_otype = $_objectSource->GetPropertyType($_name);
        if (!NeedBindingObjectToForm($_otype)) continue;

        $_value = ODataModel::GetPropertyValue($_objectSource, $_name);
        if ($_value == null) continue;
        $_ftype = GetAttribute($_input, "type") ?? "";
        $_value = GetApplicableValueFromObjetToForm($_value, $_ftype);
        $_input->setAttribute("value", $_value);
        if ($_ftype == "checkbox")
        {
            if ($_value != null && $_value == true)
            {
                $_input->setAttribute("checked", "");
            }
        }
    }
    
    foreach ($_formedit->ownerDocument->getElementsByTagName("select") as $_dropdown)
    {
        $_name = GetAttribute($_dropdown, "name");
        if (!str_starts_with($_name, "->")) continue;

        $_name = substr($_name, 2);
        $_otype = $_objectSource->GetPropertyType($_name);
        if (!NeedBindingObjectToForm($_otype)) continue;

        $_value = ODataModel::GetPropertyValue($_objectSource, $_name);
        if ($_value == null) continue;

        if ($_otype == "UUID") $_value = $_value->Encrypt($_sid);
        
        SetDropDownSelected($_dropdown, $_value);
    }
}

$_OTMProperty = GetAndUnsetPOST('PropertyName');
$_OTMDatakey = GetAndUnsetPOST('OTMDataKey');
$_OTMObjectID = $_OTMDatakey != null ? StringDecryption($_OTMDatakey, $_sid) : null;

function BindFormToObject_OTM()
{
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_sessionname, $_datakeyEncrypted, $_datakey;
    global $_OTMProperty, $_OTMDatakey, $_OTMObjectID;
    $_object = GetCurrentObject();
    if ($_object == null) return null;
    if ($_OTMProperty == null) return null;

    $_otm = ODataModel::GetPropertyValue($_object, substr($_OTMProperty, 2));
    if ($_otm == null) return;

    $_otmObject = null;
    $_pendingAdd = false;
    if ($_OTMObjectID != null)
        $_otmObject = $_otm->FindWithID($_OTMObjectID);

    if ($_OTMObjectID == null || $_otmObject == null)
    {
        $_pendingAdd = true;
        $_otmObject = $_otm->CreateNewObject();
    }
        
    $_bindProps = array();
    foreach ($_POST as $_key => $_value)
    {
        if (str_starts_with($_key, "->"))
        {
            $_bindProps[substr($_key, 2)] = $_value;
        }
    }
    foreach ($_bindProps as $_key => $_value)
    {
        $_otype = $_otmObject->GetPropertyType($_key);
        $_value = GetApplicableValueFromFormToObject($_value, $_otype);
        if ($_value == null) continue;
        ODataModel::SetPropertyValue($_otmObject, $_key, $_value);
    }

    if ($_pendingAdd)
        $_otm->Add($_otmObject);

    $_SESSION[$_sessionname] = serialize($_object);
}

function BindObjectToForm_OTM($_objectSource, $_formModal) : DOMNode | null
{
    if ($_objectSource == null) return null;
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_sessionname, $_datakeyEncrypted, $_datakey;
    $_formResult = $_formModal->cloneNode(true);
    foreach ($_formResult->getElementsByTagName("input") as $_prop)
    {
        $_name = GetAttribute($_prop, "name");
        if (!str_starts_with($_name, "->")) continue;
        
        $_name = substr($_name, 2);
        $_otype = $_objectSource->GetPropertyType($_name);
        if (!NeedBindingObjectToForm($_otype)) continue;

        $_value = ODataModel::GetPropertyValue($_objectSource, $_name);
        $_ftype = GetAttribute($_prop, "type") ?? "";
        $_value = GetApplicableValueFromObjetToForm($_value, $_ftype);
        if ($_value == null) continue;
        $_prop->setAttribute("value", $_value);
    }
    
    foreach ($_formResult->getElementsByTagName("select") as $_dropdown)
    {
        $_name = GetAttribute($_dropdown, "name");
        if (!str_starts_with($_name, "->")) continue;

        $_name = substr($_name, 2);
        $_otype = $_objectSource->GetPropertyType($_name);
        if (!NeedBindingObjectToForm($_otype)) continue;

        $_value = ODataModel::GetPropertyValue($_objectSource, $_name);
        if ($_value == null) continue;
        if ($_otype == "UUID") $_value = $_value->Encrypt($_sid);
        
        SetDropDownSelected($_dropdown, $_value);
    }
    return $_formResult;
}

function DeleteObjectFromForm_OTM()
{
    global $_sid, $_requestURI, $_formedit, $_basetablename, $_sessionname, $_datakeyEncrypted, $_datakey;
    global $_OTMProperty, $_OTMDatakey, $_OTMObjectID;
    $_object = GetCurrentObject();
    if ($_object == null) return null;
    if ($_OTMProperty == null) return null;

    $_otm = ODataModel::GetPropertyValue($_object, substr($_OTMProperty, 2));
    if ($_otm == null) return;
    
    $_otm->RemoveWithID($_OTMObjectID);

    $_SESSION[$_sessionname] = serialize($_object);
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
<?php

$_ddlInputs = $_domXPath->query("//dropdownlist");
foreach ($_ddlInputs as $_input)
{
    $_select = $_dom->createElement("select", "");

    $_attrs = GetAllAttributes($_input);
    foreach ($_attrs as $_key => $_value)
    {
        $_select->setAttribute($_key, $_value);
    }

    foreach ($_input->getElementsByTagName("option") as $_option)
    {
        $_select->appendChild($_select->ownerDocument->importNode($_option, true));
    }

    if (array_key_exists('Load', $_attrs))
    {
        $_varname = $_attrs['Load'];
        $_list = $$_varname;
        foreach ($_list as $_key => $_value)
        {
            $_option = $_dom->createElement("option", $_value);
            $_option->setAttribute("value", $_key);
            $_select->appendChild($_option);
        }
    }
    
    $_input->parentNode->replaceChild($_select, $_input);
}

if ($_button != null)
{
    if ($_button == "Save")
    {
        call_user_func($_methodName['Save']);
        RefreshPage();
    }
    else if ($_button == "SaveClose")
    {
        call_user_func($_methodName['Save']);
        ClosePage();
    }
    else if ($_button == "Close")
    {
        ClosePage();
    }
    else if ($_button == "SaveOTM")
    {
        BindFormToObject_OTM();
        RefreshPage();
    }
    else if ($_button == "DeleteOTM")
    {
        DeleteObjectFromForm_OTM();
        RefreshPage();
    }
}

if ($_action != null)
{
    if ($_action == 'EDIT')
    {
        $_object = GetCurrentObject();
        if ($_object == null)
        {
            if ($_datakey == '')
                $_object = $_basetablename::Create();
            else
                $_object = $_basetablename::Load($_datakey);
            if ($_object == null)
                $_object = $_basetablename::Create();
        }
        else
        {
            $_object = BindFormToObject();
        }
        BindObjectToForm($_object);
    }
}

$_inputs = $_domXPath->query("//input|//select|//textarea");
foreach ($_inputs as $_input)
{
    $_id = GetAttribute($_input, "id"); $_id = $_id ?? "";
    $_caption = GetAttribute($_input, "Caption");
    $_caption = $_caption != null ? "$_caption:" : "";
    $_label = $_dom->createElement("label", $_caption);
    $_label->setAttribute("for", $_id);
    $_input->parentNode->insertBefore($_label, $_input);
}

$_cbInputs = $_domXPath->query("//input[@type='checkbox']");
foreach ($_cbInputs as $_cbInput)
{
    $_cbHidden = $_dom->createElement("input", "");
    $_cbName = GetAttribute($_cbInput, "name") ?? "";
    $_cbHidden->setAttribute("type", "hidden");
    $_cbHidden->setAttribute("name", $_cbName);
    $_cbHidden->setAttribute("value", "0");
    $_cbInput->parentNode->insertBefore($_cbHidden, $_cbInput);
}

?>
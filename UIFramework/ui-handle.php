<?php

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
        BindObjectToForm($_object);
    }
}

$_inputs = $_domXPath->query("//input");
foreach ($_inputs as $_input)
{
    $_id = GetAttribute($_input, "id"); $_id = $_id ?? "";
    $_caption = GetAttribute($_input, "Caption"); $_caption = $_caption ?? "";
    $_label = $_dom->createElement("label", $_caption.":");
    $_label->setAttribute("for", $_id);
    $_input->parentNode->insertBefore($_label, $_input);
}

?>
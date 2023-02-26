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
}

if ($_action != null)
{
    if ($_action == 'EDIT')
    {
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

?>
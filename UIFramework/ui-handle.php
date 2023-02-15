<?php

if ($_button != null)
{
    if (str_contains($_button, "Save"))
    {
        call_user_func("Save");
    }
    if (str_contains($_button, "Close"))
    {
        header("Location: $requestURI" . "?ACTION=VIEW");
    }
    $_object = BindFormToObject();
    $_datakey = urlencode($_object->ObjectID->Encrypt($_sid));
    header("Location: $requestURI" . "?ACTION=EDIT&DATAKEY=$_datakey");
}

if ($_action != null)
{
    if ($_action == 'EDIT')
    {
        if ($_datakey == '')
            $_object = $_basetablename::Create();
        else
            $_object = $_basetablename::Load($_datakey);
        if ($_object == null)
            $_object = $_basetablename::Create();
        BindObjectToForm($_object);
    }
}

?>
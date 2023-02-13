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
}

if ($_action != null)
{
    if ($_action == 'EDIT')
    {
        $_object = $_basetablename::Load($_datakey);
        BindObjectToForm($_object);
    }
}

?>
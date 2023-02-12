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
    $_object = $_basetablename::Load($_datakey);
    foreach ($_bindProps as $_key => $_value)
    {
        ODataModel::SetPropertyValue($_object, $_key, $_value);
    }
    return $_object;
}

function BindObjectToForm($object)
{
    global $_basetablename, $_datakey;
}

?>
<?php

function BindFormToObject()
{
    global $_basetablename, $_datakey;
    $_object = $_basetablename::Load($_datakey);
    foreach ($_POST as $key => $value)
    {
        ODataModel::SetPropertyValue($_object, $key, $value);
    }
    return $_object;
}

function BindObjectToForm($object)
{
    global $_basetablename, $_datakey;
}

?>
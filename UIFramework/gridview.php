<?php

$_element = $_dom->getElementsByTagName("gridview");
foreach ($_element as $_ele)
{
    $_attrs = GetAllAttributes($_ele);
    $_columns = GetAllChildNodesByTagName($_ele, "column");

    $_table = $_dom->createElement("table");

    // append all the header text
    $_row = $_dom->createElement("tr");
    foreach ($_columns as $_column)
    {
        $_headertext = GetAttribute($_column, "HeaderText");
        if ($_headertext == null)
            $_headertext = $_nulltext;
        $_col = $_dom->createElement("th", $_headertext);
        $_row->appendChild($_col);
    }
    $_table->appendChild($_row);

    // check if gridview is for any table in database
    if (array_key_exists('TableName', $_attrs) || array_key_exists('Load', $_attrs))
    {
        if (array_key_exists('Load', $_attrs))
        {
            $_varname = $_attrs['Load'];
            $_list = $$_varname;
        }
        else
        {
            $_tableName = $_attrs['TableName'];
            $_list = $_tableName::LoadList();
        }
        // add every row data to table by property name
        foreach ($_list as $_item)
        {
            $_row = $_dom->createElement("tr");
            foreach ($_columns as $_column)
            {
                $_propName = GetAttribute($_column, "PropertyName");
                $_valuetext = ODataModel::GetPropertyValue($_item, $_propName);
                if ($_valuetext == null)
                    $_valuetext = $_nulltext;
                $_col = $_dom->createElement("td", $_valuetext);
                $_row->appendChild($_col);
            }
            $_table->appendChild($_row);
        }
    }

    ClearNodeChild($_ele);
    $_ele->appendChild($_table);
}

?>
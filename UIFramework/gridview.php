<?php

$element = $dom->getElementsByTagName("gridview");
foreach ($element as $ele)
{
    $attrs = GetAllAttributes($ele);
    $columns = GetAllChildNodesByTagName($ele, "column");

    $table = $dom->createElement("table");

    // append all the header text
    $row = $dom->createElement("tr");
    foreach ($columns as $column)
    {
        $headertext = GetAttribute($column, "HeaderText");
        if ($headertext == null)
            $headertext = $nulltext;
        $col = $dom->createElement("th", $headertext);
        $row->appendChild($col);
    }
    $table->appendChild($row);

    // check if gridview is for any table in database
    if (array_key_exists('TableName', $attrs) || array_key_exists('Load', $attrs))
    {
        if (array_key_exists('Load', $attrs))
        {
            $list = call_user_func($attrs['Load']);
        }
        else
        {
            $tableName = $attrs['TableName'];
            $list = $tableName::LoadList();
        }
        // add every row data to table by property name
        foreach ($list as $item)
        {
            $row = $dom->createElement("tr");
            foreach ($columns as $column)
            {
                $propName = GetAttribute($column, "PropertyName");
                $valuetext = ODataModel::GetPropertyValue($item, $propName);
                if ($valuetext == null)
                    $valuetext = $nulltext;
                $col = $dom->createElement("td", $valuetext);
                $row->appendChild($col);
            }
            $table->appendChild($row);
        }
    }

    ClearNodeChild($ele);
    $ele->appendChild($table);
}

?>
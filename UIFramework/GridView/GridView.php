<?php

require_once dirname(__FILE__) . "/../../LogicLayer/TablesLogic.php";

$tablename = ISSET($_POST['TABLENAME']) ? $_POST['TABLENAME'] : "";
$headertexts = ISSET($_POST['HEADERTEXTS']) ? $_POST['HEADERTEXTS'] : "";
$properties = ISSET($_POST['PROPERTIES']) ? $_POST['PROPERTIES'] : "";

if (!empty($tablename))
{
    $doc = new DOMDocument();
    $doc->loadHTMLFile("GridView.html");
    $table = $doc->getElementById("gvDetails");
    ClearChild($table);

    $htexts = explode(";", $headertexts);
    $row = $doc->createElement("tr");
    foreach ($htexts as $htext)
    {
        if (empty($htext))
            continue;
        $col = $doc->createElement("th", $htext);
        $row->appendChild($col);
    }
    $table->appendChild($row);

    $props = explode(";", $properties);
    $list = $tablename::LoadList();
    foreach ($list as $item)
    {
        $row = $doc->createElement("tr");
        foreach ($props as $prop)
        {
            if (empty($prop))
                continue;
            $value = $prop == "-" ? "-" : ODataModel::GetPropertyValue($item, $prop);
            $value = $value == null ? "null" : $value;
            $col = $doc->createElement("td", $value);
            $row->appendChild($col);
        }
        $table->appendChild($row);
    }
    
    echo $doc->saveHTML();
}

function ClearChild(DOMElement $parent)
{
    while ($parent->firstElementChild != null)
        $parent->removeChild($parent->firstElementChild);
}

?>
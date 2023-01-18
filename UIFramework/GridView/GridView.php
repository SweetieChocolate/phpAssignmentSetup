<?php

require_once dirname(__FILE__) . "/../../LogicLayer/TablesLogic.php";

$tablename = ISSET($_POST['TABLENAME']) ? $_POST['TABLENAME'] : "";
$properties = ISSET($_POST['PROPERTIES']) ? $_POST['PROPERTIES'] : "";

$emps = $tablename::LoadList();
foreach ($emps as $emp)
{
    $var1 = "Person";
    $var2 = "FamilyName";
    echo $emp->$var1->$var2 . "<br>";
}

?>
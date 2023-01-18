<?php

require_once "LogicLayer/TablesLogic.php";

function testinsert() {
    $con = new Connection();
    
    $emp = Employment::Create();
    $emp->Salary = 500;
    $emp->Person->FamilyName = "DOV";
    $emp->Person->GivenName = "Ratha";

    $emp->save($con);
    
    $con->commit();
}

function testload()
{
    $emp = Employment::Load("0x76794a408d1311ed9dc350ebf62b0b36");
    echo $emp->Person->FamilyName;
}

function test()
{
    $dataModel = new ReflectionClass("Employment");
    $pros = $dataModel->getProperties(ReflectionProperty::IS_PROTECTED);

    foreach ($pros as $pro)
    {
        echo $pro->class . " - " . $pro->name . "<br>";
    }
}

// testinsert();
// testload();
// test();

// echo TablesLogic::SynchronizeDB();

?>

<html>
<head>
<script src="UIFramework/template.js"> </script>
</head>
<body>


<grid-view id="abc" TableName="Employment">
    <column PropertyName="Person->FamilyName" HeaderText="Last Name"></column>
    <column PropertyName="Person->GivenName" HeaderText="First Name"></column>
</grid-view>


</body>
</html>
<?php

require_once 'LogicLayer/Core/Connection.php';
require_once 'LogicLayer/Core/UUID.php';
require_once 'LogicLayer/Workforce/Employment.php';
require_once 'LogicLayer/Workforce/Person/Person.php';
require_once 'LogicLayer/Workforce/Person/PersonPhone.php';
require_once 'LogicLayer/Core/Helpers/DateTimeHelper.php';
require_once 'LogicLayer/Core/Helpers/Database.php';

function testinsert() {
    $con = new Connection();
    
    $emp = Employment::Create();
    // $emp->Salary = 500;
    $emp->Person->FamilyName = "DOV";
    $emp->Person->GivenName = "Ratha";

    $emp->save($con);
    
    // $emp->Person->Phones->Add(PersonPhone::Create());

    // foreach ($emp->Person->Phones as $p)
    // {
    //     $p->save($con);
    // }
    
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

?>
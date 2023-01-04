<?php

require_once 'LogicLayer/Core/Connection.php';
require_once 'LogicLayer/Workforce/Employment.php';
require_once 'LogicLayer/Workforce/Person/Person.php';
require_once 'LogicLayer/Workforce/Person/PersonPhone.php';
require_once 'LogicLayer/Core/Helpers/DateTimeHelper.php';
require_once 'LogicLayer/Core/Helpers/Database.php';

function test() {
    $con = new Connection();
    
    $emp = Employment::Create();
    $emp->Salary = 500;
    $emp->Person->FamilyName = "DOV";
    $emp->Person->GivenName = "Ratha";

    $emp->save($con);
    
    $emp->Person->Phones->Add(PersonPhone::Create());

    foreach ($emp->Person->Phones as $p)
    {
        $p->save($con);
    }
    
    $con->commit();
}

test();

?>
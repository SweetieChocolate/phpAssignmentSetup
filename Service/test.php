<?php

require_once dirname(__FILE__) . "/../LogicLayer/LogicLayer.php";

for ($i = 0; $i < 100; $i++)
{
    $con = new DBConnection();
    $emp = Employment::Create();
    $emp->Person->FamilyName = "DOV";
    $emp->Person->GivenName = "Ratha";
    $emp->Salary = 500;
    $emp->save($con);
    $con->commit();
}

?>
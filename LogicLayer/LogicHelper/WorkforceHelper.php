<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class WorkforceHelper
{
    public static function CreateCareerFromEmployment(OEmployment $emp) : OCareerHistory
    {
        $careerHistory = CareerHistory::Create();
        $careerHistory->EmploymentID = $emp->ObjectID;
        $careerHistory->NewSalary = $emp->Salary;
        $careerHistory->EffectiveDate = $emp->StartDate;

        ODataModel::Clone($emp, $careerHistory);

        return $careerHistory;
    }

    public static function CloneEmploymentToCareerHistory(OEmployment $emp, OCareerHistory $career) : void
    {
        ODataModel::Clone($emp, $career);
    }

    public static function UpdateCareer(OCareerHistory $careerHistory) : void
    {
        
    }
}

?>
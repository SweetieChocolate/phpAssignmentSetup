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

    public static function CloneCareerHistoryToEmployment(OEmployment $emp, OCareerHistory $career) : void
    {
        ODataModel::Clone($career, $emp);
        $emp->Salary = $career->NewSalary;
    }

    public static function UpdateEmploymentFromLatestCareer(OEmployment $emp, OCareerHistory $career) : void
    {
        $lastestCareer = $career;
        $dbcareer = CareerHistory::Where("1", "EffectiveDate DESC");
        if ($lastestCareer->EffectiveDate < $dbcareer->EffectiveDate &&
            !$lastestCareer->ObjectID->EqualUUID($dbcareer->ObjectID))
        {
            $lastestCareer = $dbcareer;
        }
        ODataModel::Clone($lastestCareer, $emp);
        $emp->Salary = $lastestCareer->NewSalary;
    }

    public static function UpdateCareer(OCareerHistory $careerHistory) : void
    {
        $employmentID = $careerHistory->EmploymentID->ForQuery();
        $startDate = DateTimeHelper::ConvertToString($careerHistory->EffectiveDate);
        $preCareer = CareerHistory::Where("EmploymentID = $employmentID AND EffectiveDate < '$startDate'", "EffectiveDate DESC");
        if ($preCareer !== NULL)
        {
            $preCareer->EndDate = DateTimeHelper::AddDays($careerHistory->EffectiveDate, -1);
            $preCareer->NextCareer = $careerHistory;
            $careerHistory->PreviousCareer = $preCareer;
        }
    }
}

?>
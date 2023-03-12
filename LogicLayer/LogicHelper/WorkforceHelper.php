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
        $preCareer = $careerHistory->PreviousCareer;
        if ($preCareer === NULL)
        {
            $employmentID = $careerHistory->EmploymentID->ForQuery();
            $startDate = DateTimeHelper::ForQuery($careerHistory->EffectiveDate);
            $preCareer = CareerHistory::Where("EmploymentID = $employmentID AND EffectiveDate < $startDate", "EffectiveDate DESC");
        }
        if ($preCareer !== NULL)
        {
            $careerHistory->PreviousCareer = $preCareer;
            $preCareer->NextCareer = $careerHistory;
            $preCareer->EndDate = DateTimeHelper::AddDays($careerHistory->EffectiveDate, -1);
        }

        $nextCareer = $careerHistory->NextCareer;
        if ($nextCareer === NULL)
        {
            $employmentID = $careerHistory->EmploymentID->ForQuery();
            $startDate = DateTimeHelper::ForQuery($careerHistory->EffectiveDate);
            $nextCareer = CareerHistory::Where("EmploymentID = $employmentID AND EffectiveDate > $startDate", "EffectiveDate ASC");
        }
        if ($nextCareer !== NULL)
        {
            //$nextCareer->PreviousCareer = $careerHistory;
            $nextCareer->EffectiveDate = DateTimeHelper::AddDays($careerHistory->EndDate, 1);
            $nextCareer->Salary = $careerHistory->NewSalary;
        }
        else
        {
            $careerHistory->EndDate = null;
        }
    }

    public static function GetCareerHistoryRange(UUID $EmploymentID, DateTime $fromDate, DateTime $toDate) : Array
    {
        $result = array();
        $empId = $EmploymentID->ForQuery();
        $qFromDate = DateTimeHelper::ForQuery($fromDate);
        $qToDate = DateTimeHelper::ForQuery($toDate);
        $where = "EmploymentID = $empId
            AND EffectiveDate <= $qToDate
            AND (EndDate IS NULL OR EndDate >= $qFromDate)
        ";
        $result = CareerHistory::LoadList($where, "EffectiveDate ASC");
        return $result;
    }
}

?>
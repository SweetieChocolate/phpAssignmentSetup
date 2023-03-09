<?php

namespace WorkforceHelper
{
    require_once dirname(__FILE__) . "/../LogicLayer.php";

    function CreateCareerFromEmployment(\OEmployment $emp) : \OCareerHistory
    {
        $careerHistory = \CareerHistory::Create();
        $careerHistory->EmploymentID = $emp->ObjectID;

        \ODataModel::Clone($emp, $careerHistory);

        return $careerHistory;
    }
}

?>
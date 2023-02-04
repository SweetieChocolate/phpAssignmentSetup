<?php

require_once dirname(__FILE__) . "/../TablesLogic.php";

class Employment extends DataModel
{
    protected UUID $PersonID;
    protected Person $Person;

    protected float $Salary;

    // Job Information
    protected UUID $BranchID;
    protected UUID $DepartmentID;
    protected UUID $PositionID;

    // Time Attendance
    protected UUID $RosterID;

    public static function Create() : ODataModel
    {
        $obj = parent::Create();
        $per = Person::Create();
        $obj->PersonID = $per->ObjectID;
        $obj->Person = $per;
        return $obj;
    }

    public function save(DBConnection $con) : void
    {
        parent::save($con);
        parent::__get("Person")->save($con);
    }
}

class OEmployment extends ODataModel
{
    
}

?>
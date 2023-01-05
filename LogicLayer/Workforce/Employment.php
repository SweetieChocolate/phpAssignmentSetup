<?php

require_once dirname(__FILE__) . "/../Core/Connection.php";
require_once dirname(__FILE__) . "/../Core/DataModel.php";
require_once "Person/Person.php";

class Employment extends DataModel
{
    // Job Information
    protected string $BranchID;
    protected string $DepartmentID;
    protected string $PositionID;

    // Time Attendance
    protected string $RosterID;

    protected float $Salary;

    protected UUID $PersonID;
    protected Person $Person;

    public static function Create() : DataModel
    {
        $obj = parent::Create();
        $per = Person::Create();
        $obj->PersonID = $per->ObjectID;
        $obj->Person = $per;
        return $obj;
    }

    public function save(Connection $con) : void
    {
        parent::save($con);
        $this->Person->save($con);
    }
}

?>
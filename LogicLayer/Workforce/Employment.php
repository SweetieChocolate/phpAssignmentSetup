<?php

require_once dirname(__FILE__) . "/../TablesLogic.php";

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

class OEmployment
{
    protected Employment $obj;
    public function __construct(Employment $emp)
    {
        $this->obj = $emp;
    }

    public function __get($name)
    {
        return $this->obj->$name;
    }

    public function __set($name, $value)
    {
        $this->obj->$name = $value;
    }

    public function test()
    {
        echo "aa";
        print_r($this->obj);
        echo $this->obj->Person->GivenName;
    }
}

?>
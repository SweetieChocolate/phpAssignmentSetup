<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class Employment extends DataModel
{
    protected UUID $PersonID;
    protected Person $Person;

    protected DataList $Users;

    protected float $Salary;

    // Job Information
    protected UUID $BranchID;
    protected UUID $DepartmentID;
    protected UUID $PositionID;

    // Time Attendance
    protected UUID $RosterID;

    protected function __construct()
    {
        $this->Users = DataList::Init('User', 'EmploymentID');
    }

    public static function Create() : ODataModel
    {
        $obj = parent::Create();
        $per = Person::Create();
        $user = User::Create();
        $obj->PersonID = $per->ObjectID;
        $obj->Person = $per;
        $obj->Users->append($user);
        return $obj;
    }

    public function save(DBConnection $con) : void
    {
        parent::save($con);
        $this->Get("Person")->save($con);
        if ($this->IsNew())
        {
            foreach ($this->Get("Users") as $user)
            {
                $user->save($con);
            }
        }
    }
}

class OEmployment extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            default:
                return parent::__get($name);
        }
    }
}

?>
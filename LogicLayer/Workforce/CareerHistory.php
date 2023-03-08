<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class CareerHistory extends DataModel
{
    protected UUID $EmploymentID;
    protected Employment $Employment;

    protected float $Salary;
    protected UUID $CareerCodeID;
    protected CodeField $CareerCode;
    // Job Information
    protected UUID $RegionID;
    protected CodeField $Region;
    protected UUID $BranchID;
    protected CodeField $Branch;
    protected UUID $LocationID;
    protected CodeField $Location;
    protected UUID $DepartmentID;
    protected CodeField $Department;
    protected UUID $PositionID;
    protected CodeField $Position;
    protected UUID $PositionFamilyID;
    protected CodeField $PositionFamily;
    protected UUID $JobLevelID;
    protected CodeField $JobLevel;

    protected function __construct()
    {
        
    }
}

class OCareerHistory extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            default:
                return parent::__get($name);
        }
    }

    public function save(DBConnection $con) : void
    {
        parent::save($con);
        if ($this->obj->IsNew())
        {

        }
    }
}

?>
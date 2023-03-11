<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class Employment extends DataModel
{
    protected ?UUID $PersonID;
    protected ?Person $Person;

    protected DataList $Users;

    protected ?float $Salary;
    protected ?DateTime $StartDate;
    protected ?DateTime $EndDate;

    // Job Information
    protected ?UUID $RegionID;
    protected ?CodeField $Region;
    protected ?UUID $BranchID;
    protected ?CodeField $Branch;
    protected ?UUID $LocationID;
    protected ?CodeField $Location;
    protected ?UUID $DepartmentID;
    protected ?CodeField $Department;
    protected ?UUID $PositionID;
    protected ?CodeField $Position;
    protected ?UUID $PositionFamilyID;
    protected ?CodeField $PositionFamily;
    protected ?UUID $JobLevelID;
    protected ?CodeField $JobLevel;

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
}

class OEmployment extends ODataModel implements IAutoNumber
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            case "StartDateText":
                return $this->StartDate !== NULL ? DateTimeHelper::ConvertToStringDate($this->StartDate) : "";
            case "EndDateText":
                return $this->EndDate !== NULL ? DateTimeHelper::ConvertToStringDate($this->EndDate) : "";
            default:
                return parent::__get($name);
        }
    }

    public function Saving(DBConnection $con) : void
    {
        $this->ObjectName = $this->Person->FullName;
        if ($this->obj->IsNew())
        {
            $this->Users[0]->ObjectNumber = $this->ObjectNumber;
            $this->Users[0]->ObjectName = $this->ObjectName;
            $this->Users[0]->UserName = $this->ObjectNumber;
            $this->Users[0]->Password = $this->ObjectNumber;
            $this->Users[0]->IsBan = true;

            $careerHistory = WorkforceHelper::CreateCareerFromEmployment($this);
            $careerCodeType = OCodeField::$CAREER_CODE;
            $newJoin = CodeField::Where("CodeType = '$careerCodeType' AND ObjectNumber = 'NEWJOIN'");
            $careerHistory->CareerCodeID = $newJoin->ObjectID;
            $careerHistory->save($con);
        }
        parent::Saving($con);
    }

    public static function GetAllEmployments(string $_sid) : array
    {
        $empslist = array();
        $emps = Employment::LoadList("1", "ObjectNumber");
        
        foreach ($emps as $item)
        {
            $empslist[$item->ObjectID->Encrypt($_sid)] = $item->ObjectName;
        }

        return $empslist;
    }
}

?>
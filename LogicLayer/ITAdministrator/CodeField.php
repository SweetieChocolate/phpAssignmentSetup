<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class CodeField extends DataModel
{
    protected ?UUID $ParentID;
    protected ?CodeField $Parent;
    protected ?string $Description;
    protected ?string $CodeType;

    protected function __construct()
    {
        
    }
}

class OCodeField extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            default:
                return parent::__get($name);
        }
    }

    public static function GetDropDownListCodeFieldByCodeType(string $codeType, string $sessionID)
    {
        $list = CodeField::LoadList("CodeType = '$codeType'", "ObjectNumber");
        $resultList = array();
        foreach ($list as $item)
        {
            $resultList[$item->ObjectID->Encrypt($sessionID)] = $item->ObjectName;
        }
        return $resultList;
    }

    public static string $REGION = "REGION";
    public static string $BRANCH = "BRANCH";
    public static string $LOCATION = "LOCATION";
    public static string $DEPARTMENT = "DEPARTMENT";
    public static string $POSITION = "POSITION";
    public static string $POSITION_FAMILY = "POSITIONFAMILY";
    public static string $JOB_LEVEL = "JOBLEVEL";
    public static string $CAREER_CODE = "CAREERCODE";
    public static string $ALLOWANCE_TYPE = "ALLOWANCETYPE";
    public static string $BONUS_TYPE = "BONUSTYPE";
    public static string $DEDUCTION_TYPE = "DEDUCTIONTYPE";
}

?>
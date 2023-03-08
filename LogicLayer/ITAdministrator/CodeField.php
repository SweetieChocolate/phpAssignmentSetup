<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class CodeField extends DataModel
{
    protected UUID $ParentID;
    protected CodeField $Parent;
    protected string $Description;
    protected string $CodeType;

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

    public static string $REGION = "REGION";
    public static string $BRANCH = "BRANCH";
    public static string $LOCATION = "LOCATION";
    public static string $DEPARTMENT = "DEPARTMENT";
    public static string $POSITION = "POSITION";
    public static string $POSITION_FAMILY = "POSITIONFAMILY";
    public static string $CAREER_CODE = "CAREERCODE";
}

?>
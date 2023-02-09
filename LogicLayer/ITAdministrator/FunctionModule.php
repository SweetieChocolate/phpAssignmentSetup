<?php

require_once dirname(__FILE__) . "/../LogicLayer.php";

class FunctionModule extends DataModel
{
    protected string $Category;
    protected string $SubCategory;
    protected string $FunctionName;
    protected int $DisplayOrder;
    protected string $URL;
    protected string $SubURL;

    protected function __construct()
    {
        $this->FunctionRoleDetails = DataList::Init('FunctionRoleDetail', 'FunctionModuleID');
    }

    protected DataList $FunctionRoleDetails;
}

class OFunctionModule extends ODataModel
{
    public function __get($name) : mixed
    {
        switch($name)
        {
            default:
                return parent::__get($name);
        }
    }

    // load function base on user permission
    public static function GetAvailableFunction(UUID $userID)
    {
        // load all for now
        $functions = FunctionModule::LoadList("1", "DisplayOrder ASC");
        return $functions;
    }
}

?>
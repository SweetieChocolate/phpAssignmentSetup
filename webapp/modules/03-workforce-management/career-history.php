<?php
// this part is ui framework and seesion validate part

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['ISINITIALIZE'])) exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-head.php";

// data manipulate start here

$ddlEmployment = OEmployment::GetAllEmployments($sessionId);

$ddlRegion = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$REGION, $sessionId);
$ddlBranch = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$BRANCH, $sessionId);
$ddlLocation = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$LOCATION, $sessionId);
$ddlDepartment = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$DEPARTMENT, $sessionId);
$ddlPosition = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$POSITION, $sessionId);
$ddlPositionFamily = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$POSITION_FAMILY, $sessionId);
$ddlJobLevel = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$JOB_LEVEL, $sessionId);

$dllCareerCode = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$CAREER_CODE, $sessionId);

// data manupulate end here

// function start here

function SaveObject()
{
    $o = BindFormToObject();
    $con = new DBConnection();
    $o->save($con);
    $con->commit();
    BindObjectToForm($o);
}

// function end here

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-handle.php";

// pre render logic start here

$o = GetCurrentObject();
if ($o != null && $o->Employment != null)
{
    WorkforceHelper::CloneEmploymentToCareerHistory($o->Employment, $o);
    BindObjectToForm($o);
}

// pre render logic end here

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-foot.php";

?>

<html>
<head>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-header.php"; ?>
</head>
<body class="frame">
    <form id="VIEW" action="" method="post" BaseTableName="CareerHistory">
        <gridview id="gvDetails" TableName="CareerHistory">
            <grid-command>
                <command CommandName="AddObject" CommandText="New"></command>
            </grid-command>
            <grid-column>
                <column PropertyName="->Employment->ObjectNumber" HeaderText="Code" />
                <column PropertyName="->Employment->ObjectName" HeaderText="Name" />
                <column PropertyName="->CareerCode->ObjectName" HeaderText="Career" />
                <column PropertyName="->StartDateText" HeaderText="Start Date" />
                <column PropertyName="->EndDateText" HeaderText="End Date" />
                <column PropertyName="->Salary" HeaderText="Salary" />
                <column PropertyName="->NewSalary" HeaderText="New Salary" />
                <column PropertyName="->Branch->ObjectName" HeaderText="Branch" />
                <column PropertyName="->Department->ObjectName" HeaderText="Department" />
                <column PropertyName="->Position->ObjectName" HeaderText="Position" />
            </grid-column>
        </gridview>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="CareerHistory" Save="SaveObject">

        <div class="row">
            <div class="two-col">
                <dropdownlist id="ddlEmployment" name="->EmploymentID" Caption="Employment" Load="ddlEmployment" required="true"
                    onchange="this.form.submit()">
                    <option value=""></option>
                </dropdownlist>
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <dropdownlist id="dllCareerCode" name="->CareerCodeID" Caption="Career Code" Load="dllCareerCode">
                    <option value=""></option>
                </dropdownlist>
            </div>
            <div class="two-col">
                <input type="date" id="dtEffectiveDate" name="->EffectiveDate" Caption="Effective Date" required="true" />
            </div>
        </div>
        
        <div class="row">
            <div class="two-col">
                <input type="text" id="tbSalary" name="->Salary" Caption="Salary" readonly="true" />
            </div>
            <div class="two-col">
                <input type="text" id="tbNewSalary" name="->NewSalary" Caption="New Salary" />
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <dropdownlist id="ddlRegion" name="->RegionID" Caption="Region" Load="ddlRegion">
                    <option value=""></option>
                </dropdownlist>
            </div>
            <div class="two-col">
                <dropdownlist id="ddlBranch" name="->BranchID" Caption="Branch" Load="ddlBranch">
                    <option value=""></option>
                </dropdownlist>
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <dropdownlist id="ddlLocation" name="->LocationID" Caption="Location" Load="ddlLocation">
                    <option value=""></option>
                </dropdownlist>
            </div>
            <div class="two-col">
                <dropdownlist id="ddlDepartment" name="->DepartmentID" Caption="Department" Load="ddlDepartment">
                    <option value=""></option>
                </dropdownlist>
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <dropdownlist id="ddlPosition" name="->PositionID" Caption="Position" Load="ddlPosition">
                    <option value=""></option>
                </dropdownlist>
            </div>
            <div class="two-col">
                <dropdownlist id="ddlPositionFamily" name="->PositionFamilyID" Caption="Position Family" Load="ddlPositionFamily">
                    <option value=""></option>
                </dropdownlist>
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <dropdownlist id="ddlJobLevel" name="->JobLevelID" Caption="Job Level" Load="ddlJobLevel">
                    <option value=""></option>
                </dropdownlist>
            </div>
        </div>

    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>
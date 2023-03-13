<?php
// this part is ui framework and seesion validate part

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['ISINITIALIZE'])) exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-head.php";

// data manipulate start here

$ddlRegion = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$REGION, $sessionId);
$ddlBranch = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$BRANCH, $sessionId);
$ddlLocation = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$LOCATION, $sessionId);
$ddlDepartment = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$DEPARTMENT, $sessionId);
$ddlPosition = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$POSITION, $sessionId);
$ddlPositionFamily = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$POSITION_FAMILY, $sessionId);
$ddlJobLevel = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$JOB_LEVEL, $sessionId);

$ddlContactType = GlobalConstant\ContactType::GetContactTypeDropDownList();

// data manupulate end here

// function start here

function SaveObject()
{
    $emp = BindFormToObject();
    $con = new DBConnection();
    $emp->save($con);
    $con->commit();
    BindObjectToForm($emp);
}

// function end here

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-handle.php";

// pre render logic start here

// pre render logic end here

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-foot.php";

?>

<html>
<head>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-header.php"; ?>
</head>
<body class="frame">
    <form id="VIEW" action="" method="post" BaseTableName="Employment">
        <gridview id="gvDetails" TableName="Employment">
            <grid-command>
                <command CommandName="AddObject" CommandText="New"></command>
            </grid-command>
            <grid-column>
                <column PropertyName="->ObjectNumber" HeaderText="Code" />
                <column PropertyName="->ObjectName" HeaderText="Name" />
                <column PropertyName="->StartDateText" HeaderText="Start Date" />
                <column PropertyName="->EndDateText" HeaderText="End Date" />
                <column PropertyName="->Salary" HeaderText="Salary" />
                <column PropertyName="->Branch->ObjectName" HeaderText="Branch" />
                <column PropertyName="->Department->ObjectName" HeaderText="Department" />
                <column PropertyName="->Position->ObjectName" HeaderText="Position" />
            </grid-column>
        </gridview>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="Employment" Save="SaveObject">

        <div class="row">
            <div class="two-col">
                <img src="./../../source/image/profile.png" />
                <input type="file" />
            </div>
            <div class="two-col">
                <div class="row">
                    <div class="one-col">
                        <input type="text" id="tbFamilyName" name="->Person->FamilyName" Caption="Family Name" required="true" />
                    </div>
                </div>
                <div class="row">
                    <div class="one-col">
                        <input type="text" id="tbGivenName" name="->Person->GivenName" Caption="Given Name" required="true" />
                    </div>
                </div>
                <div class="row">
                    <div class="one-col">
                        <input type="date" id="tbBirthday" name="->Person->BirthDay" Caption="Birthday" />
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="two-col">
                <input type="text" id="tbSalary" name="->Salary" Caption="Salary" required="true" />
            </div>
            <div class="two-col">
                <input type="date" id="tbStartDate" name="->StartDate" Caption="Start Date" required="true" />
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
        
        <div class="row">
            <div class="two-col">
                <onetomany PropertyName="->Person->Phones">
                    <grid-command>
                        <command CommandName="AddObject" CommandText="New"></command>
                    </grid-command>
                    <grid-column>
                        <column PropertyName="->TypeText" HeaderText="Type" />
                        <column PropertyName="->ObjectNumber" HeaderText="Phone Number"/>
                    </grid-column>
                    <pop-up Size="modal-lg" Caption="Phone">
                        <dropdownlist id="ddlPhoneType" name="->Type" Caption="Contact Type" Load="ddlContactType" />
                        <input type="text" id="tbPhoneNumber" name="->ObjectNumber" Caption="Phone Number" required="true" />
                    </pop-up>
                </onetomany>
            </div>
            <div class="two-col">
                <onetomany PropertyName="->Person->Emails">
                    <grid-command>
                        <command CommandName="AddObject" CommandText="New"></command>
                    </grid-command>
                    <grid-column>
                        <column PropertyName="->TypeText" HeaderText="Type" />
                        <column PropertyName="->ObjectNumber" HeaderText="Email"/>
                    </grid-column>
                    <pop-up Size="modal-lg" Caption="Email">
                        <dropdownlist id="ddlEmailType" name="->Type" Caption="Contact Type" Load="ddlContactType" />
                        <input type="text" id="tbEmail" name="->ObjectNumber" Caption="Email" required="true" />
                    </pop-up>
                </onetomany>
            </div>
        </div>

    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>
<?php
// this part is ui framework and seesion validate part

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['ISINITIALIZE'])) exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-head.php";

// data manipulate start here

$ddlEmployment = OEmployment::GetAllEmployments($sessionId);
$ddlRole = ORoleModule::GetAllRoles($sessionId);

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
    <form id="VIEW" action="" method="post" BaseTableName="User">
        <gridview id="gvDetails" TableName="User">
            <grid-command>
                <command CommandName="AddObject" CommandText="New"></command>
            </grid-command>
            <grid-column>
                <column PropertyName="->Employment->ObjectNumber" HeaderText="Employee Code" />
                <column PropertyName="->Employment->ObjectName" HeaderText="Employee Name" />
                <column PropertyName="->ObjectName" HeaderText="ObjectName" />
                <column PropertyName="->IsAdminText" HeaderText="Is Administrator" />
                <column PropertyName="->RequirePasswordChangeText" HeaderText="Require Password Change" />
                <column PropertyName="->IsBanText" HeaderText="Is Ban" />
            </grid-column>
        </gridview>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="User" Save="SaveObject">

        <div class="row">
            <div class="one-col">
                <dropdownlist id="ddlEmployment" name="->EmploymentID" Caption="Employment" Load="ddlEmployment">
                    <option value=""></option>
                </dropdownlist>
            </div>
        </div>

        <div class="row">
            <div class="one-col">
                <input type="text" id="tbUserName" name="->UserName" Caption="UserName" required="true" />
            </div>
        </div>

        <div class="row">
            <div class="one-col">
                <input type="password" id="tbPassword" name="->Password" Caption="Password" required="true" />
            </div>
        </div>

        <div class="row">
            <div class="one-col">
                <input type="text" id="tbEmail" name="->UserEmail" Caption="Email" />
            </div>
        </div>

        <div class="row">
            <div class="one-col">
                <input type="checkbox" id="cbIsAdmin" name="->IsAdministrator" Caption="Is Administrator?" />
            </div>
        </div>

        <div class="row">
            <div class="one-col">
                <input type="checkbox" id="cbRequirePasswordChange" name="->RequirePasswordChange" Caption="Require Password Change?" />
            </div>
        </div>

        <div class="row">
            <div class="one-col">
                <input type="checkbox" id="cbIsBan" name="->IsBan" Caption="Is Ban?" />
            </div>
        </div>
        
        <div class="row">
            <div class="two-col">
                <onetomany PropertyName="->UserRoleDetail">
                    <grid-command>
                        <command CommandName="AddObject" CommandText="New"></command>
                    </grid-command>
                    <grid-column>
                        <column PropertyName="->RoleModule->ObjectName" HeaderText="Role" />
                    </grid-column>
                    <pop-up Caption="Role">
                        <dropdownlist id="ddlRole" name="->RoleModuleID" Caption="Role" Load="ddlRole" required="true" />
                    </pop-up>
                </onetomany>
            </div>
        </div>

    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>
<?php
// this part is ui framework and seesion validate part

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['ISINITIALIZE'])) exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-head.php";

// data manipulate start here

$ddlRole = ORoleModule::GetAllRoles($sessionId);

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

// pre render logic end here

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-foot.php";

?>

<html>
<head>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-header.php"; ?>
</head>
<body class="frame">
    <form id="VIEW" action="" method="post" BaseTableName="FunctionModule">
        <gridview id="gvDetails" TableName="FunctionModule">
            <grid-command>
                <command CommandName="AddObject" CommandText="New"></command>
            </grid-command>
            <grid-column>
                <column PropertyName="->Category" HeaderText="Category"></column>
                <column PropertyName="->SubCategory" HeaderText="Sub Category"></column>
                <column PropertyName="->FunctionName" HeaderText="Function Name"></column>
                <column PropertyName="->DisplayOrder" HeaderText="Display Order"></column>
                <column PropertyName="->URL" HeaderText="URL"></column>
                <column PropertyName="->SubURL" HeaderText="Sub URL"></column>
                <column PropertyName="->IsEnabledText" HeaderText="Is Enable?"></column>
            </grid-column>
        </gridview>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="FunctionModule" Save="SaveObject">
        <div class="row">
            <div class="one-col">
                <input type="text" id="tbCategory" name="->Category" Caption="Category" />
            </div>
        </div>
        <div class="row">
            <div class="one-col">
                <input type="text" id="tbFunctionName" name="->FunctionName" Caption="Function Name" />
            </div>
        </div>
        <div class="row">
            <div class="one-col">
                <input type="text" id="tbDisplayOrder" name="->DisplayOrder" Caption="Display Order" />
            </div>
        </div>
        <div class="row">
            <div class="one-col">
                <input type="text" id="tbURL" name="->URL" Caption="URL" style="width: 70%;" />
            </div>
        </div>
        <div class="row">
            <div class="one-col">
                <input type="checkbox" id="cbIsEnable" name="->IsEnable" Caption="Is Enable?" />
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <onetomany PropertyName="->FunctionRoleDetails">
                    <grid-command>
                        <command CommandName="AddObject" CommandText="New"></command>
                    </grid-command>
                    <grid-column>
                        <column PropertyName="->RoleModule->ObjectName" HeaderText="Role Name"/>
                    </grid-column>
                    <pop-up Caption="Email">
                        <dropdownlist id="ddlRole" name="->RoleModuleID" Caption="Role" Load="ddlRole">
                            <option value=""></option>
                        </dropdownlist>
                    </pop-up>
                </onetomany>
            </div>
        </div>
    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>
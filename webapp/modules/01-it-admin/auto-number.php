<?php
// this part is ui framework and seesion validate part

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['ISINITIALIZE'])) exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-head.php";

// data manipulate start here

$ddlClassType = OAutoNumber::GetAllClassWithAutoNumber();

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
    <form id="VIEW" action="" method="post" BaseTableName="AutoNumber">
        <gridview id="gvDetails" TableName="AutoNumber">
            <grid-command>
                <command CommandName="AddObject" CommandText="New" />
            </grid-command>
            <grid-column>
                <column PropertyName="->ObjectClassType" HeaderText="Object Type" />
                <column PropertyName="->Format" HeaderText="Format" />
                <column PropertyName="->CurrentNumber" HeaderText="Current Number" />
                <column PropertyName="->NumberExample" HeaderText="Example" />
            </grid-column>
        </gridview>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="AutoNumber" Save="SaveObject">
        <div class="row">
            <div class="one-col">
                <dropdownlist id="ddlClass" name="->ObjectClassType" Caption="Object Type" Load="ddlClassType" required="true">
                    <option value=""></option>
                </dropdownlist>
            </div>
        </div>
        <div class="row">
            <div class="one-col">
                <input type="text" id="tbFormat" name="->Format" Caption="Format" required="true" />
            </div>
        </div>
        <div class="row">
            <div class="one-col">
                <input type="text" id="tbCurrentNumber" name="->CurrentNumber" Caption="Current Number" readonly="true" />
            </div>
        </div>
    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>
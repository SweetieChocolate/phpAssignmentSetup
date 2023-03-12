<?php
// this part is ui framework and seesion validate part

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['ISINITIALIZE'])) exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-head.php";

// data manipulate start here

$codeType = OCodeField::$POSITION;
$gvResult = CodeField::LoadList("CodeType = '$codeType'");

// data manupulate end here

// function start here

function SaveObject()
{
    $o = BindFormToObject();
    $o->CodeType = OCodeField::$POSITION;
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
    <form id="VIEW" action="" method="post" BaseTableName="CodeField">
        <gridview id="gvDetails" TableName="CodeField" Load="gvResult">
            <grid-command>
                <command CommandName="AddObject" CommandText="New"></command>
            </grid-command>
            <grid-column>
                <column PropertyName="->ObjectNumber" HeaderText="ObjectNumber"></column>
                <column PropertyName="->ObjectName" HeaderText="ObjectName"></column>
            </grid-column>
        </gridview>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="CodeField" Save="SaveObject">
        <div class="row">
            <div class="one-col">
                <input type="text" id="tbObjectNumber" name="->ObjectNumber" Caption="ObjectNumber" required="true" />
            </div>
        </div>
        <div class="row">
            <div class="one-col">
                <input type="text" id="tbObjectName" name="->ObjectName" Caption="ObjectName" required="true" />
            </div>
        </div>
    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>
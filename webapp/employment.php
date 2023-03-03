<?php
// this part is ui framework and seesion validate part
// do not start your code here
// all your code must start inside html tag

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['ISINITIALIZE'])) exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-head.php";

// data manipulate start here

$gvDetailsLoad = Employment::LoadList();

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

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-foot.php";

?>

<html>
<head>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-header.php"; ?>
</head>
<body class="frame">
    <form id="VIEW" action="" method="post" BaseTableName="Employment">
        <gridview id="gvDetails" TableName="Employment" Load="gvDetailsLoad">
            <grid-command>
                <command CommandName="AddObject" CommandText="New"></command>
            </grid-command>
            <grid-column>
                <column PropertyName="->Person->FamilyName" HeaderText="Last Name"></column>
                <column PropertyName="->Person->GivenName" HeaderText="First Name"></column>
                <column PropertyName="->Salary" HeaderText="Salary"></column>
                <column PropertyName="->CreatedBy" HeaderText="Created By"></column>
                <column PropertyName="->CreatedDateTimeText" HeaderText="Created DateTime"></column>
                <column PropertyName="->LastModifiedBy" HeaderText="Modified By"></column>
                <column PropertyName="->LastModifiedDateTimeText" HeaderText="Modified DateTime"></column>
            </grid-column>
        </gridview>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="Employment" Save="SaveObject">
        <input type="text" id="tbFamilyName" name="->Person->FamilyName" Caption="Family Name"/> <br/>
        <input type="text" id="tbGivenName" name="->Person->GivenName" Caption="Given Name" /> <br/>
        <input type="text" id="tbSalary" name="->Salary" Caption="Salary" /> <br/>
        <input type="datetime-local" id="dtCreatedDateTime" name="->CreatedDateTime" Caption="Created DateTime" /> <br/>

        <onetomany PropertyName="->Person->Phones">
            <grid-command>
                <command CommandName="AddObject" CommandText="New"></command>
            </grid-command>
            <grid-column>
                <column PropertyName="->ObjectNumber" HeaderText="Phone Number"/>
            </grid-column>
            <pop-up Caption="Phone">
                <input type="text" id="tbPhoneNumber" name="->ObjectNumber" Caption="Phone Number" />
            </pop-up>
        </onetomany>
    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>
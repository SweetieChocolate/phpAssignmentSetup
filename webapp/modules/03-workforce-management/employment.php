<?php
// this part is ui framework and seesion validate part
// do not start your code here
// all your code must start inside html tag

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['ISINITIALIZE'])) exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-head.php";

// data manipulate start here



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
        <gridview id="gvDetails" TableName="Employment">
            <grid-command>
                <command CommandName="AddObject" CommandText="New"></command>
            </grid-command>
            <grid-column>
                <column PropertyName="->ObjectNumber" HeaderText="Code" />
                <column PropertyName="->ObjectName" HeaderText="Name" />
                <column PropertyName="->Salary" HeaderText="Salary" />
            </grid-column>
        </gridview>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="Employment" Save="SaveObject">

        <div class="row">
            <div class="two-col">
                <input type="text" id="tbFamilyName" name="->Person->FamilyName" Caption="Family Name" />
            </div>
            <div class="two-col">
                <input type="text" id="tbGivenName" name="->Person->GivenName" Caption="Given Name" />
            </div>
        </div>

        <div class="row">
            <div class="one-col">
                <input type="date" id="tbBirthday" name="->Person->BirthDay" Caption="Birthday" />
            </div>
        </div>
        
        <div class="row">
            <div class="one-col">
                <input type="text" id="tbSalary" name="->Salary" Caption="Salary" />
            </div>
        </div>
        
        <div class="row">
            <div class="two-col">
                <onetomany PropertyName="->Person->Phones">
                    <grid-command>
                        <command CommandName="AddObject" CommandText="New"></command>
                    </grid-command>
                    <grid-column>
                        <column PropertyName="->ObjectNumber" HeaderText="Phone Number"/>
                    </grid-column>
                    <pop-up Size="modal-lg" Caption="Phone">
                        <input type="text" id="tbPhoneNumber" name="->ObjectNumber" Caption="Phone Number" />
                    </pop-up>
                </onetomany>
            </div>
            <div class="two-col">
                <onetomany PropertyName="->Person->Emails">
                    <grid-command>
                        <command CommandName="AddObject" CommandText="New"></command>
                    </grid-command>
                    <grid-column>
                        <column PropertyName="->ObjectNumber" HeaderText="Phone Number"/>
                    </grid-column>
                    <pop-up Size="modal-lg" Caption="Email">
                        <input type="text" id="tbEmail" name="->ObjectNumber" Caption="Email" />
                    </pop-up>
                </onetomany>
            </div>
        </div>

    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>
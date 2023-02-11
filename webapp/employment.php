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

function Save()
{
    $emp = BindFormToObject();
    $con = new DBConnection();
    $emp->save($con);
    $con->commit();
}

// function end here

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-foot.php";

?>

<html>
<head>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-header.php"; ?>
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        table tr th {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table tr td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <form id="VIEW" action="" method="post" BaseTableName="Employment">
        <b>this is a data manipulate test on employment table</b>
        <gridview id="gvDetails" TableName="Employment" Load="gvDetailsLoad">
            <grid-column>
                <column PropertyName="Person->FamilyName" HeaderText="Last Name"></column>
                <column PropertyName="Person->GivenName" HeaderText="First Name"></column>
                <column PropertyName="Salary" HeaderText="Salary"></column>
            </grid-column>
        </gridview>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="Employment" DataKey="0xe1eb3a4fa96b11edb45950ebf62b0b36">
        <label for="fname">Family Name:</label>
        <input type="text" id="fname" name="Person->FamilyName" value="DOV" /> <br/>
        <label for="lname">Given Name:</label>
        <input type="text" id="lname" name="Person->GivenName" value="Ratha" /> <br/>
        <label for="lname">Salary:</label>
        <input type="text" id="lname" name="Salary" value="0" /> <br/>
        <input type="submit" name="BUTTON" value="Add" />
        <input type="submit" name="BUTTON" value="Add and Close" />
        <input type="submit" name="BUTTON" value="Save" />
        <input type="submit" name="BUTTON" value="Save and Close" />
    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>
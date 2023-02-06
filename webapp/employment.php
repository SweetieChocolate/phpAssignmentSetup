<?php
// this part is ui framework and seesion validate part
// do not start your code here
// all your code must start inside html tag

if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['ISINITIALIZE']))
    exit();
    
require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui.php";

?>

<html>
<?php
// ur php code can be written here

if ($button != null)
{
    if (str_starts_with($button, "Save"))
    {
        $emp = Employment::Load("0xd217126aa61311ed831135aec8e00b93");
        foreach ($_POST as $key => $value)
        {
            ODataModel::SetPropertyValue($emp, $key, $value);
        }
        $con = new DBConnection();
        $emp->save($con);
        $con->commit();
    }
    if (str_ends_with($button, "Close"))
    {
        header("Location: $requestURI" . "?ACTION=VIEW");
    }
}

?>
<head>
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
<form id="VIEW" action="" method="post">
    <b>this is a data manipulate test on employment table</b>
    <gridview id="gvDetails" TableName="Employment">
        <column PropertyName="Person->FullName" HeaderText="Full Name"></column>
        <column PropertyName="Person->FamilyName" HeaderText="Last Name"></column>
        <column PropertyName="Person->GivenName" HeaderText="First Name"></column>
        <column PropertyName="Salary" HeaderText="Salary"></column>
    </gridview>
</form>
<form id="EDIT" action="" method="post">
    <label for="fname">Family Name:</label>
    <input type="text" id="fname" name="Person->FamilyName" value="DOV" /> <br/>
    <label for="lname">Given Name:</label>
    <input type="text" id="lname" name="Person->GivenName" value="Ratha" /> <br/>
    <label for="lname">Salary:</label>
    <input type="text" id="lname" name="Salary" value="0" /> <br/>
    <input type="submit" name="BUTTON" value="Save" />
    <input type="submit" name="BUTTON" value="SaveClose" />
</form>
</body>
</html>
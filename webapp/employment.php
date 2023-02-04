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
    <b>this is a data manipulate test on employment table</b>
    <gridview id="gvDetails" TableName="Employment">
        <column PropertyName="Person->FullName" HeaderText="Full Name"></column>
        <column PropertyName="Person->FamilyName" HeaderText="Last Name"></column>
        <column PropertyName="Person->GivenName" HeaderText="First Name"></column>
        <column PropertyName="Salary" HeaderText="Salary"></column>
    </gridview>
</body>
</html>
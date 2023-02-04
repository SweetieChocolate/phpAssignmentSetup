<?php
// this part is ui framework and seesion validate part
// do not start your code here
// all your code must start inside html tag

if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['ISINITIALIZE']))
    exit();

if(!isset($_GET['view']))
    require_once $_SESSION['PROJECTROOTPATH'] . "UIFramework/ui.php";

?>

<html>
<?php
// ur php code can be written here


?>
<head>
</head>
<body>
    <b>this is a test</b>
    <gridview id="gvDetails" TableName="Employment">
        <column PropertyName="Person->FullName" HeaderText="Full Name"></column>
        <column PropertyName="Person->FamilyName" HeaderText="Last Name"></column>
        <column PropertyName="Person->GivenName" HeaderText="First Name"></column>
    </gridview>
</body>
</html>
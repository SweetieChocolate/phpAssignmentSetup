<?php
session_start();
if (!isset($_SESSION['ROOTPATH']))
    die();
require_once $_SESSION['ROOTPATH'] . "validate-access.php";
?>
<html>
<head>
</head>
<body>
    <b>this is another test</b>
    <gridview id="gvDetails" TableName="Employment">
        <column PropertyName="Person->FullName" HeaderText="Full Name"></column>
        <column PropertyName="Person->FamilyName" HeaderText="Last Name"></column>
        <column PropertyName="Person->GivenName" HeaderText="First Name"></column>
    </gridview>
</body>
<script id="uiframework">
<?php
require_once $_SESSION['PROJECTROOT'] . "UIFramework/ui.php";
?>
</script>
</html>
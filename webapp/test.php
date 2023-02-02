<?php
session_start();
if (!isset($_SESSION['ROOTPATH']))
    die();
require_once $_SESSION['ROOTPATH'] . "validate-access.php";
?>
<html>
<script>

</script>
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
<script id="uiframework">
<?php
require_once $_SESSION['ROOTPATH'] . "UIFramework/ui.php";
?>
</script>
</html>
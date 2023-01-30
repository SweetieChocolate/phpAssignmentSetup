<html>
<head>

</head>
<body>
    <gridview id="gvDetails" TableName="Employment">
        <column PropertyName="Person->FullName" HeaderText="Full Name"></column>
        <column PropertyName="Person->FamilyName" HeaderText="Last Name"></column>
        <column PropertyName="Person->GivenName" HeaderText="First Name"></column>
    </gridview>
</body>
<script id="uiframework">
<?php
require_once "UIFramework/ui.php";
?>
</script>
</html>
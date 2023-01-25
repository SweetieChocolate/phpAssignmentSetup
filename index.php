<html>
<head>
    <script src="UIFramework/UIFramework.js" async> </script>
</head>
<body>
<grid-view id="abc" TableName="Employment">
    <column PropertyName="Person->FullName" HeaderText="Full Name"></column>
    <column PropertyName="Person->FamilyName" HeaderText="Last Name"></column>
    <column PropertyName="Person->GivenName" HeaderText="First Name"></column>
    <column PropertyName="Salary" HeaderText="Salary"></column>
</grid-view>
<table>
    <tr>
        <th>Will this affect by the grid-view style</th>
    </tr>
</table>
</body>
</html>
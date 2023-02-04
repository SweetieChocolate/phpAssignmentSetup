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

$emp = Employment::Load("0x70a71913a4af11ed89f550ebf62b0b36");
foreach ($_POST as $key => $value)
{
    ODataModel::SetPropertyValue($emp, $key, $value);
}
$con = new DBConnection();
$emp->save($con);
$con->commit();


?>
<head>
</head>
<body>
<form action="" method="post">
    <label for="fname">Family Name:</label>
    <input type="text" id="fname" name="Person->FamilyName" value="John" style="visibility: hidden;" /> <br/>
    <label for="lname">Given Name:</label>
    <input type="text" id="lname" name="Person->GivenName" value="Doe" /> <br/>
    <label for="lname">Salary:</label>
    <input type="text" id="lname" name="Salary" value="Doe" /> <br/>
    <input type="submit" value="Submit" />
</form>
</body>
</html>
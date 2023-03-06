<?php

session_start();

require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/LogicLayer.php";

$con = new DBConnection();

$query = <<<RAWQUERY
select per.GivenName as Position, count(*) as Count
from Employment emp
	left join Person per on emp.PositionID = per.ObjectID
group by per.GivenName
RAWQUERY;

$result = $con->ExecuteQuery($query);

while ($row = $result->fetch_assoc())
{
    echo $row['Position'] . " has " . $row['Count'] . "<br>";
}


?>
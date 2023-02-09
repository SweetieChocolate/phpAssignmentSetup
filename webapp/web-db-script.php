<?php

$whitelist = array("127.0.0.1", "::1");
if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist))
    return;

$webRoot = $_SESSION['WEB_ROOTURL_LOCAL'];
$table = $webRoot . "web-db-script-table.php";

$rawHTML = <<<RAWHTML
<a href="$table">Synchronize Table</a><br />
RAWHTML;

echo $rawHTML;

?>
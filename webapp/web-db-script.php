<?php

$_whitelist = array("127.0.0.1", "::1");
if (!in_array($_SERVER['REMOTE_ADDR'], $_whitelist))
    return;

$_webRoot = $_SESSION['WEB_ROOTURL_LOCAL'];
$_table = $_webRoot . "web-db-script-table.php";

$_rawHTML = <<<RAWHTML
<a href="$_table">Synchronize Table</a><br />
RAWHTML;

echo $_rawHTML;

?>
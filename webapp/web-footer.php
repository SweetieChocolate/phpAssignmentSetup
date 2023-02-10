<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

$_rootURL = $_SESSION['WEB_ROOTURL_LOCAL'];
$_rootSource = $_rootURL . "source";

$_rawscript = <<<RAWSCRIPT

<script src="$_rootSource/jquery.min.js"></script>
<script src="$_rootSource/bootstrap5/5.3.0/js/bootstrap.js"></script>
<script src="$_rootSource/fontawesome/6.3.0/js/all.min.js"></script>

<script src="$_rootSource/DataTables/1.13.2/js/jquery.dataTables.js"></script>

<script src="$_rootSource/js/popper.min.js"></script>

RAWSCRIPT;
echo $_rawscript;

?>
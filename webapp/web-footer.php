<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

$rootURL = $_SESSION['WEB_ROOTURL_LOCAL'];
$rootSource = $rootURL . "source";

$rawscript = <<<RAWSCRIPT

<script src="$rootSource/jquery.min.js"></script>
<script src="$rootSource/bootstrap5/5.3.0/js/bootstrap.js"></script>
<script src="$rootSource/fontawesome/6.3.0/js/all.min.js"></script>

<script src="$rootSource/DataTables/1.13.2/js/jquery.dataTables.js"></script>

<script src="$rootSource/js/popper.min.js"></script>

RAWSCRIPT;
echo $rawscript;

?>
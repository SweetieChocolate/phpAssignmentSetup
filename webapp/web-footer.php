<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

$rootURL = $_SESSION['WEB_ROOTURL_LOCAL'];
$rootCSS = $rootURL . "css";
$rootJS = $rootURL . "js";

$rawscript = <<<RAWSCRIPT
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script src="' . $rootJS/jquery.min.js"></script>
<script src="' . $rootJS/popper.min.js"></script>
<script src="' . $rootJS/bootstrap.js"></script>
RAWSCRIPT;
echo $rawscript;

?>
<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

$rootURL = $_SESSION['WEB_ROOTURL_LOCAL'];
$rootCSS = $rootURL . "css";
$rootJS = $rootURL . "js";

$rawscript = <<<RAWSCRIPT
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="assets/helping-hand.png" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<link rel="stylesheet" href="$rootCSS/bootstrap.css">
<link rel="stylesheet" href="$rootCSS/style.css">
RAWSCRIPT;
echo $rawscript;

?>
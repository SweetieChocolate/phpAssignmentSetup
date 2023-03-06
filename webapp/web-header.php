<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

$_rootURL = $_SESSION['WEB_ROOTURL_LOCAL'];
$_rootSource = $_rootURL . "source";

$_rawscript = <<<RAWSCRIPT

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="assets/helping-hand.png" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="$_rootSource/bootstrap5/5.3.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="$_rootSource/fontawesome/6.3.0/css/all.min.css">
<link rel="stylesheet" type="text/css" href="$_rootSource/boxicons/2.1.4/css/boxicons.min.css">
<link rel="stylesheet" type="text/css" href="$_rootSource/DataTables/1.13.2/css/jquery.dataTables.css">

<link rel="stylesheet" type="text/css" href="$_rootSource/home.css">
<link rel="stylesheet" type="text/css" href="$_rootSource/style.css">

RAWSCRIPT;
echo $_rawscript;

?>
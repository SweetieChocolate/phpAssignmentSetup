<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

$rawscript = '';
$rawscript .= PHP_EOL . '<meta charset="UTF-8">';
$rawscript .= PHP_EOL . '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
$rawscript .= PHP_EOL . '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
$rawscript .= PHP_EOL . '<link rel="icon" type="image/x-icon" href="assets/helping-hand.png" />';
$rawscript .= PHP_EOL . '<link rel="preconnect" href="https://fonts.googleapis.com">';
$rawscript .= PHP_EOL . '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
$rawscript .= PHP_EOL . '<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">';
$rawscript .= PHP_EOL . '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">';
$rawscript .= PHP_EOL . '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">';

$rawscript .= PHP_EOL . '<link rel="stylesheet" href="' . $_SESSION['WEB_ROOTURL_LOCAL'] . 'css/bootstrap.css">';
$rawscript .= PHP_EOL . '<link rel="stylesheet" href="' . $_SESSION['WEB_ROOTURL_LOCAL'] . 'css/style.css">';

echo $rawscript;

?>
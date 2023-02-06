<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

$rawscript = '';
$rawscript .= PHP_EOL . '<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>';
$rawscript .= PHP_EOL . '<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>';

$rawscript .= PHP_EOL . '<script src="' . $_SESSION['WEB_ROOTURL_LOCAL'] . 'js/jquery.min.js"></script>';
$rawscript .= PHP_EOL . '<script src="' . $_SESSION['WEB_ROOTURL_LOCAL'] . 'js/popper.min.js"></script>';
$rawscript .= PHP_EOL . '<script src="' . $_SESSION['WEB_ROOTURL_LOCAL'] . 'js/bootstrap.js"></script>';

echo $rawscript;

?>
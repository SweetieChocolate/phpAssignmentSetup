<?php

require_once "ui-handle.php";

// MANIPULATE DATA

require_once "gridview.php";


require_once "onetomany.php";

// ALL UI FRAMEWORK MUST END HERE



// store raw html into a string
$_result = $_dom->saveXML($_dom->documentElement, LIBXML_NOEMPTYTAG);
$_result = str_replace("</br>", "", $_result);
$_result = str_replace("~/", $_SESSION['WEB_ROOTURL_LOCAL'], $_result);

// save the result html to a temp file
$_tmpfile = substr(str_replace("/", "_", $_requestURI), 1);
$_filepath = $_tmpdir . $_tmpfile;
file_put_contents($_filepath, $_result);
include($_filepath);

// exit to prevent the html code in main file being display
// because at this time everything should already display by include($_filepath);
exit();

?>
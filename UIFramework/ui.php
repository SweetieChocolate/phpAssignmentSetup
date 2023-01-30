<?php

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $rooturl = "https";
else
    $rooturl = "http";
$rooturl .= "://";
$rooturl .= $_SERVER['HTTP_HOST'];
$rootpath = $_SERVER['DOCUMENT_ROOT'];

$tempdir = "/temp";
$tmppath = $rootpath . $tempdir;
if (!is_dir($tmppath))
    mkdir($tmppath);
session_save_path($tmppath);

$uri = $_SERVER['REQUEST_URI'];
$path = $rootpath . $uri;

$doc = new DOMDocument();
$doc->validateOnParse = true;
$doc->load($path, LIBXML_NOEMPTYTAG);
$xpath = new DOMXPath($doc);

session_start();
$sid = session_id();

// ALL UI FRAMEWORK MUST START HERE





// ALL UI FRAMEWORK MUST END HERE

// remove the php ui framework to prevent infinite loop
//$uiscript = $doc->getElementById("uiframework");
$uiscript = $xpath->query("//*[@id='uiframework']")->item(0);
$uiscript->parentNode->removeChild($uiscript);

// use current session id as temp file
$tempfile = $sid . ".php";

// save the result html to a temp file
$doc->saveHTMLFile($rootpath . $tempdir . "/" . $tempfile);

// get actual url of the temp file
$link = $rooturl . $tempdir . "/" . $tempfile;

// redirect to the temp file that just save
echo "document.location.href = '" . $link . "';";

?>
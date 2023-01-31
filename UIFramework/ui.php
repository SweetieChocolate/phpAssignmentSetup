<?php
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
$sid = session_id();

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $rooturl = "https";
else
    $rooturl = "http";
$rooturl .= "://";
$rooturl .= $_SERVER['HTTP_HOST'];

$rootpath = $_SERVER['DOCUMENT_ROOT'];

$tmpdir = "/tmp";

$tmppath = $rootpath . $tmpdir;
if (!is_dir($tmppath))
    mkdir($tmppath);
//session_save_path($tmppath);

$tmpdir .= "/";
$tmppath .= "/";

$uri = $_SERVER['REQUEST_URI'];
$path = $rootpath . $uri;

$doc = new DOMDocument();
$doc->formatOutput = true;
$doc->loadHTMLFile($path, LIBXML_NOEMPTYTAG);
$xpath = new DOMXPath($doc);

// ALL UI FRAMEWORK MUST START HERE

// MANIPULATE DATA




// ALL UI FRAMEWORK MUST END HERE

// remove the php ui framework to prevent infinite loop
//$uiscript = $doc->getElementById("uiframework");
$uiscript = $xpath->query("//*[@id='uiframework']")->item(0);
$uiscript->parentNode->removeChild($uiscript);

// use current session id as temp file
$tmpfile = $sid . ".php";

// save the result html to a temp file
$doc->saveHTMLFile($tmppath . $tmpfile);

// get actual url of the temp file
$link = $tmpdir . $tmpfile;

// redirect to the temp file that just save
echo "document.location.href = '" . $link . "';";

?>
<?php
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
if (!isset($_SESSION['ROOTPATH']))
    die();
require_once $_SESSION['ROOTPATH'] . "validate-access.php";

$sid = session_id();

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $rooturl = "https";
else
    $rooturl = "http";
$rooturl .= "://";
$rooturl .= $_SERVER['HTTP_HOST'];

$tmpdir = "tmp";
$tmppath = $_SESSION['ROOTPATH'] . $tmpdir;

if (!is_dir($tmppath))
{
    if (!mkdir($tmppath))
    {
        //echo "failed to make directory $tmppath \n";
    }
}

$tmpdir .= "/" . $sid;
$tmppath .= "/" . $sid;

if (!is_dir($tmppath))
{
    if (!mkdir($tmppath))
    {
        //echo "failed to make directory $tmppath \n";
    }
}

//session_save_path($tmppath);
$tmpdir .= "/";
$tmppath .= "/";

$path = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];
$doc = new DOMDocument();
$doc->formatOutput = true;
$doc->load($path, LIBXML_NOEMPTYTAG);
$xpath = new DOMXPath($doc);

// ALL UI FRAMEWORK MUST START HERE

// MANIPULATE DATA




// ALL UI FRAMEWORK MUST END HERE

// remove the php ui framework to prevent infinite loop
//$uiscript = $doc->getElementById("uiframework");
$uiscript = $xpath->query("//*[@id='uiframework']")->item(0);
$uiscript->parentNode->removeChild($uiscript);

// use current session id as temp file
$tmpfile = substr(str_replace("/", "_", $uri), 1);

// save the result html to a temp file
$doc->save($tmppath . $tmpfile, LIBXML_NOEMPTYTAG);

//echo $tmppath . $tmpfile . "\n";

// get actual url of the temp file
$link = $_SESSION['ROOTURI'] . $tmpdir . $tmpfile;

// redirect to the temp file that just save
echo "document.location.href = '" . $link . "';";

?>
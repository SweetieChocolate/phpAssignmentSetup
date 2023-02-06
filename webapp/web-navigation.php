<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/TablesLogic.php";

$functionName = "changeFrame";

function GetClassIcon(string $text)
{
    switch ($text)
    {
        case "WORKFORCR MANAGEMENT":
            return "fa fa-users";
        default:
            return "fa fa-users";
    }
}

function GenerateNavigation(string $class, string $text, string $url)
{
    global $functionName;
    $url = str_replace("~/", $_SESSION['WEB_ROOTURL_LOCAL'], $url);

    $rawHTML = '
<a href="' . $url . '" onclick="event.preventDefault(); ' . $functionName . '(this)">
    <i id="icon" class="' . $class . '" aria-hidden="true"></i>
    <span class="link_name">' . $text . '</span>
</a>';

    return $rawHTML;
}

function GenerateNavigationDropDownParentChild(string $class, string $category, string $text, string $url)
{
    global $functionName;
    $url = str_replace("~/", $_SESSION['WEB_ROOTURL_LOCAL'], $url);

    $rawHTML = '
<li>
    <a href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i id="icon" class="' . $class . '" aria-hidden="true"></i>
        <span class="link_name">' . $category . '</span>
        <i class="down-arrow fa-solid fa-angle-down"></i>
    </a>
    <ul category="' . $category . '" class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="' . $url . '" onclick="event.preventDefault(); ' . $functionName . '(this)"></a>'. $text .'</li>
    </ul>
</li>';

    $result = new DOMDocument();
    $result->loadXML($rawHTML, LIBXML_NOEMPTYTAG);
    return $result->documentElement;
}

function GenerateNavigationDropDownChild(string $text, string $url)
{
    global $functionName;
    $url = str_replace("~/", $_SESSION['WEB_ROOTURL_LOCAL'], $url);

    $rawHTML = '<li><a class="dropdown-item" href="' . $url . '" onclick="event.preventDefault(); ' . $functionName . '(this)"></a>' . $text . '</li>';

    $result = new DOMDocument();
    $result->loadXML($rawHTML, LIBXML_NOEMPTYTAG);
    return $result->documentElement;
}

$navigation = new DOMDocument();
$navigation->loadXML('<ul class="nav_list"></ul>', LIBXML_NOEMPTYTAG);


// dynamically load the Function Modules base on user permission
$functions = OFunctionModule::GetAvailableFunction(UUID::New());

foreach ($functions as $f)
{
    $cate = $f->Category;

    $xpath = new DOMXPath($navigation);
    $curCat = $xpath->query("//*[@category='$cate']");

    if ($curCat->length > 0)
    {
        $catul = $curCat->item(0);
        $li = GenerateNavigationDropDownChild($f->FunctionName, $f->URL);
        $catul->appendChild($navigation->importNode($li, true));
    }
    else
    {
        $class = GetClassIcon($cate);
        $mainli = GenerateNavigationDropDownParentChild($class, $cate, $f->FunctionName, $f->URL);
        $navigation->documentElement->appendChild($navigation->importNode($mainli, true));
    }
}

echo $navigation->saveXML($navigation->documentElement, LIBXML_NOEMPTYTAG);

?>
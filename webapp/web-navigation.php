<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/TablesLogic.php";

function GetClassIcon(string $text)
{
    switch ($text)
    {
        case "WORKFORCR MANAGEMENT":
            return "fa fa-users";
        case "PAYROLL":
            return "fa fa-money-bill";
        default:
            return "fa fa-users";
    }
}

function GenerateNavigation(string $class, string $functionName, string $url)
{
    $rawHTML = <<<RAWHTML
<a href="[URL]" onclick="event.preventDefault(); [ChangeFrameFunctionName](this)">
    <i id="icon" class="[Class]" aria-hidden="true"></i>
    <span class="link_name">[FunctionName]</span>
</a>
RAWHTML;

    $rawHTML = str_replace("[Class]", $class, $rawHTML);
    $rawHTML = str_replace("[FunctionName]", $functionName, $rawHTML);
    $rawHTML = str_replace("[URL]", $url, $rawHTML);
    return $rawHTML;
}

function GenerateNavigationDropDownParentChild(string $class, string $category, string $functionName, string $url)
{
    $rawHTML = <<<RAWHTML
<li>
    <a href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i id="icon" class="[Class]" aria-hidden="true"></i>
        <span class="link_name">[Category]</span>
        <i class="down-arrow fa-solid fa-angle-down"></i>
    </a>
    <ul category="[Category]" class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="[URL]" onclick="event.preventDefault(); [ChangeFrameFunctionName](this)"></a>[FunctionName]</li>
    </ul>
</li>
RAWHTML;

    $rawHTML = str_replace("[Class]", $class, $rawHTML);
    $rawHTML = str_replace("[Category]", $category, $rawHTML);
    $rawHTML = str_replace("[FunctionName]", $functionName, $rawHTML);
    $rawHTML = str_replace("[URL]", $url, $rawHTML);

    $result = new DOMDocument();
    $result->loadXML($rawHTML, LIBXML_NOEMPTYTAG);
    return $result->documentElement;
}

function GenerateNavigationDropDownChild(string $functionName, string $url)
{
    $rawHTML = <<<RAWHTML
<li><a class="dropdown-item" href="[URL]" onclick="event.preventDefault(); [ChangeFrameFunctionName](this)"></a>[FunctionName]</li>
RAWHTML;

    $rawHTML = str_replace("[FunctionName]", $functionName, $rawHTML);
    $rawHTML = str_replace("[URL]", $url, $rawHTML);
    
    $result = new DOMDocument();
    $result->loadXML($rawHTML, LIBXML_NOEMPTYTAG);
    return $result->documentElement;
}

$navigation = new DOMDocument();
$navigation->loadXML('<ul class="nav_list"></ul>', LIBXML_NOEMPTYTAG);


// dynamically load the Function Modules base on user permission
$functions = OFunctionModule::GetAvailableFunction($_SESSION['USERID']);

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

$navigationHTML = $navigation->saveXML($navigation->documentElement, LIBXML_NOEMPTYTAG);
$navigationHTML = str_replace("~/", $_SESSION['WEB_ROOTURL_LOCAL'], $navigationHTML);
$navigationHTML = str_replace("[ChangeFrameFunctionName]", "changeFrame", $navigationHTML);
echo $navigationHTML;

?>
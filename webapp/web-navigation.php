<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/TablesLogic.php";

function GetClassIcon(string $_text)
{
    switch ($_text)
    {
        case "WORKFORCR MANAGEMENT":
            return "fa fa-users";
        case "PAYROLL":
            return "fa fa-money-bill";
        default:
            return "fa fa-users";
    }
}

function GenerateNavigation(string $_class, string $_functionName, string $_url)
{
    $_rawHTML = <<<RAWHTML
<a href="[URL]" onclick="event.preventDefault(); [ChangeFrameFunctionName](this)">
    <i id="icon" class="[Class]" aria-hidden="true"></i>
    <span class="link_name">[FunctionName]</span>
</a>
RAWHTML;

    $_rawHTML = str_replace("[Class]", $_class, $_rawHTML);
    $_rawHTML = str_replace("[FunctionName]", $_functionName, $_rawHTML);
    $_rawHTML = str_replace("[URL]", $_url, $_rawHTML);
    return $_rawHTML;
}

function GenerateNavigationDropDownParentChild(string $_class, string $_category, string $_functionName, string $_url)
{
    $_rawHTML = <<<RAWHTML
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

    $_rawHTML = str_replace("[Class]", $_class, $_rawHTML);
    $_rawHTML = str_replace("[Category]", $_category, $_rawHTML);
    $_rawHTML = str_replace("[FunctionName]", $_functionName, $_rawHTML);
    $_rawHTML = str_replace("[URL]", $_url, $_rawHTML);

    $_result = new DOMDocument();
    $_result->loadXML($_rawHTML, LIBXML_NOEMPTYTAG);
    return $_result->documentElement;
}

function GenerateNavigationDropDownChild(string $_functionName, string $_url)
{
    $_rawHTML = <<<RAWHTML
<li><a class="dropdown-item" href="[URL]" onclick="event.preventDefault(); [ChangeFrameFunctionName](this)"></a>[FunctionName]</li>
RAWHTML;

    $_rawHTML = str_replace("[FunctionName]", $_functionName, $_rawHTML);
    $_rawHTML = str_replace("[URL]", $_url, $_rawHTML);
    
    $_result = new DOMDocument();
    $_result->loadXML($_rawHTML, LIBXML_NOEMPTYTAG);
    return $_result->documentElement;
}

$_navigation = new DOMDocument();
$_navigation->loadXML('<ul class="nav_list"></ul>', LIBXML_NOEMPTYTAG);


// dynamically load the Function Modules base on user permission
$_functions = OFunctionModule::GetAvailableFunction($_SESSION['USERID']);

foreach ($_functions as $_f)
{
    $_cate = $_f->Category;

    $_xpath = new DOMXPath($_navigation);
    $_curCat = $_xpath->query("//*[@category='$_cate']");

    if ($_curCat->length > 0)
    {
        $_catul = $_curCat->item(0);
        $_li = GenerateNavigationDropDownChild($_f->FunctionName, $_f->URL);
        $_catul->appendChild($_navigation->importNode($_li, true));
    }
    else
    {
        $_class = GetClassIcon($_cate);
        $_mainli = GenerateNavigationDropDownParentChild($_class, $_cate, $_f->FunctionName, $_f->URL);
        $_navigation->documentElement->appendChild($_navigation->importNode($_mainli, true));
    }
}

$_navigationHTML = $_navigation->saveXML($_navigation->documentElement, LIBXML_NOEMPTYTAG);
$_navigationHTML = str_replace("~/", $_SESSION['WEB_ROOTURL_LOCAL'], $_navigationHTML);
$_navigationHTML = str_replace("[ChangeFrameFunctionName]", "changeFrame", $_navigationHTML);
echo $_navigationHTML;

?>
<?php

if (session_status() === PHP_SESSION_NONE) session_start();

require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/LogicLayer.php";

function GetIconByFunctionName(string $_text)
{
    switch ($_text)
    {
        case "WORKFORCE MANAGEMENT":
            return "fa fa-users";
        case "PAYROLL":
            return "fa fa-money-bill";
        case "IT ADMINISTATION":
            return "fa-solid fa-gear";
        default:
            return "fa-solid fa-gear";
    }
}

function GetIconByCategory(string $_text)
{
    switch ($_text)
    {
        case "WORKFORCE MANAGEMENT":
            return "fa fa-users";
        case "PAYROLL":
            return "fa fa-money-bill";
        case "IT ADMINISTATION":
            return "fa-solid fa-gear";
        default:
            return "fa-solid fa-gear";
    }
}

function GenerateNavigationWithoutDropDown(string $_icon, string $_functionName, string $_url)
{
    $_rawHTML = <<<RAWHTML
<li>
    <a href="[URL]">
        <i class="[Icon]"></i>
        <span class="category_name">[FunctionName]</span>
    </a>
    <ul class="sub-menu blank">
        <li><a href="[URL]" class="category_name">[FunctionName]</a></li>
    </ul>
</li>
RAWHTML;

    $_rawHTML = str_replace("[Icon]", $_icon, $_rawHTML);
    $_rawHTML = str_replace("[FunctionName]", $_functionName, $_rawHTML);
    $_rawHTML = str_replace("[URL]", $_url, $_rawHTML);
    
    $_result = new DOMDocument();
    $_result->loadXML($_rawHTML, LIBXML_NOEMPTYTAG);
    return $_result->documentElement;
}

function GenerateNavigationDropDownParentChild(string $_icon, string $_category, string $_functionName, string $_url)
{
    $_rawHTML = <<<RAWHTML
<li onclick="if(!this.parentElement.parentElement.classList.contains('close')){this.classList.toggle('showMenu')}">
    <div class="nav-link">
        <a>
            <i class="[Icon]"></i>
            <span class="category_name">[Category]</span>
        </a>
        <i class='bx bxs-chevron-down arrow'></i>
    </div>
    <ul category="[Category]" class="sub-menu">
        <li><a class="category_name">[Category]</a></li>
        <li><a href="[URL]">[FunctionName]</a></li>
    </ul>
</li>
RAWHTML;

    $_rawHTML = str_replace("[Icon]", $_icon, $_rawHTML);
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
<li><a href="[URL]">[FunctionName]</a></li>
RAWHTML;

    $_rawHTML = str_replace("[FunctionName]", $_functionName, $_rawHTML);
    $_rawHTML = str_replace("[URL]", $_url, $_rawHTML);
    
    $_result = new DOMDocument();
    $_result->loadXML($_rawHTML, LIBXML_NOEMPTYTAG);
    return $_result->documentElement;
}

$_navigation = new DOMDocument();
$_navigation->loadXML('<ul class="navigation"></ul>', LIBXML_NOEMPTYTAG);


// dynamically load the Function Modules base on user permission
$_functions = OFunctionModule::GetAvailableFunction(StringDecryption($_SESSION['USERID'], session_id()));

foreach ($_functions as $_f)
{
    $_cate = $_f->Category;

    if ($_cate == "")
    {
        $_icon = GetIconByFunctionName($_f->FunctionName);
        $_mainli = GenerateNavigationWithoutDropDown($_icon, $_f->FunctionName, $_f->URL);
        $_navigation->documentElement->appendChild($_navigation->importNode($_mainli, true));
    }
    else
    {
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
            $_icon = GetIconByCategory($_cate);
            $_mainli = GenerateNavigationDropDownParentChild($_icon, $_cate, $_f->FunctionName, $_f->URL);
            $_navigation->documentElement->appendChild($_navigation->importNode($_mainli, true));
        }
    }
}

$_navigationHTML = $_navigation->saveXML($_navigation->documentElement, LIBXML_NOEMPTYTAG);
$_navigationHTML = str_replace("~/", $_SESSION['WEB_ROOTURL_LOCAL'], $_navigationHTML);
$_navigationHTML = str_replace("[ChangeFrameFunctionName]", "changeFrame", $_navigationHTML);
echo $_navigationHTML;

?>
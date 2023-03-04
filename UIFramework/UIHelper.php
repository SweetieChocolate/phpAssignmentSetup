<?php

function GetAndUnsetPOST(string $key)
{
    if (isset($_POST[$key]))
    {
        $value = $_POST[$key];
        unset($_POST[$key]);
        return $value;
    }
    return null;
}

function GetAndUnsetGET(string $key)
{
    if (isset($_GET[$key]))
    {
        $value = $_GET[$key];
        unset($_GET[$key]);
        return $value;
    }
    return null;
}

function RemoveSelfNode(DOMNode $node)
{
    $node->parentNode->removeChild($node);
}

function ClearNodeChild(DOMNode $parent)
{
    while ($parent->hasChildNodes())
    {
        $parent->removeChild($parent->firstChild);
    }
}

function GetAllAttributes(DOMNode $element) : array
{
    $attrs = array();
    if ($element->hasAttributes())
    {
        foreach ($element->attributes as $attr)
        {
            $name = $attr->nodeName;
            $value = $attr->nodeValue;
            $attrs[$name] = $value;
        }
    }
    return $attrs;
}

function DOMNodeToDOMElement(DOMNode $node) : DOMElement | null
{
    if ($node->nodeType === XML_ELEMENT_NODE)
        return $node;
    return null;
}

function GetAttribute(DOMNode $node, string $attr) : string | null
{
    if ($element = DOMNodeToDOMElement($node))
        return $element->getAttribute($attr);
    $result = $node->attributes->getNamedItem($attr);
    if ($result != null)
        return $result->nodeValue;
    return null;
}

function GetAllChildNodes(DOMNode $element) : DOMNodeList
{
    return $element->childNodes;
}

function GetAllChildNodesByTagName(DOMNode $element, string $tagName) : array
{
    $children = array();
    foreach ($element->childNodes as $child)
    {
        if ($child->nodeName == $tagName)
        {
            array_push($children, $child);
        }
    }
    return $children;
}

function GetApplicableValueFromObjetToForm($_value, string $_type) : string
{
    if ($_value == null) return "";

    if (is_a($_value, "DateTime"))
    {
        if ($_type == "date")
            $_value = DateTimeHelper::ConvertForFormDate($_value);
        if ($_type == "datetime-local")
            $_value = DateTimeHelper::ConvertForFormDateTime($_value);
    }

    return $_value;
}

function GetApplicableValueFromFormToObject(string $_value, string $_type) : mixed
{
    if ($_value == null) return null;

    switch ($_type)
    {
        case "DateTime": $_value = DateTimeHelper::FromString($_value);
    }

    return $_value;
}

?>
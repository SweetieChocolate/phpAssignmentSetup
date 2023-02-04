<?php

function ClearElementChild(DOMElement $parent)
{
    while ($parent->hasChildNodes())
    {
        $parent->removeChild($parent->firstChild);
    }
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

function GetAttribute(DOMNode $element, string $attr) : string | null
{
    $node = $element->attributes->getNamedItem($attr);
    if ($node != null)
        return $node->nodeValue;
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

?>
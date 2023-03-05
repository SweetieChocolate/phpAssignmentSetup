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
    if ($_type == "checkbox")
        return "1";
        
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

function ClearFormValue(DOMNode $_sourceForm) : DOMNode
{
    $_sourceDocument = new DOMDocument();
    $_sourceDocument->loadXML($_sourceForm->ownerDocument->saveXML($_sourceForm, LIBXML_NOEMPTYTAG));
    $_sourceXPath = new DOMXPath($_sourceDocument);
    foreach ($_sourceXPath->query("//input") as $input)
    {
        $input->setAttribute("value", "");
    }
    return $_sourceDocument->documentElement;
}

function GeneratePopUpEditForm(DOMNode $_sourceForm, string $_encryptedObjectID, string $_propertyName, string $_caption, string $_size = "") : DOMNode | null
{
    global $_requestURIWithGetVar;
    $_requestURIXML = htmlspecialchars($_requestURIWithGetVar, ENT_QUOTES);
    $_sourceFormString = $_sourceForm->ownerDocument->saveXML($_sourceForm, LIBXML_NOEMPTYTAG);
    $_rawPopUp = <<<RAW
    <div class="modal fade" id="EDIT$_encryptedObjectID" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered $_size">
            <div class="modal-content">
                <form action="$_requestURIXML" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">$_caption</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="_PropertyName" name="PropertyName" value="$_propertyName" />
                        <input type="hidden" id="_EncryptedObjectID" name="OTMDataKey" value="$_encryptedObjectID" />
                        $_sourceFormString
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="BUTTON" value="SaveOTM">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    RAW;
    $_domDocument = new DOMDocument();
    $_domDocument->loadXML($_rawPopUp, LIBXML_NOEMPTYTAG);
    return $_domDocument->documentElement;
}

function GeneratePopUpDeleteForm(string $_encryptedObjectID, string $_propertyName, string $_size = "") : DOMNode | null
{
    global $_requestURIWithGetVar, $_deleteConfirmMsg;
    $_requestURIXML = htmlspecialchars($_requestURIWithGetVar, ENT_QUOTES);
    $_rawPopUp = <<<RAW
    <div class="modal fade" id="DELETE$_encryptedObjectID" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered $_size">
            <div class="modal-content">
                <form action="$_requestURIXML" method="post">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="_PropertyName" name="PropertyName" value="$_propertyName" />
                        <input type="hidden" id="_EncryptedObjectID" name="OTMDataKey" value="$_encryptedObjectID" />
                        $_deleteConfirmMsg
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="BUTTON" value="DeleteOTM">Yes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    RAW;
    $_domDocument = new DOMDocument();
    $_domDocument->loadXML($_rawPopUp, LIBXML_NOEMPTYTAG);
    return $_domDocument->documentElement;
}

function GenerateBlankPopUpEditForm(DOMNode $_sourceForm, string $_id, string $_propertyName, string $_caption, string $_size = "") : DOMNode | null
{
    global $_requestURIWithGetVar;
    $_requestURIXML = htmlspecialchars($_requestURIWithGetVar, ENT_QUOTES);
    $_sourceFormString = $_sourceForm->ownerDocument->saveXML($_sourceForm, LIBXML_NOEMPTYTAG);
    $_rawPopUp = <<<RAW
    <div class="modal fade" id="$_id" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered $_size">
            <div class="modal-content">
                <form action="$_requestURIXML" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">$_caption</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="_PropertyName" name="PropertyName" value="$_propertyName" />
                        $_sourceFormString
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="BUTTON" value="SaveOTM">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    RAW;
    $_domDocument = new DOMDocument();
    $_domDocument->loadXML($_rawPopUp, LIBXML_NOEMPTYTAG);
    return $_domDocument->documentElement;
}

?>
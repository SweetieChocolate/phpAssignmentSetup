<?php

$_onetomanys = $_dom->getElementsByTagName("onetomany");
if ($_onetomanys->length <= 0) return;
$_object = GetCurrentObject();
if ($_object == null) return;
foreach ($_onetomanys as $_onetomany)
{
    $_popup = $_onetomany->getElementsByTagName("pop-up");
    $_popup = $_popup->length > 0 ? $_popup->item(0) : null;
    $_popupCaption = "";
    $_popupblank = null;

    $_attrs = GetAllAttributes($_onetomany);
    $_grid_columns = GetAllChildNodesByTagName($_onetomany, "grid-column");
    $_popupArray = array();
    if (count($_grid_columns) > 0)
    {
        $_grid_column = $_grid_columns[0];
        $_columns = GetAllChildNodesByTagName($_grid_column, "column");
    
        $_table = $_dom->createElement("table");
        $_table->setAttribute("class", "onetomany");
        
        $_thead = $_dom->createElement("thead");

        // append all the header text
        $_row = $_dom->createElement("tr");
        
        // append an empty column for edit button
        $_col = $_dom->createElement("th");
        $_col->setAttribute("width", $_buttonWidth);
        $_row->appendChild($_col);

        // append an empty column for delete button
        $_col = $_dom->createElement("th");
        $_col->setAttribute("width", $_buttonWidth);
        $_row->appendChild($_col);

        foreach ($_columns as $_column)
        {
            $_headertext = GetAttribute($_column, "HeaderText");
            if ($_headertext == null)
                $_headertext = $_nulltext;
            $_col = $_dom->createElement("th", $_headertext);
            $_row->appendChild($_col);
        }
        $_thead->appendChild($_row);
        $_table->appendChild($_thead);
    
        $_tbody = $_dom->createElement("tbody");
        // check if one to many link to any prop
        if (array_key_exists('PropertyName', $_attrs))
        {
            $_propertyName = $_attrs['PropertyName'];
            $_list = ODataModel::GetPropertyValue($_object, substr($_propertyName, 2));
            if ($_list == null) continue;
            if ($_popup != null)
            {
                $_popupCaption = GetAttribute($_popup, "Caption");
                $_popupCaption = $_popupCaption ?? "";
                $_popupblank = GenerateBlankPopUpEditForm($_popup, $_propertyName, $_propertyName, $_popupCaption);
            }
            // add every row data to table by property name
            foreach ($_list as $_item)
            {
                if ($_item->IsDeleted == true) continue;
                $_row = $_dom->createElement("tr");

                $_datakey = $_item->ObjectID->Encrypt($_sid);

                // edit button
                $_editbutton = $_dom->createElement("i");
                $_editbutton->setAttribute("class", $_editButton);
                $_editbutton->setAttribute("data-bs-toggle", "modal");
                $_editbutton->setAttribute("data-bs-target", "#EDIT".$_datakey);
                $_col = $_dom->createElement("td");
                $_col->appendChild($_editbutton);
                $_row->appendChild($_col);

                // delete button
                $_deletebutton = $_dom->createElement("i");
                $_deletebutton->setAttribute("class", $_deleteButton);
                $_deletebutton->setAttribute("data-bs-toggle", "modal");
                $_deletebutton->setAttribute("data-bs-target", "#DELETE".$_datakey);
                $_col = $_dom->createElement("td");
                $_col->appendChild($_deletebutton);
                $_row->appendChild($_col);

                foreach ($_columns as $_column)
                {
                    $_propName = GetAttribute($_column, "PropertyName");
                    $_valuetext = ODataModel::GetPropertyValue($_item, substr($_propName, 2));
                    if ($_valuetext == null)
                        $_valuetext = $_nulltext;
                    $_col = $_dom->createElement("td", $_valuetext);
                    $_row->appendChild($_col);
                }
                $_tbody->appendChild($_row);

                if ($_popup != null)
                {
                    $_popupModal = BindObjectToForm_OTM($_item, $_popup);
                    $_popupEditItem = GeneratePopUpEditForm($_popupModal, $_datakey, $_propertyName, $_popupCaption);
                    $_body->insertBefore($_dom->importNode($_popupEditItem, true), $_formedit);
                }

                $_popupDeleteItem = GeneratePopUpDeleteForm($_datakey, $_propertyName);
                $_body->insertBefore($_dom->importNode($_popupDeleteItem, true), $_formedit);
            }
        }
        $_table->appendChild($_tbody);
        if ($_popup != null) RemoveSelfNode($_popup);
        $_grid_column->parentNode->replaceChild($_table, $_grid_column);
    }
    
    $_grid_commands = GetAllChildNodesByTagName($_onetomany, "grid-command");
    if (count($_grid_commands) > 0)
    {
        $_grid_command = $_grid_commands[0];
        $_commands = GetAllChildNodesByTagName($_grid_command, "command");
        foreach ($_commands as $_command)
        {
            $_commandname = GetAttribute($_command, "CommandName");
            $_commandtext = GetAttribute($_command, "CommandText");
            $_commandtext = $_commandtext ?? "";
            $_button = $_dom->createElement("button", $_commandtext);
            $_button->setAttribute("type", "button");
            $_button->setAttribute("class", "btn btn-primary");
            $_button->setAttribute("style", "margin: 10px;");
            if ($_commandname == "AddObject" && $_popupblank != null)
            {
                $_button->setAttribute("data-bs-toggle", "modal");
                $_button->setAttribute("data-bs-target", "#".$_propertyName);
                $_body->insertBefore($_dom->importNode($_popupblank, true), $_formedit);
            }
            $_onetomany->parentNode->insertBefore($_button, $_onetomany);
        }

        RemoveSelfNode($_grid_command);
    }
}

?>
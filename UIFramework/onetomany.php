<?php

$_element = $_dom->getElementsByTagName("onetomany");
if ($_element->length <= 0) return;
$_object = isset($_COOKIE[$_cookiename]) ? unserialize($_COOKIE[$_cookiename]) : $_object;
if ($_object == null) return;
foreach ($_element as $_ele)
{
    $_attrs = GetAllAttributes($_ele);
    $_grid_columns = GetAllChildNodesByTagName($_ele, "grid-column");
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
        $_col->setAttribute("width", $_SESSION['BUTTON_WIDTH_SIZE']);
        $_row->appendChild($_col);
        // append an empty column for delete button
        $_col = $_dom->createElement("th");
        $_col->setAttribute("width", $_SESSION['BUTTON_WIDTH_SIZE']);
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
            $_list = ODataModel::GetPropertyValue($_object, substr($_attrs['PropertyName'], 2));
            if ($_list == null) continue;
            // add every row data to table by property name
            foreach ($_list as $_item)
            {
                $_row = $_dom->createElement("tr");

                $_datakey = urlencode($_item->ObjectID->Encrypt($_sid));

                // edit button
                $_editbutton = $_dom->createElement("i");
                $_editbutton->setAttribute("class", $_SESSION['EDIT_BUTTON']);
                $_editonclick = "window.location.href = '$_requestURI?ACTION=EDIT&DATAKEY=$_datakey'";
                $_editbutton->setAttribute("onclick", $_editonclick);
                $_col = $_dom->createElement("td");
                $_col->appendChild($_editbutton);
                $_row->appendChild($_col);

                // delete button
                $_deletebutton = $_dom->createElement("i");
                $_deletebutton->setAttribute("class", $_SESSION['DELETE_BUTTON']);
                $_deleteonclick = "if (confirm('Are you sure you want to delete this record?'))
                    window.location.href = '$_requestURI?ACTION=DELETE&DATAKEY=$_datakey'";
                $_deletebutton->setAttribute("onclick", $_deleteonclick);
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
            }
        }
        $_table->appendChild($_tbody);
    
        $_grid_column->parentNode->replaceChild($_table, $_grid_column);
    }
    
    $_grid_commands = GetAllChildNodesByTagName($_ele, "grid-command");
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
            if ($_commandname == "AddObject")
            {
                $_buttonOnclick = "window.location.href = '$_requestURI?ACTION=EDIT'";
                $_button->setAttribute("onclick", $_buttonOnclick);
            }
            $_ele->parentNode->insertBefore($_button, $_ele);
        }

        RemoveSelfElement($_grid_command);
    }
}

?>
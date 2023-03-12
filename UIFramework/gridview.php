<?php

$_gridviews = $_dom->getElementsByTagName("gridview");
if ($_gridviews->length <= 0) return;
foreach ($_gridviews as $_gridview)
{
    $_enableEdit = GetAttribute($_gridview, "EnableEdit") == "false" ? false : true;
    $_enableDelete = GetAttribute($_gridview, "EnableDelete") == "false" ? false : true;
    $_attrs = GetAllAttributes($_gridview);
    $_grid_columns = GetAllChildNodesByTagName($_gridview, "grid-column");
    if (count($_grid_columns) > 0)
    {
        $_grid_column = $_grid_columns[0];
        $_columns = GetAllChildNodesByTagName($_grid_column, "column");
    
        $_table = $_dom->createElement("table");
        $_table->setAttribute("class", "gridview");
        
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
        // check if gridview is for any table in database
        if (array_key_exists('TableName', $_attrs) || array_key_exists('Load', $_attrs))
        {
            if (array_key_exists('Load', $_attrs))
            {
                $_varname = $_attrs['Load'];
                $_list = $$_varname;
            }
            else
            {
                $_tableName = $_attrs['TableName'];
                $_list = $_tableName::LoadList();
            }

            // add every row data to table by property name
            foreach ($_list as $_item)
            {
                $_row = $_dom->createElement("tr");

                $_datakey = urlencode($_item->ObjectID->Encrypt($_sid));

                // edit button
                $_editbutton = $_dom->createElement("i");
                $_editbutton->setAttribute("class", $_editButton);
                $_editonclick = "window.location.href = '$_requestURI?ACTION=EDIT&DATAKEY=$_datakey'";
                $_editbutton->setAttribute("onclick", $_editonclick);
                $_col = $_dom->createElement("td");
                if ($_enableEdit == true)
                    $_col->appendChild($_editbutton);
                $_row->appendChild($_col);

                // delete button
                $_deletebutton = $_dom->createElement("i");
                $_deletebutton->setAttribute("class", $_deleteButton);
                $_deleteonclick = "if (confirm('$_deleteConfirmMsg'))
                    window.location.href = '$_requestURI?ACTION=DELETE&DATAKEY=$_datakey'";
                $_deletebutton->setAttribute("onclick", $_deleteonclick);
                $_col = $_dom->createElement("td");
                if ($_enableDelete == true)
                    $_col->appendChild($_deletebutton);
                $_row->appendChild($_col);

                foreach ($_columns as $_column)
                {
                    $_propName = GetAttribute($_column, "PropertyName");
                    $_valuetext = ODataModel::GetPropertyValue($_item, substr($_propName, 2));
                    if ($_valuetext === null)
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
    
    $_grid_commands = GetAllChildNodesByTagName($_gridview, "grid-command");
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
            $_gridview->parentNode->insertBefore($_button, $_gridview);
        }

        RemoveSelfNode($_grid_command);
    }
}

?>
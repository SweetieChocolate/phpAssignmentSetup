<?php

$_element = $_dom->getElementsByTagName("gridview");
foreach ($_element as $_ele)
{
    $_attrs = GetAllAttributes($_ele);
    $_grid_columns = GetAllChildNodesByTagName($_ele, "grid-column");
    if (count($_grid_columns) > 0)
    {
        $_grid_column = $_grid_columns[0];
        $_columns = GetAllChildNodesByTagName($_grid_column, "column");
    
        $_table = $_dom->createElement("table");
        $_table->setAttribute("id", "gvDatatable");
        
        $_thead = $_dom->createElement("thead");

        // append all the header text
        $_row = $_dom->createElement("tr");
        // append an empty column for edit button
        $_col = $_dom->createElement("th");
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

                // edit button
                $_editbutton = $_dom->createElement("i");
                $_editbutton->setAttribute("class", $_SESSION['EDIT_BUTTON']);
                $_datakey = urlencode($_item->ObjectID->Encrypt($_sid));
                $_onclick = "window.location.href = '$_requestURI?ACTION=EDIT&DATAKEY=$_datakey'";
                $_editbutton->setAttribute("onclick", $_onclick);

                $_col = $_dom->createElement("td");
                $_col->appendChild($_editbutton);
                $_row->appendChild($_col);

                foreach ($_columns as $_column)
                {
                    $_propName = GetAttribute($_column, "PropertyName");
                    $_valuetext = ODataModel::GetPropertyValue($_item, $_propName);
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
            
        }
    }
}

?>
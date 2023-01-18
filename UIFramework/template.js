
const defaultDir = "/phpAssignmentSetup";

class GridView extends HTMLElement {
    constructor() {
        super();
    }

    // class field
    id; tablename; properties;

    // call when element is added
    connectedCallback() {
        var id = this.getAttribute('id');
        var tablename = this.getAttribute('TableName');
        this.id = id;
        this.tablename = tablename;
        var properties = "";
        var columns = this.getElementsByTagName('column');
        console.log(columns);
        for (var i = 0; i < columns.length; i++)
        {
            console.log("aaa");
            var property = columns[i].getAttribute('PropertyName');
            console.log(property);
        }
        this.properties = properties;
        if (id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    var elmnt = document.getElementById(id);
                    if (this.status == 404) {
                        elmnt.innerHTML = "Page not found.";
                    }
                    if (this.status == 200) {
                        //elmnt.SetUp(this.responseText);
                    }
                }
            }
            var data = new FormData();

            data.append('TABLENAME', 'Employment');
            data.append('PROPERTIES', 'Salary');

            xhttp.open("POST", defaultDir + "/UIFramework/GridView/GridView.php", true);
            //xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send(data);
            return;
        }
    }

    SetUp(html) {
        var template = document.createElement("template");
        template.innerHTML = html;
        this.innerHTML = template.innerHTML;
    }
}

customElements.define('grid-view', GridView);
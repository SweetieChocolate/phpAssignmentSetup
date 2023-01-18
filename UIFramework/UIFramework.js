
const defaultDir = "/phpAssignmentSetup/";

class GridView extends HTMLElement {
    constructor() {
        super();
    }

    // class field
    id; tablename; headertexts; properties;

    // call when element is added
    connectedCallback()
    {
        var id = this.getAttribute('id');
        this.id = id;
        this.tablename = this.getAttribute('TableName');
        this.headertexts = "";
        this.properties = "";
        var columns = this.getElementsByTagName('column');
        for (var i = 0; i < columns.length; i++)
        {
            var headertext = columns[i].getAttribute('HeaderText');
            if (headertext)
                this.headertexts += headertext + ";";
            else
                this.headertexts += "-;"
            var property = columns[i].getAttribute('PropertyName');
            if (property)
                this.properties += property + ";";
            else
                this.properties += "-;"
        }
        if (id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    var elmnt = document.getElementById(id);
                    if (this.status == 404) {
                        elmnt.innerHTML = "Page not found.";
                    }
                    if (this.status == 200) {
                        elmnt.SetUp(this.responseText);
                    }
                }
            }
            var data = new FormData();

            data.append('TABLENAME', this.tablename);
            data.append('HEADERTEXTS', this.headertexts);
            data.append('PROPERTIES', this.properties);

            xhttp.open("POST", defaultDir + "UIFramework/GridView/GridView.php", true);
            //xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send(data);
            return;
        }
    }

    SetUp(html) {
        var template = document.createElement("template");
        template.innerHTML = html;
        this.innerHTML = template.innerHTML;
        while (this.attributes.length > 0)
        {
            this.removeAttribute(this.attributes[0].name);
        }
    }
}
customElements.define('grid-view', GridView);

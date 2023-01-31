<?php
session_start();
$_SESSION['ROOTPATH'] = $_SERVER['DOCUMENT_ROOT'] . "/phpAssignmentSetup/";
?>
<html>
    <head>
        <script>
            function changeFrame(item) {
                var frame = document.getElementById("frameView");
                frame.setAttribute("src", item.getAttribute("url"));
                frame.reload();
            }
        </script>
    </head>
    <body>
        <button type="button" url="test.php" onclick="changeFrame(this)">test</button>
        <button type="button" url="test2.php" onclick="changeFrame(this)">test2</button>
        <iframe id ="frameView" src="test.php" frameborder="0" width="100%" height="100%"></iframe>
    </body>
</html>
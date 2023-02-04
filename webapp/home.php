<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['ISINITIALIZE']))
    exit();

if(!isset($_GET['view']))
    require_once $_SESSION['PROJECTROOTPATH'] . "UIFramework/ui.php";

?>

<html>
    <head>
        <script>
            function changeFrame(item) {
                var frame = document.getElementById("frameView");
                frame.setAttribute("src", item.getAttribute("href"));
                frame.reload();
            }
        </script>
    </head>
    <body>
        <a href="test.php" onclick="event.preventDefault(); changeFrame(this)">test</a><br />
        <a href="test2.php" onclick="event.preventDefault(); changeFrame(this)">test2</a><br />
        <iframe id ="frameView" src="" frameborder="0" width="100%" height="100%"></iframe>
    </body>
</html>
<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['ISINITIALIZE']))
    exit();

//require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui.php";

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
    <a href="synchronize_table.php" onclick="event.preventDefault(); changeFrame(this)">synchronize table</a><br />
    <a href="test.php" onclick="event.preventDefault(); changeFrame(this)">test</a><br />
    <a href="employment.php?ACTION=VIEW" onclick="event.preventDefault(); changeFrame(this)">employment</a><br />
    <a href="employment-edit.php?ACTION=VIEW" onclick="event.preventDefault(); changeFrame(this)">employment-edit</a><br />
    <iframe id ="frameView" src="" frameborder="0" width="100%" height="100%"></iframe>
</body>
</html>
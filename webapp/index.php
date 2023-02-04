<?php

require "web-initialize.php";

if (isset($_SESSION['USERID']))
{
    $homepageurl = $_SESSION['HOME_PAGE'];
    header("Location: $homepageurl");
}

// login logic here if username and password valid redirect to home
// true for now
if (true)
{
    // store objectid of the user in USERID to able access across the web application
    // random text for now
    $_SESSION['USERID'] = "random";
    header("Refresh:0");
}
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
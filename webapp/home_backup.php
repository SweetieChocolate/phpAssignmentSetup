<?php

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['ISINITIALIZE'])) exit();

// require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-head.php";

// // data manipulate start here

// // data manupulate end here
    
// require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-foot.php";

?>

<html>
<head>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-header.php"; ?>
</head>
<body class="bg-info">
    <div class="sidebar">
        <div class="title">
            <div class="name">
                HR Management System
            </div>
            <span id="btn"><i class="fa fa-bars"></i></span>
        </div>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="image/logo.jpg" alt="" />
                    <div>
                        <div class="name"><?php echo $_SESSION['COMPANY_NAME']; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $_SESSION['WEB_ROOTPATH'] . "web-navigation_backup.php" ?>
    </div>
    
    <div class="home_content">
        <a href="synchronize_table.php" onclick="event.preventDefault(); changeFrame(this)">synchronize table</a><br />
        <a href="test.php" onclick="event.preventDefault(); changeFrame(this)">test</a><br />
        <a href="employment.php?ACTION=VIEW" onclick="event.preventDefault(); changeFrame(this)">employment</a><br />
        <a href="employment.php?ACTION=EDIT" onclick="event.preventDefault(); changeFrame(this)">employment-edit</a><br />
        <iframe id ="frameView" src="" frameborder="0" width="100%" height="100%"></iframe>
    </div>


    <script>

        function changeFrame(item) {
            var frame = document.getElementById("frameView");
            frame.setAttribute("src", item.getAttribute("href"));
            frame.reload();
        }

        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar")

        btn.onclick = function(){
            console.log("click")
            sidebar.classList.toggle("active");
        }

    </script>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>
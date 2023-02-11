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
<body>

    <div class="sidebar close">

        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">CodingLab</span>
        </div>

        <?php include $_SESSION['WEB_ROOTPATH'] . "web-navigation.php" ?>

        <div class="profile-details">
            <div class="profile-content">
                <img src="image/profile.jpg" alt="">
            </div>
            <div class="name-job">
                <div class="profile_name">Prem Shahi</div>
                <div class="job">Web Desginer</div>
            </div>
            <i class='bx bx-log-out'></i>
        </div>

    </div>
    
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Drop Down Sidebar</span>
        </div>
        <iframe id ="frameView" src="" frameborder="0" width="100%" height="100%"></iframe>
    </section>


    <script>

        let anchors = document.querySelectorAll("a");
        for (var i = 0; i < anchors.length; i++)
        {
            anchors[i].addEventListener("click", (e) =>
            {
                e.preventDefault();
                if (e.target.hasAttribute("href"))
                {
                    let href = e.target.getAttribute("href");
                    let frame = document.getElementById("frameView");
                    frame.setAttribute("src", href);
                    frame.reload();
                }
            });
        }

        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++)
        {
            arrow[i].addEventListener("click", (e) =>
            {
                let arrowParent = e.target.parentElement.parentElement;
                arrowParent.classList.toggle("showMenu");
            });
        }

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        sidebarBtn.addEventListener("click", () =>
        {
            sidebar.classList.toggle("close");
        });

    </script>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>
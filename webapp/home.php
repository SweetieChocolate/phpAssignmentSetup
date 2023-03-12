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
<body style="overflow:hidden">

    <div class="sidebar close">

        <div class="logo-details">
            <i id="sidebarBtn" class='bx bx-menu'></i>
            <span class="logo_name"><?= $_SESSION['COMPANY_NAME'] ?></span>
        </div>

        <?php include $_SESSION['WEB_ROOTPATH'] . "web-navigation.php" ?>

        <div class="profile-details">
            <div class="profile-content">
                <img id="profileBtn" src="./source/image/profile.png" alt="">
            </div>
            <div>
                <div class="name"><?php echo GetCurrentUser()->ObjectName; ?></div>
                <div class="job"></div>
            </div>
            <i class='bx bx-log-out' onclick="window.location.href = 'index.php'"></i>
        </div>

    </div>
    
    <section class="home-section">
        <iframe id ="frameView" src="" width="100%" height="100%" style="overflow:scroll;"></iframe>
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

        let sidebar = document.querySelector(".sidebar");
        
        let sidebarBtn = document.querySelector("#sidebarBtn");
        sidebarBtn.addEventListener("click", () =>
        {
            sidebar.classList.toggle("close");
        });

        let profileBtn = document.querySelector("#profileBtn");
        profileBtn.addEventListener("click", () =>
        {
            sidebar.classList.toggle("close");
        });

    </script>
    </br>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>
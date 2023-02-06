<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin</title>
    <?php include "web-header.php"; ?>
</head>
<body class="bg-info">
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i id="icon-home" class="fa fa-home"></i>
                <div class="icon_name">HR Admin</div>
            </div>
            <span id="btn"><i class="fa fa-bars"></i></span>
        </div>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="assets/medium-hr_20software_202.jpg" alt="">
                    <div class="name_job">
                        <div class="name">Sokmean Kao</div>
                        <div class="email">sokmeankao.me@gmail.com</div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav_list">
            <li>
                <a href="#">
                    <!-- grid -->
                    <i id="icon" class="fa fa-th-large" aria-hidden="true"></i>
                    <span class="link_name">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i id="icon" class="fa fa-users" aria-hidden="true"></i>
                    <span class="link_name">Employee</span>
                    <i class="down-arrow fa-solid fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#"></a>test1</li>
                    <li><a class="dropdown-item" href="#"></a>test1</li>
                    <li><a class="dropdown-item" href="#"></a>test1</li>
                    <li><a class="dropdown-item" href="#"></a>test1</li>
                    <li><a class="dropdown-item" href="#"></a>test1</li>
                </ul>
            </li>
            <li>
                <a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i id="icon" class="fa fa-money-bills" aria-hidden="true"></i>
                    <span class="link_name">Payroll</span>
                    <i class="down-arrow fa-solid fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#"></a>test1</li>
                    <li><a class="dropdown-item" href="#"></a>test1</li>
                    <li><a class="dropdown-item" href="#"></a>test1</li>
                    <li><a class="dropdown-item" href="#"></a>test1</li>
                    <li><a class="dropdown-item" href="#"></a>test1</li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <!-- info -->
                    <i id="icon" class="fa fa-info-circle" aria-hidden="true"></i>
                    <span class="link_name">Profile</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <!-- key -->
                    <i id="icon" class="fa fa-key" aria-hidden="true"></i>
                    <span class="link_name">Change Password</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <!-- info -->
                    <i id="icon" class="fa fa-sign-out" aria-hidden="true"></i>
                    <span class="link_name">Logout</span>
                </a>
            </li>

        </ul>
    </div>

    <!-- Content -->
    <div class="home_content">
    <p>An iframe with default borders:</p>
    <iframe width="100%" height="600px" src="https://www.youtube.com/embed/cLGIS1e_znA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar")

        btn.onclick = function(){
            console.log("click")
            sidebar.classList.toggle("active");
        }
    </script>
    <?php include "web-footer.php" ?>
</body>
</html>
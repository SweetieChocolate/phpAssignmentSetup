<?php

if (session_status() === PHP_SESSION_NONE) session_start();

require_once "web-initialize.php";

$loginMessage = "please enter username and password";

if (isset($_POST['button']))
{
    require $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/LogicLayer.php";
    if (isset($_POST['tbUserName']) && isset($_POST['tbPassaword']))
    {
        $username = $_POST['tbUserName'];
        $password = $_POST['tbPassaword'];
        if (!empty($username) && !empty($password))
        {
            $user = OUser::GetUserByUserNamePassword($username, $password);
            if ($user != null)
            {
                $_SESSION['USERID'] = $user->ObjectID->Encrypt(session_id());
                $user->LastLoginTime = DateTimeHelper::Now();
                $con = new DBConnection();
                $user->save($con);
                $con->commit();
                
                $homepageurl = $_SESSION['HOME_PAGE'];
                header("Location: $homepageurl");
            }
        }
        $loginMessage = "Invalid username or password";
    }
}

?>

<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title><?= $_SESSION['COMPANY_NAME'] ?></title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: nunito;
            font-weight: 600;
        }

        body{
            background-size: cover;
            border: 2px solid rgb(153, 157, 158);
        }
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
        }
        .wrapper{
            position: absolute;
            width: 455px;
            height: 485px;
            border-radius: 30px;
            transform: rotate(5deg);
            background: rgba(255, 255, 255, 0.53);
            box-shadow: 2px 2px 15px 2px rgba(0,0,0,0.115),
                        -2px -0px 15px 2px rgba(0, 0, 0, 0.054);
        }
        .box{
            width: 450px;
            height: 480px;
            background: #fff;
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 40px;
            box-shadow: 2px 2px 15px 2px rgba(0,0,0,0.1),
                        -2px -0px 15px 2px rgba(0,0,0,0.1);
            z-index: 10;           
        }
        .header{
            margin-bottom: 40px;
        }
        header{
            display: flex;
            align-items: center;
        }
        .header header{
            display: flex;
            justify-content: right;
        }
        header img{
            width: 25px;
        }
        .header p{
            font-size: 25px;
            font-weight: 600;
            margin-top: 10px;
        }
        .input-box{
            display: flex;
            flex-direction: column;
            margin: 10px 0;
            position: relative;
        }
        i{
            font-size: 22px;
            position: absolute;
            top: 35px;
            right: 12px;
            color: #595b5e;
        }
        input{
            height: 40px;
            border: 2px solid rgb(153, 157, 158);
            border-radius: 7px;
            margin: 5px 0;
            outline: none;
        }
        .input-field{
            font-weight: 500;
            padding: 0 10px;
            font-size: 17px;
            color: #333;
            background: transparent;
            transition: all .3s ease-in-out;
        }
        .input-field:focus{
            border: 2px solid rgb(89, 53, 180);
        }
        .input-field:focus ~ i{
            color: rgb(89, 53, 180);
        }
        .input-submit{
            background: #00b3f0;
            border: none;
            color: #fff;
            cursor: pointer;
            transition: all .3s ease-in-out;
        }
        .input-submit:hover{
            background: #000000;
        }
    </style>
    </head>
    <body>
        <div class="container">
            
            <div class="box">
                <form id="loginForm" action="" method="post">
                    <div class="header">
                        <header> <img src="./source/image/profile.png" alt=""></header>
                        <p><?= $_SESSION['COMPANY_NAME'] ?></p>
                    </div>
                    <div class="input-box">
                        <label for="text">Username</label>
                        <input type="text" class="input-field" id="email" name="tbUserName" value="<?= isset($_POST['tbUserName']) ? $_POST['tbUserName'] : '' ?>" required>
                        <i class="bx bx-envelope"></i>
                    </div>
                    <div class="input-box">
                        <label for="pass">Password</label>
                        <input type="password" class="input-field" id="pass" name="tbPassaword" required>
                        <i class="bx bx-lock"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="input-submit" name="button" value="LOGIN">
                    </div>
                        <span><?php include "web-db-script.php" ?></span>
                </form>
            </div>
            <div class="wrapper"></div>
        </div>
    </body>
</html>
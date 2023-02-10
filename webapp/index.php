<?php

if (session_status() === PHP_SESSION_NONE) session_start();

require_once "web-initialize.php";

if (isset($_SESSION['USERID']))
{
    $homepageurl = $_SESSION['HOME_PAGE'];
    header("Location: $homepageurl");
}

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
                $user->LastLoginTime = DateTimeHelper::Now();
                $con = new DBConnection();
                $user->save($con);
                $con->commit();
                $_SESSION['USERID'] = $user->ObjectID->ToString();
                header("Refresh:0");
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
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: poppins;
        }

        body{
            background-color: #E8EDF2;
        }

        div.container{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);

            display: flex;
            flex-direction: row;
            align-items: center;

            background-color: white;
            padding: 30px;
            box-shadow: 0 50px 50px -50px darkslategray;
        }
        div.container div.myform{
            width: 270px;
            margin-right: 30px;
        }
        div.container div.myform input[type="text"]{
            border: none;
            outline: none;
            border-radius: 0;
            width: 100%;
            border-bottom: 2px solid #1c1c1e;
            margin-bottom: 25px;
            padding: 7px 0;
            font-size: 20px;
        }
        div.container div.myform input[type="password"]{
            border: none;
            outline: none;
            border-radius: 0;
            width: 100%;
            border-bottom: 2px solid #1c1c1e;
            margin-bottom: 25px;
            padding: 7px 0;
            font-size: 20px;
        }
        div.container div.myform input[type="submit"]{
            color: white;
            background-color: #1c1c1e;
            border: none;
            outline: none;
            border-radius: 2px;
            font-size: 14px;
            padding: 5px 12px;
            font-weight: 500;
        }
        div.container div.image img{
            width: 400px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="myform">
            <form id="loginForm" action="" method="post">
                <input type="text" name="tbUserName" placeholder="User Name" value="<?= isset($_POST['tbUserName']) ? $_POST['tbUserName'] : '' ?>" />
                <input type="password" name="tbPassaword" placeholder="Password" />
                <input type="submit" name="button" value="LOGIN" />
            </form>
            <br />
            <p style="color: red"><?= $loginMessage ?></p>
            <br />
            <?php include "web-db-script.php" ?>
        </div>
        <div class="image">
            <img src="" />
        </div>
    </div>
</body>
</html>
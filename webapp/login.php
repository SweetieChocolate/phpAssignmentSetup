<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Log in Form</title>
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

      div.container div.myform h2{
        color: #1c1c1e;
        margin-bottom: 20px;
      }

      div.container div.myform input{
        border: none;
        outline: none;
        border-radius: 0;
        width: 100%;
        border-bottom: 2px solid #1c1c1e;
        margin-bottom: 25px;
        padding: 7px 0;
        font-size: 20px;
      }
      div.container div.myform button{
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
        <form>
          <h2>ADMIN LOGIN</h2>
          <input type="text" placeholder="Admin Name">
          <input type="password" placeholder="Password">
          <button type="submit">LOGIN</button>
        </form>
      </div>
      <div class="image">
        <img src="./image/medium-hr_20software_202.jpg">
      </div>
    </div>
  </body>
</html>
<?php
  session_start();
  if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]){
    header("location:../manage/index.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>註冊</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-3.0.0/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../css/custom.css" rel="stylesheet" media="screen">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="bootstrap-3.0.0/assets/js/html5shiv.js"></script>
      <script src="bootstrap-3.0.0/assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="wrapper">
        <div class="logo">
            <img src="../../customer/auth/logo.jpg" alt="">
        </div>
        <div class="text-center mt-4 name">
          &emsp;&emsp;&emsp;生產管理平台
        </div>
        <form class="p-3 mt-3" method="post" action="login.php">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="Ssn" id="Ssn" placeholder="Ssn">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <button class="btn mt-3">Login</button>
        </form>
        <!-- <div class="text-center fs-6">
            <a href="https://memeprod.sgp1.digitaloceanspaces.com/user-wtf/1579589124094.jpg">Forget password?</a> or <a href="./register.html">Sign up</a>
        </div> -->
    </div>

    
  </body>
</html>
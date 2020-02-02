<!-- <?php
     require('header.php');
?>

<main>

     <?php


     if (isset($_SESSION['userId'])) {
          echo '<h1>You are logged In!</h1>';
     }
     else
     {
          echo "<h1>You are logged out!</h1>";
     }

      ?>
     
     
</main>

<?php
     require('footer.php');
?> -->



<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <title>Rental Library Project</title>
</head>
<body>
  <br>
<div class="container">


  <h1 align="center">Welcome to rental library of RUET</h1>

  <br>
  <br>
  <br>
  <br>
  <h1 align="center">Admin Login</h1>
  <br>
  <br>

  <div align="center">
    <h5><b>Username:</b> mustafiz</h5>
    <h5><b>Password:</b>1234</h5>
  </div>

<?php
  if(isset($_GET['error'])){

    ?>
  <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto mt-4" role="alert">
    <strong>  
      <?php

      if($_GET['error']=='emptyfields')
      {
        echo "Fields can't be empty";
      }
      else if($_GET['error']=='sqlerror')
      {
        echo "Connection Problem";
      }
      else if($_GET['error']=='wrongpassword')
      {
        echo "Wrong  password";
      }
      else if($_GET['error']=='incorrect_username')
      {

        echo "Worong Username";

      }





       ?>
    </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

<?php

      }
    
    ?>

     
  


  <div class="w-50 mx-auto mt-4">
    <form action="includes/login.inc.php" method="post">
      <div class="form-group">
        <label for="exampleInputEmail1">User Name</label>
        <input type="text" class="form-control" name="mailuid" placeholder="Enter username">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="pwd" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>

      <button type="submit" name="login-submit" class="btn btn-primary">Login</button>
    </form>
   <br>
   <br>

    <a href="signup.php" title="">Sign Up</a>

  </div>
</div>

  <script src="js/jquery-slim.min.js" ></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>

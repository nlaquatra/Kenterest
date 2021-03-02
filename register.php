<?php
// Include config file
require_once "Config.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Register Account</title>

    

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src = "img/logo.png" alt="" width="72" height="57">
      <h2>Register Account</h2>
      <p class="lead">Fill out required information needed to register an account!</p>
    </div>
    <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] === "emptyInput") {
          echo "<div class = \"alert alert-danger\"><center><strong>Error:</strong> Fill in all fields</center></div>";
        }
        else if ($_GET["error"] === "invalidEmail") {
          echo "<div class = \"alert alert-danger\"><center><strong>Error:</strong> Invalid Email</center></div>";
        }
        else if ($_GET["error"] === "invalidPwd") {
          echo "<div class = \"alert alert-danger\"><center><strong>Error:</strong> Invalid Password Confirmation</center></div>";
        }
        else if ($_GET["error"] === "emailExsists") {
          echo "<div class = \"alert alert-danger\"><center><strong>Error:</strong> Email already exsists!</center></div>";
        }
        else if ($_GET["error"] === "none") {
          echo "<div class = \"alert alert-success\"><center><strong>Success:</strong> Account successfully created!</center></div>";
        }
      }
    ?>
      <center>
      <div class="col-md-7 col-lg-8">
        <form action = "includes/register.inc.php" method = "post" class="needs-validation" novalidate>
        <!-- <?php  // include('errors.php'); ?> !--> 
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control" name="firstName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" name="lastName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>


            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="example@kent.edu">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Password</label>
              <input type="password" name="pwd" class="form-control" placeholder="Password" required>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Confirm Password</label>
              <input type="password" class = "form-control" name = "confirm_pwd" placeholder="Re-enter Password">
            </div>

            <!-- <div class="col-12">
              <label for="country" class="form-label">Campus</label>
              <select class="form-select" id="country" required>
                <option value="">Choose...</option>
                <option>Kent Main campus</option>
                <option>Stark campus</option>
                <option>Ashtabula campus</option>
                <option>East Liverpool campus</option>
                <option>Geauga campus</option>
                <option>Salem campus</option>
                <option>Trumbell campus</option>
                <option>Tuscarawas campus</option>

              </select>
              <div class="invalid-feedback">
                Please select a valid campus.
              </div>
            </div> -->
          

          <hr class="my-4">

          <input type="submit" class = "btn btn-primary" name="submit" value="Register">
          <a href = "login.php"><input type="button" class = "btn btn-primary" name="login" value="Login Page"></a>
        </form>
        </center>
      </div>
    </div>
  </main>
<?php 
include_once("footer.php");
?>
  </body>
</html>
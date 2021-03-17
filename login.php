<?php
   include_once("Config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Kenterest Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/bootstrap.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/bootstrap.min.css'>
    <script src='js/bootstrap.js'></script>
    <script src='js/bootstrap.bundle.js'></script>

</head>
<body class="text-center">
    
    <main class="form-signin">
      <form action = "includes/login.inc.php" method = "post">
        <img class="mb-4" src="img/logo.png" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Sign into Kenterest</h1>
        <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] === "emptyInput") {
          echo "<div class = \"alert alert-danger\"><center><strong>Error:</strong> Username/Password Required</center></div>";
        }
        else if ($_GET["error"] === "invalidLogin") {
          echo "<div class = \"alert alert-danger\"><center><strong>Error:</strong> Invalid Email or Password</center></div>";
        }
        else if ($_GET["error"] === "notLogin") {
          echo "<div class = \"alert alert-danger\"><center><strong>Error:</strong> You must login first!</center></div>";
        }
      }
      else if (isset($_GET["logout"])) {
        if ($_GET["logout"] === "logout") {
          echo "<div class = \"alert alert-success\"><center><strong>Logout:</strong> You have been successfully logged out</center></div>";
        }
      }
    ?>
        <label for="inputEmail" class="visually-hidden">Kent Email</label>
        <!-- change type="email" for required @ symbol in login form -->
        <input type="text" name="username" class="form-control" placeholder="Kent Email" required autofocus>
        <label for="inputPassword" class="visually-hidden">Password</label>
        <input type="password" name="pwd" class="form-control" placeholder="Password" required>
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-primary" name = "login" type="submit">Sign in</button>
        <a href = "register.php"><button class = "btn btn-primary" type = "button">Register Account</button></a>
      </form>
    </main>
    <?php include_once('footer.php'); ?>
    <!-- <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2021 Kenterest</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="login.php">Login</a></li>
      <li class="list-inline-item"><a href="register.php">Register Account</a></li>
    </ul>
  </footer> -->
  </body>
  </html>
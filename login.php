<?php
   include("Config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT username FROM user_info WHERE username = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($db,$sql);
      if($result === false){
        throw new Exception(mysqli_error($db));
    }
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("$myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
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
    <script src='js/bootstrap.js.js'></script>
    <script src='js/bootstrap.bundle.js'></script>

</head>
<body class="text-center">
    
    <main class="form-signin">
      <form action = "" method = "post">
        <img class="mb-4" src="img/logo.png" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Sign into Kenterest</h1>
        <label for="inputEmail" class="visually-hidden">Kent Email</label>
        <!-- change type="email" for required @ symbol in login form -->
        <input type="text" name="username" class="form-control" placeholder="Kent Email" required autofocus>
        <label for="inputPassword" class="visually-hidden">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-primary" type="submit">Sign in</button>
        <button class="btn btn-primary" type="button">Register Account</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
      </form>
    </main>
</body>
</html>
<?php 
session_start();
// makes sure user logs in first
//prevents typing link in url directly to access
if (!isset($_SESSION["email"])) {
  header ("location: login.php?error=notLogin");
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
    <script src='js/bootstrap.js'></script>
    <script src='js/bootstrap.bundle.js'></script>
</head>

<body class="text-center">
<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-body border-bottom shadow-sm">
  <p class="h5 my-0 me-md-auto fw-normal">Kenterest</p>
  <nav class="my-2 my-md-0 me-md-3">
    <a class="p-2 text-dark" href="index.php">Home</a>
    <a class="p-2 text-dark" href="profile.php">Profile</a>
    <a class="p-2 text-dark" href="post.php">Post</a>
  </nav>
  <a class="btn btn-outline-danger" href="includes/logout.inc.php">Logout</a>
</header>
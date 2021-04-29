<?php 
include_once("config.php");
session_start();
// makes sure user logs in first
//prevents typing link in url directly to access
if (!isset($_SESSION["email"])) {
  header ("location: login.php?error=notLogin");
}
if(isset($_POST['submit'])) {
  echo $_POST['submit'];
  $searchq = $_POST['search'];
  $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
  $sql = "SELECT * FROM interests WHERE parent LIKE '%$searchq%' OR title LIKE '%$searchq%'" or die("Could not search");
  $result = $db->query($sql);
  if ($result) {
    header("location: filter.php");
  }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kenterest</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/bootstrap.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/bootstrap.min.css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='js/bootstrap.min.js'></script>
    <script src='js/bootstrap.bundle.js'></script>
</head>

<body>
<!--
<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom shadow-sm" style="background-color:#222; border-color:#080808">
  <p class="h5 my-0 me-md-auto fw-normal text-light">Kenterest</p>
  <nav class="my-2 my-md-0 me-md-3">
    <a class="p-2 text-light" style="text-decoration: none;" href="index.php">Home</a>
    <a class="p-2 text-light" style="text-decoration: none;" href="profile.php">Profile</a>
    <a class="p-2 text-light" style="text-decoration: none;" href="new-interest.php">Post</a>
  </nav>
  <a class="btn btn-outline-danger" href="includes/logout.inc.php">Logout</a>
</header>
-->

<!-- <header style="background-color:#222; border-color:#080808"> -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#222; border-color:#080808; max-height: 30%;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Kenterest</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="profile.php" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profile
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <li><a class="dropdown-item" href="profile.php">View Profile</a></li>
            <li><a class="dropdown-item" href="liked.php">Liked Posts</a></li>
            <li><a class="dropdown-item" href="new-interest.php">Post Interest</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="trending.php" tabindex="-1" aria-disabled="true">Trending</a>
        </li>
        <?php
          $email = $_SESSION['email'];
          $sql = "SELECT userType FROM users WHERE email='$email'";
          $result = mysqli_query($db,$sql);
          $row = mysqli_fetch_assoc($result);
          if ($row['userType'] == 1) { ?>
            <li class="nav-item">
            <a class="nav-link" href="adminPanel.php" tabindex="-1" aria-disabled="true">Admin Panel</a>
            </li>
        <?php  } ?>
        
        <li class="nav-item" style="margin-left: 15px;">
          <a class="nav-link btn btn-danger btn-sm" type="button" style="color: white;"aria-current="page" href="logout.php">Logout</a>
        </li>
      </ul>
      <form class="d-flex" action="filter.php" method="get">
        <input class="form-control me-2" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-danger" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
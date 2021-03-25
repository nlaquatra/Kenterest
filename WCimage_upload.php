<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="jquery-2.1.4.js"></script>
</head>

<?php
  require_once('configK.php');
  $dbh = new PDO(DBCONNSTRING,DBUSER,DBPASS);
  if(isset($_POST['btn'])) {
    $name = $_FILES['myfile']['name'];
    $type = $_FILES['myfile']['type'];
    $data = file_get_contents($_FILES['myfile']['tmp_name']);
    $stmt = $dbh->prepare("insert into myblob values('',?,?,?)");
    $stmt->bindParam(1,$name);
    $stmt->bindParam(2,$type);
    $stmt->bindParam(3,$data);
    $stmt->execute();
  }
  //*************************************************************************//
  // Abell12, Abell12, director. PHP: Storing/Viewing Images Stored In A Database (BLOB Data Type). YouTube, YouTube, 10 Apr. 2013, www.youtube.com/watch?v=kPGxWaIhLmk. 
  //*************************************************************************//
  ?>

 

 <!-- navbar-->

  <!--endnavbar-->
  <div class="parallax">
    <h2 style="text-align: center"> Submit a new Interest for people to Discover</h2>
  </div>
    <!--Tester trends-->
<body>
 

      <!-- <form action="" method="">
        <label>New Interest Title</label><input type="text" name="Title"><br>
        <label>Interest Description</label><input type="textarea" name="Interest Description"><br>
        <button type="submit">Submit New Interest</button><br>
      </form> -->
      <h4>Upload a picture or gif to represent your interest</h4>
      <form method="post" enctype="multipart/form-data">
        <input type="file" name="myfile"/>
        <button name="btn"> Submit New Interest</button>
      </form>
    <!-- upload submission form -->
    

   
</body>
</html> 

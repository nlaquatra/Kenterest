<?php
include_once("Config.php");
  // Create database connection
  //$db = mysqli_connect("localhost", "root", "", "mydata");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

    //Get title
    $title = mysqli_real_escape_string($db, $_POST['title']);

    //Get parent
    $parent = mysqli_real_escape_string($db, $_POST['parent']);

  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO interests (parent, title, image, image_text) VALUES ('$parent', '$title', '$image','$image_text')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($db, "SELECT * FROM interests");
?>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
   <!-- Put these inside the HEAD tag -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel='stylesheet' href='bower_components/glyphicons-only-bootstrap/css/bootstrap.min.css' /> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
</head>
<title>Image Upload</title>

<style type="text/css">
   #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 300px;
   	height: 140px;
   }
</style>


<body>
<div id="content">
  <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      echo "<p>".$row['title']."</p>";
      // echo "<p>".$row['parent']."</p>";
      // 	echo "<img src='images/".$row['image']."' >";
      // 	echo "<p>".$row['image_text']."</p>";
      //   echo "<p>Likes: ".$row['likes']."</p>";
      echo "</div>";
    }
  ?>
  <form method="POST" action="WCselect_interest.php" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="size" value="100000000000">

    <div class="form-group">
      <center><input type="file" name="image" ></center>
    </div>
    <div class="form-group">
      Interest Title: <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
      Category: <input type="text" class="form-control" name="parent">
    </div>
    <div class="form-group">
      <textarea 
        id="text" 
        cols="40" 
        rows="4" 
        class="form-control"
        name="image_text" 
        placeholder="Say something about this Interest..."></textarea>
    </div>
   
    <div class="form-group">
      <button type="submit" class="btn btn-danger form-control" name="upload">Post New Interest</button>
    </div>
  </form>
</div>

</body>
<?php
include_once("config.php");
include_once("includes/functions.inc.php");
include_once("header.php");
  // Create database connection
  //$db = mysqli_connect("localhost", "root", "", "mydata");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

    //Get title
    $title = mysqli_real_escape_string($db, $_POST['title']);

    //Get parent
    $parent = mysqli_real_escape_string($db, $_POST['parent']);

    if (emptyInputPost($title, $parent, $image, $image_text)) {
      header("location: new-interest.php?error=emptyInput");
    }
    else {
      header("location: new-interest.php?success");
    }

  	// image file directory
  	$target = "images/".basename($image);
    $userID = $_SESSION["userID"];

  	$sql = "INSERT INTO interests (parent, title, image, image_text, userID) VALUES ('$parent', '$title', '$image','$image_text', '$userID')";
  	// execute query
  	$resultData = mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($db, "SELECT * FROM interests WHERE parent='parent'");
?>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
   <!-- Put these inside the HEAD tag -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel='stylesheet' href='bower_components/glyphicons-only-bootstrap/css/bootstrap.min.css' /> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
</head>
<title>Image Upload</title>

<style type="text/css">
   #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 300px;
   	height: 140px;
   }
</style>


<body>
<div clas="container">
<div class="row">
<div class="col-md-6 offset-md-3">
<?php
if (isset($_GET["error"])) {
if ($_GET["error"] === "emptyInput") {
  echo "<div class = \"alert alert-danger alert-dismissible fade show\" role=\"alert\" style=\"max-width: auto;\"><center><strong>Error:</strong> All fields required for a post!</center>
  <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
}
}
if (isset($_GET["success"])) {
  echo "<div class = \"alert alert-success alert-dismissible fade show\" role=\"alert\" style=\"max-width: auto;\"><center><strong>Success!</strong> You have successfully added a post!</center>
  <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
}

?>
</div>
</div>

  <form method="POST" action="new-interest.php" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="size" value="100000000000">

    <div class="form-group input-group">
    <label class="input-group-text" for="title">Interest Title</label>
    <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group input-group">
    <label class="input-group-text" for="inputGroupSelect01">Category:</label>
  <select class="form-select" id="inputGroupSelect01" name="parent">
    <option selected>Choose...</option>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {

    ?>
    <option value="<?php echo $row['title']; ?>"><?php echo $row['title']; } ?></option>
  </select>
    </div>
    <div class="form-group">
      <textarea 
        id="text" 
        cols="40" 
        rows="4" 
        class="form-control"
        name="image_text" 
        placeholder="Say something about this Interest..."></textarea>
    </div>

    <div class="form-group">
      <center><input type="file" class="form-control" name="image" ></center>
    </div>
   
    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="upload" style="margin-top: 20px;">Post New Interest</button>
    </div>
  </form>
</div>
</div>

</body>
</html>
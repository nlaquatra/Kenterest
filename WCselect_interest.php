<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "mydata");

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
<!DOCTYPE html>
<html>
<head>
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
</head>
<body>
<div id="content">
  <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      echo "<p>".$row['title']."</p>";
      echo "<p>".$row['parent']."</p>";
      	echo "<img src='images/".$row['image']."' >";
      	echo "<p>".$row['image_text']."</p>";
        echo "<p>Likes: ".$row['likes']."</p>";
      echo "</div>";
    }
  ?>
  <form method="POST" action="WCselect_interest.php" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="100000000000">
  	<div>
  	  <input type="file" name="image">
  	</div>
    <div>
      title: <input type="text" name="title">
    </div>
    <div>
      parent: <input type="text" name="parent">
    </div>
  	<div>
      <textarea 
      	id="text" 
      	cols="40" 
      	rows="4" 
      	name="image_text" 
      	placeholder="Say something about this image..."></textarea>
  	</div>
   
  	<div>
  		<button type="submit" name="upload">POST</button>
  	</div>
  </form>
</div>

</body>
</html>
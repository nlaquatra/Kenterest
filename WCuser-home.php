<?php
if(isset($_POST["submit"])) {
  $interest_array= $_POST["interest"];
  require_once('configK.php');
                $conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
                if ($conn-> connect_error) {
                  die("Connection failed: " . $conn-> connect_error);
                }
                $int_arr_conver = implode(";", $interest_array);
                     $sql = "INSERT INTO users (interests) VALUES ($int_arr_conver);";
                     $result = $conn->query($sql);
  echo '<h3>Interests you are following</h3>';
  foreach ($interest_array as $key => $value) {
  	echo $value;
  	echo '<br>';

  	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>user-home</title>
</head>
<body>


</body>
</html>
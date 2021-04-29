<?php
require_once("../Config.php");
require_once("functions.inc.php");

if (isset($_POST['userType'])) {
    $userID = $_POST["userType"];

	changeUserType($db,$userID);

}
else if (isset($_POST['status'])) {
	$userID = $_POST["status"];
	
	changeUserStatus($db,$userID);
}
else if ($_GET["login"]) {
    header("location: ../login.php");
}

?>
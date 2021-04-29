<?php
require_once("../Config.php");
require_once("functions.inc.php");

if (isset($_POST['delete'])) {
    $postID = $_POST["delete"];

	deletePost($db,$postID);

}
else if (isset($_POST['OK'])) {
	$postID = $_POST["OK"];
	
	postOK($db,$postID);
}
else if ($_GET["login"]) {
    header("location: ../login.php");
}

?>
<?php

if (isset($_POST["submit"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwd_repeat = $_POST["confirm_pwd"];
    $campus = $_POST["campus"];
    //$profilePic = $_POST[""]

    require_once("../config.php");
    require_once("functions.inc.php");

    if (emptyInputRegister($firstName, $lastName, $email, $pwd, $pwd_repeat) !== false) {
        header("location: ../register.php?error=emptyInput");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../register.php?error=invalidEmail");
        exit();
    }
    if (pwdMatch($pwd, $pwd_repeat) !== false) {
        header("location: ../register.php?error=invalidPwd");
        exit();
    }
    if (emailExsist($db, $email) !== false) {
        header("location: ../register.php?error=emailExsists");
        exit();
    }

    /*https://makitweb.com/upload-and-store-an-image-in-the-database-with-php/. Viewed:04/06/2021*/
    $name = $_FILES['file']['name'];
	$target_dir = "../img/profile/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	
	//select file type
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	//Valid file extensions
	$extensions_arr = array("jpg","jpeg","png","gif");
	
	//Upload file
	move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$email.".".$name);
		
		
	
	//set parameter
	if(in_array($imageFileType,$extensions_arr)){
		$profilePic = "$email.$name";
	}

    createUser($db, $firstName, $lastName, $email, $pwd, $campus, $profilePic);

}
else if ($_GET["login"]) {
    header("location: ../login.php");
}


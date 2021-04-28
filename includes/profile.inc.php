<?php
include_once("../Config.php");

if (isset($_POST["submit"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $bio = $_POST["bio"];
    $pwd = $_POST["password"];
    $pwd_repeat = $_POST["password2"];
    //$picture = $_POST["uploadFile"];

    require_once("functions.inc.php");

    //checks for empty input for first and last name input fields
    if (emptyInputEdit($firstName, $lastName) !== false) {
        header("location: ../profile.php?error=emptyInput");
        exit();
    }
    //checks if the passwords match
    if (pwdMatch($pwd, $pwd_repeat) !== false) {
        header("location: ../profile.php?error=invalidPwd");
        exit();
    }
    //if pwd fields are empty run this function to edit and keep same pwd
    if (empty($pwd) && empty($pwd_repeat)) {
        session_start();
        $email = $_SESSION['email'];
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
        editProfile($db, $firstName, $lastName, $bio, $profilePic);
    }
    //edit everything
    else {
        session_start();
        $email = $_SESSION['email'];
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
        editProfilePwd($db, $firstName, $lastName, $bio, $pwd, $profilePic);
    }
}

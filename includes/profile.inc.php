<?php
include_once("../config.php");

if (isset($_POST["submit"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $bio = $_POST["bio"];
    $pwd = $_POST["password"];
    $pwd_repeat = $_POST["password2"];
    //$picture = $_POST["uploadFile"];

    require_once("functions.inc.php");

    if (emptyInputEdit($firstName, $lastName, $pwd, $pwd_repeat) !== false) {
        header("location: ../profile.php?error=emptyInput");
        exit();
    }
    if (pwdMatch($pwd, $pwd_repeat) !== false) {
        header("location: ../profile.php?error=invalidPwd");
        exit();
    }
    editProfile($db, $firstName, $lastName, $bio, $pwd);
}

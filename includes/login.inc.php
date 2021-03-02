<?php

if (isset($_POST["login"])) {
    $email = $_POST["username"];
    $pwd = $_POST["pwd"];

    require_once("../Config.php");
    require_once("functions.inc.php");

    if (emptyInputLogin($email, $pwd) !== false) {
        header("location: ../login.php?error=emptyInput");
        exit();
    }

    loginUser($db,$email,$pwd);
    
}
else {
    header("location: ../login.php");
    exit();
} 
<?php

if (isset($_POST["submit"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwd_repeat = $_POST["confirm_pwd"];

    require_once("../Config.php");
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

    createUser($db, $firstName, $lastName, $email, $pwd);

}
else if ($_GET["login"]) {
    header("location: ../login.php");
}


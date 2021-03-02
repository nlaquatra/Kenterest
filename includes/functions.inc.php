<?php

function emptyInputRegister($firstName, $lastName, $email, $pwd, $pwd_repeat) {
    $result; //bool return val
    if (empty($firstName) || empty($lastName) || empty($email) || empty($pwd) || empty($pwd_repeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result; //bool return val
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwd_repeat) {
    $result; //bool return val
    if ($pwd !== $pwd_repeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function emailExsist($db, $email) {
    $result;
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtFail");
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($db, $firstName, $lastName, $email, $pwd) {
    $result;
    $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtFail");
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../register.php?error=none");
    exit();
}

function emptyInputLogin($email, $pwd) {
    $result;
    if (empty($email) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($db, $email, $pwd) {
    $emailExsist = emailExsist($db, $email);

    if ($emailExsist === false) {
        header("location: ../login.php?error=invalidLogin");
        exit();
    }

    $pwdHashed = $emailExsist["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    
    if ($checkPwd === false) {
        header("location: ../login.php?error=invalidLogin");
        exit();
    }
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["email"] = $emailExsist["email"];
        header("location: ../index.php");
        exit();
    }
}
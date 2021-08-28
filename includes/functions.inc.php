<?php

function emptyInputRegister($firstName, $lastName, $email, $pwd, $pwd_repeat) {
    $result; //bool return val
    if (empty($firstName) || empty($lastName) || empty($email) || empty($pwd) || empty($pwd_repeat)) { //checks to see if inputs are empty
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function emptyInputPost($title, $parent, $image, $image_text) {
    $result; //bool return val
    if (empty($title) || empty($parent) || empty($image) || empty($image_text)) { //check if fields are empty 
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function emptyInputEdit($firstName, $lastName) {
    $result; //bool return val
    if (empty($firstName) || empty($lastName)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result; //bool return val
    
    $suffix = strtolower(substr($email,-9));
    
    if ($suffix !== '@kent.edu') { //checks for @kent.edu address
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

function createUser($db, $firstName, $lastName, $email, $pwd, $campus, $profilePic) {
    $result;
    $sql = "INSERT INTO users (firstName, lastName, email, password, campusName, profilePic) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtFail");
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $email, $hashedPwd, $campus, $profilePic);
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
        $_SESSION["userID"] = $emailExsist["userID"];
        $sql = "SELECT followed_interest FROM users WHERE email='" . $_SESSION['email'] . "'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        if ($row['followed_interest'] === NULL) {
            header("location: ../WCdisplay-interest.php");
        }
        else {
            header("location: ../index.php");
        }
        //header("location: ../index.php");
        exit();
    }
}

function createPost($db, $title, $text, $file) {
    //session_start();
    $sql = "INSERT INTO posts (title, body, image) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        //echo("Error description: " . mysqli_error($db));
        header("location: ../post.php?error=stmtFail");
    }
    mysqli_stmt_bind_param($stmt, "sss", $title, $text, $file);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    exit();
}

function editProfile($db, $firstName, $lastName, $bio, $profilePic) {
    session_start();
    $sql = "UPDATE users
            SET firstName = '$firstName', lastName = '$lastName', bio = '$bio', profilePic = '$profilePic'
            WHERE email = '" .$_SESSION["email"]. "'";
    $result = mysqli_query($db,$sql);
    header("location: ../profile.php?success");  
    exit();      
}

function editProfilePwd($db, $firstName, $lastName, $bio, $pwd, $profilePic) {
    session_start();
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $sql = "UPDATE users
            SET firstName = '$firstName', lastName = '$lastName', bio = '$bio', password = '$hashedPwd', profilePic = '$profilePic'
            WHERE email = '" .$_SESSION["email"]. "'";
    $result = mysqli_query($db,$sql);
    //$stmt = mysqli_stmt_init($db);
    //if (!mysqli_stmt_prepare($stmt, $sql)) {
        //echo("Error description: " . mysqli_error($db));
        //header("location: ../profile.php?error=stmtFail");
    //}
    //$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    //mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $bio, $hashedPwd);
    //mysqli_stmt_execute($stmt);
    //mysqli_stmt_close($stmt);
    header("location: ../profile.php?success");
    exit();        
}

function deletePost($db, $postID) {
    $sql = "DELETE FROM interests WHERE id=$postID";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../check-flags.php?error=stmtFail");
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	header("location: ../check-flags.php");
    exit();
}

function postOK($db, $postID) {
    $sql = "UPDATE interests SET flag=0 WHERE id=$postID";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../check-flags.php?error=stmtFail");
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	header("location: ../check-flags.php");
    exit();
}

function changeUserType($db, $userID) {
    $sql = "UPDATE users SET UserType = 1 - UserType WHERE id=$userID";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../modUsers.php?error=stmtFail");
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	header("location: ../modUsers.php");
    exit();
}

function changeUserStatus($db, $userID) {
    $sql = "UPDATE users SET Status = 1 - Status WHERE id=$userID";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../modUsers.php?error=stmtFail");
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	header("location: ../modUsers.php");
    exit();
}
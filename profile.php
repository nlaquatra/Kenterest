<?php
include_once("header.php");
include_once("config.php");

if(isset($_POST['upload'])) {
    $folder = "img/profile/".$name;
    $name = $_FILES['uploadfile']['name'];
    $type = $_FILES['uploadfile']['type'];
    $data = file_get_contents($_FILES['uploadfile']['tmp_name']);
    $sql = "INSERT INTO profilepic (picture) VALUES ('$name')";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtFail");
    }
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_bind_param($stmt, "s", $type);
    mysqli_stmt_bind_param($stmt, "s", $data);
    mysqli_stmt_execute($stmt);

    if (!move_uploaded_file($data, $folder)) {
        header("location: profile.php?error=uploadError");
        //exit();
        //echo("Error description: " . mysqli_error($db));
    }
    else {
        header("location: profile.php?uploading=uploadSucess");
    }
}
?>

<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel='stylesheet' type='text/css' media='screen' href='css/custom.css'>
<script src="js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<?php

if (isset($_GET["error"])) {
    if ($_GET["error"] === "uploadError") {
      echo "<div class = \"alert alert-warning\"><center><strong>Warning:</strong> Somthing went wrong while uploading!</center></div>";
    }
}
else if (isset($_GET["uploading"])) {
    if ($_GET["uploading"] === "uploadSucess") {
        echo "<div class = \"alert alert-sucess\"><center><strong>Sucess:</strong> Your file sucessfully uploaded!</center></div>";
    }
}

?>

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="img/profile.png" width = 150px height = 150px alt=""/>
                        </div>
                    </div>
                    <?php 
                        $sql = "SELECT * FROM users WHERE email='" .$_SESSION["email"]. "'";
                        $result = mysqli_query($db,$sql);
                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        Welcome: <?php echo $row["firstName"]; ?>
                                    </h5>
                                    <h6>
                                        Bio
                                    </h6>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">About</button>
                                        </li>
                                         <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Posts</button>
                                         </li>
                                    </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="edit" value="Edit Profile"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            </br>
                            <form enctype="multipart/form-data" action="profile.php" method="POST">
                            <input type ="file" name="uploadfile" />
                            <input type ="submit" name="upload" value="Upload" />
                            </form>
                            <p>Useful Links</p>
                            <a href="">Home</a><br/>
                            <a href="">Post</a><br/>
                            <a href="">Logout</a><br/>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>First Name: <?php echo $row["firstName"]; ?></label>                                            </div>
                                            <div class="col-md-6">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Last Name: <?php echo $row["lastName"]; ?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email: <?php echo $row["email"]; ?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <p></p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Your Posts</label><br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
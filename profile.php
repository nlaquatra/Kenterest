<?php
include_once("header.php");
include_once("Config.php");

/*

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
*/
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
    if ($_GET["error"] === "emptyInput") {
        echo "<div class = \"alert alert-danger\"><center><strong>Error:</strong> All fields required when editing profile!</center></div>";
      }
    if ($_GET["error"] === "invalidPwd") {
        echo "<div class = \"alert alert-danger\"><center><strong>Error:</strong> The passwords do not match!</center></div>";
    }
}
else if (isset($_GET["success"])) {
    echo "<div class = \"alert alert-success\"><center><strong>Success:</strong> You have updated your info!</center></div>";
}

?>

<div class="container emp-profile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <?php
                            $email = $_SESSION["email"];
							$sql = "SELECT * FROM users WHERE email='$email'";
                            $result = mysqli_query($db,$sql);
                            $row = mysqli_fetch_assoc($result);
                          
							
							$image = $row['profilePic'];
							
							
							if($image!=NULL){
								echo "<img src='img/profile/$image' class='rounded-circle' width = 150px height = 150px alt=''/>";
							} else {
								echo "<img src='img/profile.png' class='rounded-circle width = 150px height = 150px alt=''/>";
							}
							?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        Welcome: <?php echo $row["firstName"]; ?>
                                    </h5>
                                    <h6>
                                         <?php echo $row["bio"]; ?>
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
                        <input type="button" class="profile-edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" name="edit" value="Edit Profile"/>
                    </div>
                    <!-- Modal -->
<form action="includes/profile.inc.php" method="POST" enctype="multipart/form-data">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="editProfile" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfile">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="firstName" class="col-form-label">First Name:</label>
        <input type="text" class="form-control" name="firstName" value="<?php echo $row['firstName']; ?>">
        <label for="lastName" class="col-form-label">Last Name:</label>
        <input type="text" class="form-control" name="lastName" value="<?php echo $row['lastName']; ?>">
        <label for="bio" class="col-form-label">Bio:</label>
        <input type="text" class="form-control" name="bio" value="<?php echo $row['bio']; ?>">
        <label for="password" class="col-form-label">Password:</label>
        <input type="password" class="form-control" name="password" />
        <label for="password2" class="col-form-label">Re-enter Password:</label>
        <input type="password" class="form-control" name="password2">
        <label for="pic" class="col-form-label">Profile Picture</label>
        <br/>
        <input type ="file" class="form-control" name="file" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" name="submit" class="btn btn-primary" value="Save" />
        </form>
      </div>
    </div>
  </div>
</div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            </br>
                           <!-- <form enctype="multipart/form-data" action="profile.php" method="POST">
                            <input type ="file" name="uploadfile" />
                            <input type ="submit" name="upload" value="Upload" />
                            </form> -->
                            <p>Useful Links</p>
                            <a href="index.php">Home</a><br/>
                            <a href="post.php">Post</a><br/>
                            <a href="includes/logout.inc.php">Logout</a><br/>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <p>First Name: <?php echo $row["firstName"]; ?></p>
                                            </div>       
                                            <div class="col-md-9">
                                                <p>Last Name:  <?php echo $row["lastName"]; ?></p>
                                            </div>
                                            <div class="col-md-9">
                                                <p>Email: <?php echo $row["email"]; ?></p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label>Your Posts</label><br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>           
        </div>
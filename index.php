<?php
include ('config.php');
session_start();
if (!isset($_SESSION["email"])) {
  header ("location: login.php?error=notLogin");
}
$user_email = $_SESSION['email'];
// submission to  get interests selected by user
if(isset($_POST["submit"])) {
  $interest_array = $_POST["interest"];
  // print_r($interest_array);
  $delimited =  implode(";", $interest_array);
  // echo'<br>';
  // echo $delimited;
    $sql = "UPDATE users SET followed_interest = '$delimited' WHERE email = '$user_email'";
    $result = $db->query($sql);
   }

if(isset($_POST['add_interest'])) {
  $new_interest = $_POST['add_interest'];
  $sql = "SELECT followed_interest FROM users WHERE email = '$user_email'";
  $result = $db->query($sql);
   if ($result-> num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                  $prep_csv = $row['followed_interest'];
                  $d_file = explode(";", $prep_csv);
                  $existing_interest_array = array();
                  $existing_interest_array = $d_file;
                }
                if (in_array($new_interest, $existing_interest_array) == false) {
                  array_push($existing_interest_array, $new_interest);
                  $updated_interest_csv =  implode(";", $existing_interest_array);
                  $sql = "UPDATE users SET followed_interest = '$updated_interest_csv' WHERE email = '$user_email'";
                  $result = $db->query($sql);
                }                      
    }
}

if(isset($_POST['remove_interest'])){
    $remove_followed_interest = $_POST['remove_interest'];
    $sql = "SELECT followed_interest FROM users WHERE email = '$user_email'";
        $result = $db->query($sql);
          if ($result-> num_rows > 0) {
                    while ($row = $result->fetch_assoc()){
                    $prep_csv = $row['followed_interest']; 
                    $d_file = explode(";", $prep_csv);
                    echo '<br>';
                    $existing_interest_array = array();
                    $existing_interest_array = $d_file;  
                    if (($key = array_search($remove_followed_interest, $existing_interest_array)) !== false) {
                            array_splice($existing_interest_array, $key,1 );
                        }  
                        $updated_interest_array =  implode(";", $existing_interest_array);

          }
          $updated_interest_array =  implode(";", $existing_interest_array);
          $sql = "UPDATE users SET followed_interest = '$updated_interest_array' WHERE email = '$user_email'";
          $result = $db->query($sql);
  }
}

if(isset($_POST['search'])) {
  $searchq = $_POST['search'];
  $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
  $sql = "SELECT * FROM interests WHERE parent LIKE '%$searchq%' OR title LIKE '%$searchq%'" or die("Could not search");
  $result = $db->query($sql);
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>user-home</title>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
   <!-- Put these inside the HEAD tag -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel='stylesheet' href='bower_components/glyphicons-only-bootstrap/css/bootstrap.min.css' />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
</head>
<style>
/*“Pure CSS Responsive Masonry Grid Layouts | Grid Like Pinterest with Html CSS Only - No JQuery.” YouTube, YouTube, 9 Dec. 2018, www.youtube.com/watch?v=82ej2Bpc0GE. */

  body {
    margin:0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    background: #f2f2f2;
  }

  .container {
    width:1800px;
    margin: 20px auto;
    columns: 6;
    column-gap: 40px;
  }

  .container .box
  {
    width: 100%;
    margin: 0 0 20px;
    padding: 10px;
    background: #fff;
    overflow: hidden; 
    break-inside: avoid;
  }

  .container .box img
  {
    max-width: 100%;
  }

  .container .box h2
  {
    margin: 5px 0 0;
    padding: 0;
    font-size: 20px;
  }

  .container .box p
  {
    margin: 0;
    padding: 0 0 5px;
    font-size: 16px;
  }

  @media (max-width: 1800px)
  {
    .container 
    {
      columns: 6;
      width: calc(100% - 60px);
      box-sizing: border-box;
      padding: 10px 10px 10px 0;
    }
  }

  @media (max-width: 1200px)
  {
    .container 
    {
      columns: 4;
    }
  }

  @media (max-width: 768px)
  {
    .container 
    {
      columns: 2;
    }
  }

  @media (max-width: 480px)
  {
    .container 
    {
      columns: 2;
    }
  }

#img_modal {
  width:  100%;
  height: auto;
}

#image_btn {
  border: 1px solid #ddd;
  border-radius: 2px;
  padding: 3px;
  /*float: left;*/
  width:  200px;
  height: auto;
  object-fit: cover;
  transition: all .5s ease-in-out; 
}


#image_btn:hover {
  box-shadow: 0 0 0 0.05px;
  transform: scale(1.03); 
}

#image_btn:active {
  opacity: 0.5;
}

input[type=text]:focus {
  border: 3px solid #555;
}

#int_text_box {
  padding-top: 3px;
}

</style>

         <!--    <nav class="navbar navbar-inverse navbar-fixed-top col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="container-fluid">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">Trending</a></li>
                 
                </ul>
                <form class="navbar-form navbar-right" action="filter.php" method="get">
                  <div class="form-group">
                    <div class="btn-group" role="group" aria-label="Basic example">
                    <input type="text" class="form-control" name="search" placeholder="Search" required>
                  </div>
                  <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="submit" class="btn btn-danger">Search</button>
                </div>
                </div>
                </form>
                <div class="navbar-form navbar-right" role="group" aria-label="Basic example">
                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-user"></span></button>
                </div>
            
              </div>
            </nav> -->

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">

      <a class="navbar-brand" href="#">Kenterest</a>
    
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="profile.php">Your Profile</a></li>
          <li><a href="WCdisplay-interest.php">Select Interests</a></li>
          <li><a href="liked.php">Posts you Like</a></li>
          <li><a href="new-interest.php">Add a New Interest</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </li>
        <li><a href="#">Trending</a></li>
        <!-- <a class="btn btn-danger btn-sm" role="button" style="margin-top: 10px;" href="logout.php">Logout</a> -->
      </ul>
    <form class="navbar-form navbar-right" action="filter.php" method="get">
          <div class="form-group">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <input type="text" class="form-control" name="search" placeholder="Search" required>
                  </div>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="submit" class="btn btn-danger">Search</button>
                  </div>
          </div>
    </form>
  
  </div>

  </div>
</nav>




<body>

  <!--endnavbar-->
  <br><br>
<center><h2>Interests that you follow</h2></center>
<div class="container"><!--beginning of container-->
  
    <div class="row">   
      
    <?php

if(isset($user_email)) {
  $sql = "SELECT followed_interest FROM users WHERE email = '" . $user_email . "'";
  $result = $db->query($sql);
   if ($result-> num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                  $prep_csv = $row['followed_interest'];
                  
  $d_file = explode(";", $prep_csv);
  // print_r($d_file);
  foreach($d_file as $following) {
    $sql = "SELECT id, image_text, parent, title, image, likes FROM interests WHERE parent = '$following' ORDER BY title ASC";
    $result = $db->query($sql);
    if ($result-> num_rows > 0) {
                while ($row = $result->fetch_assoc()){ ?>
                  <div class="box"> <!-- //START box -->
                     <!--  //interest image -->
                       <center><input type="image" id="image_btn" src="images/<?php echo $row['image']; ?>" data-toggle="modal" data-target="#<?php echo $row['id']; ?>">
                       </center>
                          <!-- //interest description -->
                         <p id='int_text_box'><?php echo $row['image_text']; ?></p>
                               <?php
                                $str = $row['title'];
                                $cap_title = ucwords($str);
                                $likes = $row['likes'];
                                $cate = $row['parent'];
                                $cap_category = ucwords($cate);
                                ?>
                      
                   <!--   //interest title   -->
                    <label for="imagebox"><h2><?php echo $cap_title; ?></h2></label> 
                  </div> <!-- //END box -->

                       <!--  //Modal// -->
                 <div class="modal fade" id="<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!-- //START modal fade -->
                  <div class="modal-dialog modal-lg" role="document"> <!-- //START modal-dialog -->
                    <div class="modal-content"> <!-- //START modal-content -->
                      <div class="modal-header"> <!-- //START modal-header -->
                        <h2 class="modal-title" id="exampleModalLabel"><?php echo $cap_title; ?></h2>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div> <!-- //END modal-header -->
                      <div class="modal-body"> <!-- //START modal body -->
                        <div class="row"> <!-- //START row modal body -->
                          <div class="col-md-8"> <!-- //START 8 div -->
                            <img src="images/<?php echo $row['image']; ?>" id="img_modal" class="img-rounded">
                          </div> <!-- //END 8 div -->
                            <div class="col-md-4"> <!-- //START 4 div -->
                            <h3>Description: </h3>
                            <h4><?php echo $row['image_text']; ?></h4>
                         

                            <form  method="post" action="WCuser-home.php">
                              <label for="comment-text">Comment: </label>
                              <input type="text" id="comment-text">
                                <br>
                              </form>
                               
                                <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Add your comment to this interest" type="submit" name="Post" value="Post">Post</button>
                                <?php
                                


                                ?>
                                <form  method="post" action="liked.php">
                                <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Like this Interest" type="submit" name="Like" value="<?php echo $row['id']; ?>">Like <span class="badge"><?php echo $row['likes']; ?></span></button>       
                                </form>
                               
                            <br>
                            <h4>Category: <?php echo $cap_category; ?></h4>
                             
                              <br><br>
                              <form method="post" action="WCuser-home.php">
                                  <button class="btn btn-default" type="submit" name="remove_interest" value="<?php echo $row['parent']; ?>">Stop Following This Interest Category</button>
                              </form>
                          
                            </div> <!-- //END 4 div -->
                         </div> <!-- //END row modal body --> 
                      </div> <!-- //END modal body -->
                      <div class="modal-footer"><!--  // START modal-footer -->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        
                      </div> <!-- //END modal-footer -->
                    </div> <!-- // END modal-content -->
                  </div> <!-- //END modal-dialog -->
                </div> <!-- //END modal fade -->
<?php 
              }
          }
      }
    } 
  }
}
    ?>  
    </div>
      <!-- ends container -->
</div>
<center><h2>Interests Categories to Explore</h2></center>
<div class="container">
<div class="row">   
      
    <?php

    $sql = "SELECT title, image, image_text, likes, parent FROM interests WHERE parent = 'parent' LIMIT 15;";
    $result = $db->query($sql);
    if ($result-> num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                  echo '<div class="box">';
                  // echo '<img src="getImage.php?id='.$row['id'].'" />';
                  echo '<form method="get" type="submit" name="search" >';
                       echo '<center><a href="filter.php?search='.$row['title'].'"><img src="images/'.$row['image'].'" id="image_btn" /></a></center>';
                       echo '</form>';
                          echo "<p id='int_text_box'>".$row['image_text']."</p>";
                        // $file = $row['title'];
                        $str = $row['title'];
                        $cap_title = ucwords($str);
                        // $likes = $row['likes'];
                  echo '<label for="imagebox"><h2>'. $cap_title .'</h2></label>'; 
                  echo '</div>';
            }
    }
    ?>  
    </div>
</div>

</body>
</html>

<?php
session_start();
include ('Config.php');
// makes sure user logs in first
//prevents typing link in url directly to access
if (!isset($_SESSION["email"])) {
  header ("location: login.php?error=notLogin");
}
$user_email = $_SESSION['email'];


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

// if(isset($_POST['Like'])) {
//   $liked_interest_to_count = $_POST['Like'];
//   $sql = "SELECT interest_id FROM likes WHERE userid = '$user_email'";
//   $result = $db->query($sql);
//   if ($result-> num_rows > 0) {
//                 while ($row = $result->fetch_assoc()){
                 
//                   $existing_interest_id = $row['interest_id'];
       
//    if ($liked_interest_to_count != $existing_interest_id) {
//     echo "Already Liked";
//    } else {
            
         
//                 $sql = "INSERT INTO likes SET userid = '$user_email', interest_id = '.$liked_interest_to_count.'";
//                 $result = $db->query($sql);
//               }

// }

?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="jquery-2.1.4.js"></script>
</head>
<title>Likes</title>
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
  box-shadow: 0 0 0 0.5px;
  transform: scale(1.05); 
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
        <li><a href="WCuser-home.php">Home</a></li>
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="profile.php">Your Profile</a></li>
          <li class="active"><a href="liked.php">Posts you Like</a></li>
          <li><a href="new-interest.php">Add a New Interest</a></li>
        </ul>
      </li>
        <li><a href="#">Trending</a></li>

      </ul>
       <ul class="nav navbar-nav navbar-right">
       <li><a href="logout.php">Logout</a></li>
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

  <br>
    <br>

<body>
	<br>
<center><h4>Interests that you Like</h4></center>
<div class="container">
    <div class="row">
<?php 
	if(isset($_POST['UnLike'])){
    $remove_like = $_POST['UnLike'];
    $sql = "SELECT liked_interests FROM users WHERE email = '$user_email'";
        $result = $db->query($sql);
          if ($result-> num_rows > 0) {
                    while ($row = $result->fetch_assoc()){
                    $prep_csv = $row['liked_interests']; 
                    $d_file = explode(";", $prep_csv);
                    echo '<br>';
                    $_SESSION['favorites'] = $d_file;              
                        if (($key = array_search($remove_like, $_SESSION['favorites'])) !== false) {
                            array_splice($_SESSION['favorites'], $key,1 );
                        }          
                    }
          }
        $updated_likes =  implode(";", $_SESSION['favorites']);
        $sql = "UPDATE users SET liked_interests = '$updated_likes' WHERE email = '$user_email'";
        $result = $db->query($sql);
  }


 $interest_id = $_POST['Like']?? NULL;
 
			$sql = "SELECT liked_interests FROM users WHERE email = '$user_email'";
		    $result = $db->query($sql);
		     	if ($result-> num_rows > 0) {
		                while ($row = $result->fetch_assoc()){
		                $prep_csv = $row['liked_interests']; 
						$d_file = explode(";", $prep_csv);
						$_SESSION['favorites'] = $d_file;
						}
					}
				else  {
				$fav_array = array();
				$_SESSION['favorites'] = $fav_array;
				}
        
	        array_push($_SESSION['favorites'], $interest_id);

	        $clean_array = array_unique($_SESSION['favorites']);

          if (($key = array_search($interest_id, $clean_array) !== false)) {
        		  $sql = "UPDATE interests SET likes = likes +1 WHERE id = '$interest_id'";
              $result = $db->query($sql);
          }

			$delimited_likes =  implode(";", $clean_array);
		    $sql = "UPDATE users SET liked_interests = '$delimited_likes' WHERE email = '$user_email'";
		    $result = $db->query($sql);


		    $sql = "SELECT liked_interests FROM users WHERE email = '$user_email'";
		    $result = $db->query($sql);
	     	if ($result-> num_rows > 0) {
	                while ($row = $result->fetch_assoc()){
	                $prep_csv = $row['liked_interests'];
	                  
					$d_file = explode(";", $prep_csv);
					// echo '<br>';
					// print_r($d_file);
			  foreach($d_file as $interest_title) {
			    $sql = "SELECT id, image_text, parent, title, image  FROM interests WHERE id = '$interest_title'";
			    $result = $db->query($sql);
			   	 if ($result-> num_rows > 0) {
			                 while ($row = $result->fetch_assoc()){ ?>
                  <div class="box"> <!-- //START box -->
                     <!--  //interest image -->
                       <center><input type="image" id="image_btn" src="images/<?php echo $row['image']; ?>" data-toggle="modal" data-target="#<?php echo$row['id']; ?>">
                       </center>
                          <!-- //interest description -->
                         <p id='int_text_box'><?php echo $row['image_text']; ?></p>
                               <?php
                                $str = $row['title'];
                                $cap_title = ucwords($str);
                                
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
                         

                            <form  method="post" action="liked.php">
                              <label for="comment-text">Comment: </label>
                              <input type="text" class="form-group" id="comment-text">
                                <br>
                              </form>
                               
                                <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Add your comment to this interest" type="submit" name="Post" value="Post">Post</button>
                                <form  method="post" action="liked.php">
                                <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Remove this Interest from Likes" type="submit" name="UnLike" value="<?php echo $row['id']; ?>">Remove From Likes</button>    
                                       
                            </form>
                               
                            <br>
                            <h4>Category: <?php echo $cap_category; ?></h4>
                              <a href="filter.php?search= <?php echo $row['parent']; ?>"><button class="btn btn-danger" type="submit" name="search" >Check out Other Interests Like this</button></a>
                              <br><br>
                               <form method="post" action="WCuser-home.php">
                                  <button class="btn btn-default" type="submit" name="add_interest" value="<?php echo $row['parent']; ?>">Follow This Interest Category</button>
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






          // echo $user_followed_interests; //test if cookie persists



	    ?>
	</div>
</div>
</body>
<!-- <?php include'footer.php'; ?>  -->

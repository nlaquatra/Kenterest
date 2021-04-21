<?php
session_start();
// makes sure user logs in first
//prevents typing link in url directly to access
if (!isset($_SESSION["email"])) {
  header ("location: login.php?error=notLogin");
}

include ('config.php');
      

if(isset($_GET['search'])) {
  $searchq = $_GET['search'];
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
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
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
<div class="container">
  
    <div class="row">   
            <nav class="navbar navbar-inverse navbar-fixed-top col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="container-fluid">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">Trending</a></li>
                 
                </ul>
                <form class="navbar-form navbar-right" action="filter.php" method="get">
                  <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Search">
                  </div>
                  <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="submit" class="btn btn-danger">Search</button>
                </div>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-user"></span></button>
                </div>
                </form>
              </div>
            </nav>
        </div>
</div>
<body>
  <br>
  <center><h2>Your filtered Interests </h2></center>
<div class="container"><!--beginning of container-->
  
    <div class="row">   
    <?php

if(isset($_GET['search'])) {
  $searchq = $_GET['search'];
  $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
  $sql = "SELECT * FROM interests WHERE parent LIKE '%$searchq%' OR title LIKE '%$searchq%'" or die("Could not search");
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
                         

                            <form  method="post" action="liked.php">
                              <label for="comment-text">Comment: </label>
                              <input type="text" class="form-group" id="comment-text">
                                <br>
                              </form>
                               
                                <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Add your comment to this interest" type="submit" name="Post" value="Post">Post</button>
                                <form  method="post" action="liked.php">
                                <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Like this Interest" type="submit" name="Like" value="<?php echo $row['id']; ?>">Like</button>    
                                      
                            </form>
                               
                            <br>
                            <h4>Category: <?php echo $cap_category; ?></h4>
                              <a href="filter.php?search= <?php echo $row['parent']; ?>"><button class="btn btn-danger" type="submit" name="search" >Check out Other Interests Like this</button></a>
                          
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


  if(isset($_GET['submit'])) {
  $searchq = $_GET['search'];
  $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
  $sql = "SELECT * FROM interests WHERE parent LIKE '%$searchq%' OR title LIKE '%$searchq%'" or die("Could not search");
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
                         

                            <form  method="post" action="liked.php">
                              <label for="comment-text">Comment: </label>
                              <input type="text" class="form-group" id="comment-text">
                                <br>
                              </form>
                               
                                <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Add your comment to this interest" type="submit" name="Post" value="Post">Post</button>
                                <form  method="post" action="liked.php">
                                <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Like this Interest" type="submit" name="Like" value="<?php echo $row['id']; ?>">Like</button>    
                                      
                            </form>
                               
                            <br>
                            <h4>Category: <?php echo $cap_category; ?></h4>
                              <a href="filter.php?search= <?php echo $row['parent']; ?>"><button class="btn btn-danger" type="submit" name="search" >Check out Other Interests Like this</button></a>
                          
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
    ?>  
  </div>
</div>
</body>










</html>
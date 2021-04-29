<?php
include_once("header.php");
include_once("config.php");
?>

<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel='stylesheet' type='text/css' media='screen' href='css/custom.css'>
<script src="js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<style>

img:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}

img:active {
  opacity: 0.5;
}

input[type=text]:focus {
  border: 3px solid #555;
}


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

</style>







<body>

<div class="container"><!--beginning of container-->
    <div class="row">    
              <?php
                     $sql = "SELECT title, image_text, id, image FROM interests WHERE flag = 1 ORDER BY Date;";
                     $result = mysqli_query($db,$sql);

                  if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){
                          echo '<form method="post" id="sectionForm" action="includes/check-flags.inc.php">';
                          echo '<div class="box">';	  
						  
                          echo "<img src='images/".$row['image']."'>";   
						  
                          echo "<p>".$row['title']."</p>";
						  echo "<p>".$row['image_text']."</p>";

						  echo "<p><button type='submit' name='delete' value=".$row['id'].">Delete Post</button></p>";
						  echo "<p><button type='submit' name='OK' value=".$row['id'].">Mark OK</button></p>";
                          echo '</div>';
                        
                        }
                  }
              ?>
      </div>

</div><!-- ends container -->
      <div class="text-center">
			<a href="adminPanel.php">
				<input type="button" class="btn btn-danger" value="Back to Admin">
			</a>
	  </div>
</form>
</body>

<?php
if(isset($_POST["submit"])) {
  $interest_array= $_POST["interest"];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="jquery-2.1.4.js"></script>
</head>
<style>
img {
  transition: all 0.5s ease-in-out;
}
img:hover {
  box-shadow: 0 0 1px 1px rgba(240, 52, 52, 1);
  transform: scale(1.01); 
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

  #int_text_box {
  padding-top: 3px;
}



</style>

<body>
  <div class="parallax">
    <h2 style="text-align: center"> Explore Interests Posted by Users</h2>
  </div>
<div class="container"><!--beginning of container-->
    <div class="row">    
              <?php
              require_once('Config.php');
               
                     $sql = "SELECT likes, title, image_text, image, id, parent FROM interests WHERE parent = 'parent' ORDER BY image ASC;";
                     $result = $db->query($sql);
                  if ($result-> num_rows > 0) {
                        while ($row = $result->fetch_assoc()){
                          echo '<form method="post" id="sectionForm" action="WCuser-home.php">';
                          echo '<div class="box">';
                          // echo '<img src="getImage.php?id='.$row['id'].'" />';

                          echo "<img src='images/".$row['image']."' >";
                          echo "<p id='int_text_box'>".$row['image_text']."</p>";
                                // $file = $row['image'];
                                $str = $row['title'];
                                $cap_title = ucwords($str);
                               
                          echo '<h2>'.$cap_title.' <input type="checkbox" name="interest[]" id="imagebox" value='. $row['title'] .' /></h2>';
                          echo '</div>';
                        
                        }
                  }
              ?>
      </div>
      <div class="text-center">
      <input type="submit" name="submit" class="btn btn-danger" value="Select these Interests">
    </div><!-- ends container -->
  </div>
</form>
    
<script type="text/javascript">
  //Ref:
  //Vyspiansky, Ihor. “At Least One Checkbox Must Be Selected (Checked).” Tech Notes, 12 July 2019, vyspiansky.github.io/2019/07/13/javascript-at-least-one-checkbox-must-be-selected/. 
  (function() {
    const form = document.querySelector('#sectionForm');
    const checkboxes = form.querySelectorAll('input[type=checkbox]');
    const checkboxLength = checkboxes.length;
    const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

    function init() {
        if (firstCheckbox) {
            for (let i = 0; i < checkboxLength; i++) {
                checkboxes[i].addEventListener('change', checkValidity);
            }

            checkValidity();
        }
    }

    function isChecked() {
        for (let i = 0; i < checkboxLength; i++) {
            if (checkboxes[i].checked) return true;
        }

        return false;
    }

    function checkValidity() {
        const errorMessage = !isChecked() ? 'At least one Interest must be followed.' : '';
        firstCheckbox.setCustomValidity(errorMessage);
    }

    init();
})();
</script>
</body>
</html>
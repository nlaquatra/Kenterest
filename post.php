<?php 
include_once("header.php");
?>

<center>
<div class="col-md-7 col-lg-8">
<h2>Create Post</h2>
<div class="col-12">
<form action = "includes/post.inc.php" method="POST">
    <label for="name" class="form-label">Title</label>
    <input type="text" class="form-control" name="postName" />
</div>

            <div class="col-12">
              <label for="posttext" class="form-label">Post</label>
              <textarea class="form-control" name="postText" rows="6"></textarea>
            </div>
</div>
</br>
<div class="container">
  <div class="row">
    <div class="col">
        <input type ="file" class="form-control" style="width: 50%;" name="uploadfile" />
        <!-- <input type ="submit" name="upload" value="Upload" /> -->
    </div>
    <div class="col">
      <input type="submit" class="btn btn-primary btn-md" name="add-post" value="Post" />
      </form>
    </div>
  </div>
</div>
</center>
</body>
<?php 
include_once("footer.php");
?>
</html>
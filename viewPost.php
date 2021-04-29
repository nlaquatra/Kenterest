<!-- Start Heading -->

<?php require_once("header.php"); ?>

<!-- End Heading -->

<?php

    $email = $_SESSION["email"];
    $id = $_GET['id'];
	$sql = "SELECT * FROM interests WHERE id='$id'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);

?>

<div class="container bg-light" style="margin-top: 30px;">
    <div class="row">
        <h2 style="margin-top: 15px;"><strong><?php echo $row['title']; ?></strong></h2>
        <h5 style="margin-top: 5px; font-family: Novecento sans UltraLight;">Posted at: <?php echo $row['date']; ?></h5>
        <hr>
        <img src="images/<?php echo $row['image']; ?>" style="max-height: 40%; max-width: 40%; margin-top: 20px; margin-bottom: 20px;">
        <p style="margin-left: 10px; font-family: Novecento sans UltraLight; font-size: 20px; "><?php echo $row['image_text']; ?></p>

    </div>
</div>


<!-- Start Footer -->

<?php require_once("footer.php"); ?>

<!-- End Footer --> 

</body>
</html>
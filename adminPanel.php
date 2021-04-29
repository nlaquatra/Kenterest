<!-- Header -->

<?php 
    require_once("header.php");
    require_once("config.php");
?>

<!-- End Header -->
<!--
<div class="container">
    <div class="bg-light">
        <h2>Admin Panel</h2>
        <div class="row" style="margin-left: 150px; margin-right: 150px; margin-top: 20px;">
            <div class="col">
                <button class="btn btn-danger" name="">Delete User</button>
            </div>
            <div class="col">
                <button class="btn btn-danger" name="">Delete Post</button>
            </div>
        </div>
        <div class="row" style="margin-left: 150px; margin-right: 150px; margin-top: 80px;">
            <div class="col">
                <button class="btn btn-danger" name="">Upgrade Rights</button>
            </div>
            <div class="col">
                <button class="btn btn-danger" name="">Delete Commet</button>
            </div>
        </div>
    </div>
</div>
-->

<div class="container">
    <div class="bg-light">
        <h2>Admin Panel</h2>
        <div class="row" style="margin-left: 150px; margin-right: 150px; margin-top: 20px;">
            <div class="col">
				<a href="modUsers.php">
					<button class="btn btn-danger" name="">Modify Users</button>
				</a>
            </div>

        </div>
        <div class="row" style="margin-left: 150px; margin-right: 150px; margin-top: 80px;">
            <div class="col">
				<a href="check-flags.php">
					<button class="btn btn-danger" name="">Flagged Posts</button>
				</a>
            </div>
        </div>
    </div>
</div>




<!-- Footer -->

<?php require_once("footer.php"); ?>

<!-- End footer -->
</body>
</html>


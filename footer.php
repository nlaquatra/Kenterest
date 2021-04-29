

<footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2021 Kenterest</p>
    <?php 
        if (isset($_SESSION["email"])) {
            echo "<li class=\"list-inline-item\"><a href=\"index.php\" style=\"text-decoration: none; \">Home</a></li>";
            echo "<li class=\"list-inline-item\"><a href=\"profile.php\" style=\"text-decoration: none; \">Profile</a></li>";
            echo "<li class=\"list-inline-item\"><a href=\"new-interest.php\" style=\"text-decoration: none; \">Post</a></li>";
            echo "<li class=\"list-inline-item\"><a href=\"includes/logout.inc.php\" style=\"text-decoration: none; \">Logout</a></li>";
        }
        else if (!isset($_SESSION["email"])) {
          echo "<li class=\"list-inline-item\"><a href=\"login.php\">Login</a></li>";
          echo "<li class=\"list-inline-item\"><a href=\"register.php\">Register</a></li>";
        }
    ?>
  </footer>
</div>


    <script src="js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

      <script src="form-validation.js"></script>
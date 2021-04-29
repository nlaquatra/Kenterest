<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'Kenterest');
   define('DB_PASSWORD', 'LHpKDPmzUDgKEOWn');
   define('DB_DATABASE', 'Kenterest');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   if (!$db) {
      die("ERROR: Could not connect. " . mysqli_connect_error());
   }
?>
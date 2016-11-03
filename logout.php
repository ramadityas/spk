<?php
session_start();
unset($_SESSION['id_user']);
echo "<script>
    location.replace('index.php')</script>";
?>
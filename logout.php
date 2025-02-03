<?php
include("includes/loginHeader.php");

if(isset($_SESSION['LoggedInUser'])){
    unset($_SESSION['LoggedInUser']);
    logoutSession();

    $_SESSION['success'] = "You've Logged Out";
    echo "<script>window.open('index.php', '_self')</script>";
}

?>
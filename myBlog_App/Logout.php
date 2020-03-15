<?php 
//action.php
session_start();
if(isset($_SESSION["username"])) {
    unset($_SESSION["username"]);
    unset($_SESSION["userid"]);
    unset($_SESSION["firstname"]);
}
header("Location: index.php");
?>
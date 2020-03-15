<?php 
//action.php
session_start();
include('include/connection.inc');
if(isset($_POST["username"])) {
    $sql = "
    SELECT * FROM T_Users
    WHERE User_Name = '" .$_POST["username"]. "'
    AND User_Password = '" .$_POST["password"]. "'
    ";
    $rs = mysqli_query($conn,$sql);
    if(mysqli_num_rows($rs) > 0)
    {
        $row = mysqli_fetch_array($rs);
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["userid"] = $row["User_ID"];
        $_SESSION["firstname"] = $row["User_FirstName"];
        echo 'Yes ' .$_SESSION["username"]. ' ' .$_SESSION["userid"]. '';
    }
    else {
        echo 'No';
    }
}
if(isset($_POST["action"])) {
    unset($_SESSION["username"]);
    unset($_SESSION["userid"]);
    unset($_SESSION["firstname"]);
}
?>
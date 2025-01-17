<?php
include("_db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tid = $_SESSION['userId'];
    $updatePassword = $_POST['updatePassword'];
    $updatePassword = password_hash($updatePassword, PASSWORD_DEFAULT);;
    
    

    $sql = "UPDATE `users` SET `password`='$updatePassword'  WHERE `user_id` = '$tid'";
    $result = $conn->query($sql);
    echo $result ? "Password changed" : "Error";
}
?>
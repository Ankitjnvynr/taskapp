<?php
    include("_db.php");

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $delid = $_POST['delid'];
        $sql = "DELETE FROM `tasks` WHERE `id` = '$delid'";
        $result = $conn->query($sql);
        $result ? $msg = "Dleted Succesfully": $msg = "Error to Delete";
        echo $msg;  
    }
    
?>
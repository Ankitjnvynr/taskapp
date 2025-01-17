<?php
    include("_db.php");
    $taskid = $_POST['taskid'];
    $state = $_POST['state'];
    
    $sql = "UPDATE `tasks` SET `status`= '$state' WHERE `id` = '$taskid'";
    $result = $conn->query($sql);
    if($result) {
        echo"updated";
    } else {
        echo "eror";
    }
?>
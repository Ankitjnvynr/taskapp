<img style="width:100%; aspect-ratio:1/1; object-fit:cover;" src="imgs/users/<?php
        session_start();
        $user_id = $_SESSION['userId'];
        include("_db.php");
        $sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id' ";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo $row["pic"];
            $_SESSION['userpic']=$row["pic"];
        }
        ?>"
        >


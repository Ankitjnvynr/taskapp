<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = '../imgs/users/';  
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);
    $fileName = basename($_FILES['image']['name']);
    // $fileName = $_FILES['image']['name'];

    // Check if the file has been successfully uploaded
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        include("_db.php");
        session_start();

        $userId = $_SESSION['userId'];

        // Update the 'pic' column in the 'users' table
        $sql = "UPDATE users SET pic = '$fileName' WHERE user_id = $userId";

        if ($conn->query($sql) === TRUE) {
            if($_SESSION['userpic'] != 'userdefault.png'){
                unlink('../imgs/users/'. $_SESSION['userpic']);
            }
            echo 'Successfully updated.';
        } else {
            echo 'Error updating database: ' . $conn->error;
        }

        // Close the database connection
        $conn->close();

    } else {
        echo 'Error uploading file.';
    }
} else {
    echo 'Invalid request.';
}

?>

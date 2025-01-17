<?php
date_default_timezone_set("Asia/Kolkata");
header('Content-Type: application/json');

include("_db.php");
session_start();
$user_id = isset($_SESSION['userId'])?$_SESSION['userId']:14;

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];
   
    if ($task != '') {
        $tod = new DateTime;
        $today = $tod->format("y-m-d");

        $sql = "INSERT INTO `tasks` (`task`, `user_id`,  `dt`) VALUES ('$task','$user_id', '$today')";
        $result = $conn->query($sql);
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'Task Added';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Some Error';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Task cannot be empty';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid Request Method';
}

echo json_encode($response);
?>
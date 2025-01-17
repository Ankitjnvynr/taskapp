<?php
date_default_timezone_set("Asia/Kolkata");

?>

<?php
include("_db.php");
session_start();
$user_id = $_SESSION['userId'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];
    $fromTime = $_POST['fromTime'];
    $toTime = $_POST['toTime'];
    if ($task!='') {
          $tod = new DateTime;
        // $today = strval($today);
        $today = $tod->format("y-m-d");

        $sql = "INSERT INTO `tasks` (`task`, `user_id`, `fromtime`, `totime`, `dt`) VALUES ('$task','$user_id','$fromTime','$toTime', '$today')";
        $result = $conn->query($sql);
        if ($result) {
            echo "Task Added";
        } else {
            echo "Some Error";
        }
    }
}
?>
<?php
include("_db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tid = $_POST['upid'];
    $uptask = $_POST['uptask'];
    $ufromTime = $_POST['ufromTime'];
    $utoTime = $_POST['utoTime'];
    // echo $tid . '' . $uptask . '';

    $sql = "UPDATE `tasks` SET `task`='$uptask', `fromtime`='$ufromTime', `totime`='$utoTime'  WHERE `id` = '$tid'";
    $result = $conn->query($sql);
    echo $result ? "Update success" : "Error";
}
?>
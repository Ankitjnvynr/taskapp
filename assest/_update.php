<?php
include("_db.php");

header('Content-Type: application/json'); // Set the response header to JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = []; // Initialize the response array

    // Retrieve and sanitize input data
    $tid = $_POST['upid'] ?? null;
    $uptask = $_POST['uptask'] ?? null;

    if ($tid && $uptask) {
        // Prepare and execute the SQL query
        $sql = "UPDATE `tasks` SET `task` = ? WHERE `id` = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("si", $uptask, $tid); // Bind parameters
            if ($stmt->execute()) {
                $response = [
                    "status" => "success",
                    "message" => "Task updated successfully"
                ];
            } else {
                $response = [
                    "status" => "error",
                    "message" => "Failed to update task"
                ];
            }
            $stmt->close(); // Close the prepared statement
        } else {
            $response = [
                "status" => "error",
                "message" => "Failed to prepare query"
            ];
        }
    } else {
        $response = [
            "status" => "error",
            "message" => "Invalid input data"
        ];
    }

    echo json_encode($response); // Return JSON response
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
}
?>

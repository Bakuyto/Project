<?php
session_start(); // Start the session

// Include your database connection file
include '../../connection/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['active_status'])) {

    // Assuming you want to use 'user_department_fk' as the ID
    $id = isset($_SESSION['user_department_fk']) ? intval($_SESSION['user_department_fk']) : null;
    $status = $_POST['active_status'];

    if($id !== null) {
        // Prepare the SQL statement to avoid SQL injection
        $stmt = $conn->prepare("CALL Product_Status(?, ?)");
        $stmt->bind_param("ii", $id, $status);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to main.php after successful execution
            header("Location: ../main.php");
            exit(); // Exit to prevent further execution
        } else {
            // Error handling
            echo "Error executing the query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "ID is not set.";
    }
}
?>

<?php
session_start(); // Start the session

// Include your database connection file
include '../../connection/connect.php';

// Check if the department ID is set in the session
if (isset($_SESSION['user_department_fk'])) {
    // Retrieve the department ID from the session
    $department_id = $_SESSION['user_department_fk'];

    // Prepare the SQL statement to retrieve the active status
    $stmt = $conn->prepare("SELECT active_status FROM tbldepartment WHERE department_pk = ?");
    $stmt->bind_param("i", $department_id);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Bind the result variables
        $stmt->bind_result($active_status);

        // Fetch the result
        $stmt->fetch();

        // Create an array to hold the result
        $result = array("active_status" => $active_status);

        // Close the statement
        $stmt->close();

        // Return the result as JSON
        echo json_encode($result);
    } else {
        // Error handling
        echo json_encode(array("error" => "Error executing the query"));
    }
} else {
    // If department ID is not set in the session
    echo json_encode(array("error" => "Department ID is not set"));
}
?>

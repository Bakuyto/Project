<?php
session_start(); // Start the session

// Include your database connection file
include '../../connection/connect.php';

$current_status = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status'])) {
    // Get the status from POST data
    $status = intval($_POST['status']); // Sanitize input data

    // Assuming you want to use 'user_department_fk' as the ID
    $id = isset($_SESSION['user_department_fk']) ? intval($_SESSION['user_department_fk']) : null;

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
} else {
    // Fetch the current status if the user_department_fk is set
    if(isset($_SESSION['user_department_fk'])) {
        // Get the department ID
        $id = intval($_SESSION['user_department_fk']);

        // Fetch only the current product status from the database
        $sql = "SELECT product_status FROM tbldepartment WHERE department_pk = ?";
        
        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);
        // Bind the parameter
        $stmt->bind_param("i", $id);
        // Execute the prepared statement
        $stmt->execute();
        // Bind the result variable
        $stmt->bind_result($current_status);
        
        // Fetch the result
        $stmt->fetch();

        // Close the statement
        $stmt->close();
    }
}
?>
<?php
// Initialize the message variable
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if department_pk is set and not empty
    if (isset($_POST['department_pk']) && !empty($_POST['department_pk'])) {
        // Get department_pk from the form submission
        $department_pk = $_POST['department_pk'];

        // Check if brands array is set and not empty
        if (isset($_POST['brands']) && !empty($_POST['brands'])) {
            // Include the database connection file
            include '../../connection/connect.php';

            // Prepare a SQL statement for inserting data into the database
            $sql = "Call Insert_Multiple_Checkbox(?,?)";

            // Prepare the statement
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("is", $department_pk, $brand_name);

            // Loop through each selected brand
            foreach ($_POST['brands'] as $brand) {
                // Set brand_name to the current selected brand
                $brand_name = $brand;

                // Execute the statement
                $stmt->execute();
            }

            // Close the statement
            $stmt->close();

            // Close the database connection
            $conn->close();

            // Set success message
            $message = "Data inserted successfully";
        } else {
            // Set message if no brands selected
            $message = "No brands selected.";
        }
    } else {
        // Set message if department_pk is missing
        $message = "Department primary key is missing.";
    }
} else {
    // Set message for invalid request method
    $message = "Invalid request.";
}

// Pass the message back to create-user.php using URL parameter
header("Location: ../create-user.php?message=" . urlencode($message));
exit();
?>

<?php
include '../../connection/connect.php';

// Handling form submission for creating a new department's transaction
if(isset($_POST['save_multiple_checkbox'])) {
    // Validate department_pk
    if(isset($_POST['department_pk']) && !empty($_POST['department_pk']) && is_numeric($_POST['department_pk'])) {
        $department_pk = intval($_POST['department_pk']);
    } else {
        // Handle the case where department_pk is missing or empty
        $_SESSION['status'] = "Error: department_pk is missing or empty.";
        header("Location: ../create-user.php");
        exit();
    }
    // Check if brands array is set and not empty
    if(isset($_POST['brands']) && !empty($_POST['brands'])) {
        $brands = $_POST['brands'];

        // Use prepared statements to prevent SQL injection
        $insert_sql = "CALL Insert_Multiple_Checkbox(?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);

        if ($insert_stmt) {
            // Bind parameters
            $insert_stmt->bind_param("is", $department_pk, $brand);

            // Loop through brands array and execute the prepared statement for each brand
            foreach($brands as $brand) {
                if ($insert_stmt->execute()) {
                    continue; // Move to the next iteration if successful
                } else {
                    // Handle insertion failure
                    $_SESSION['status'] = "Insertion failed: " . $insert_stmt->error;
                    header("Location: ../create-user.php");
                    exit();
                }
            }
            // Close the prepared statement
            $insert_stmt->close();
        } else {
            // Handle statement preparation failure
            $_SESSION['status'] = "Statement preparation failed: " . $conn->error;
            header("Location: ../create-user.php");
            exit();
        }
        
        // Set success message and redirect
        $_SESSION['status'] = "Inserted Successfully";
        header("Location: ../create-user.php");
        exit();
    } else {
        // No brands selected, show an alert and redirect
        echo '<script>alert("Please select at least one brand!");</script>';
        echo '<script>window.location.href = window.location.href;</script>';
        exit();
    }
} else {
    // Handle case where save_multiple_checkbox is not set
    $_SESSION['status'] = "Error: save_multiple_checkbox is not set.";
    header("Location: ../create-user.php");
    exit();
}
?>

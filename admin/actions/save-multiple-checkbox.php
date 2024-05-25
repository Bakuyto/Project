<?php
// Initialize the message variable
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if department_pk is set and not empty
    if (isset($_POST['department_pk']) && !empty($_POST['department_pk'])) {
        // Check if brands array is set
        if (isset($_POST['brands']) && !empty($_POST['brands'])) {
            // Include the database connection file
            include '../../connection/connect.php';

            // Retrieve previously stored selection of items for the department
            $sql_previous_selection = "SELECT product_tran_name_str FROM tblproductadjustpermission WHERE department_fk = ?";
            $stmt_previous_selection = $conn->prepare($sql_previous_selection);
            $stmt_previous_selection->bind_param("i", $_POST['department_pk']);
            $stmt_previous_selection->execute();
            $result_previous_selection = $stmt_previous_selection->get_result();

            // Initialize an array to store the previously selected items
            $previous_selection = array();
            while ($row = $result_previous_selection->fetch_assoc()) {
                $previous_selection[] = $row['product_tran_name_str'];
            }
            $stmt_previous_selection->close();

            // Begin a transaction
            $conn->begin_transaction();

            try {
                // Loop through each selected brand
                foreach ($_POST['brands'] as $brand) {
                    // If the brand is checked but not in the previous selection, insert it
                    if (!in_array($brand, $previous_selection)) {
                        $sql_insert = "INSERT INTO tblproductadjustpermission (department_fk, product_tran_name_str) VALUES (?, ?)";
                        $stmt_insert = $conn->prepare($sql_insert);
                        $stmt_insert->bind_param("is", $_POST['department_pk'], $brand);
                        $stmt_insert->execute();
                        $stmt_insert->close();
                    } else {
                        // Remove the item from the previous selection to mark it as processed
                        $index = array_search($brand, $previous_selection);
                        unset($previous_selection[$index]);
                    }
                }

                // Delete unchecked items that were previously selected
                foreach ($previous_selection as $unchecked_item) {
                    $sql_delete = "DELETE FROM tblproductadjustpermission WHERE department_fk = ? AND product_tran_name_str = ?";
                    $stmt_delete = $conn->prepare($sql_delete);
                    $stmt_delete->bind_param("is", $_POST['department_pk'], $unchecked_item);
                    $stmt_delete->execute();
                    $stmt_delete->close();
                }

                // Commit the transaction
                $conn->commit();

                // Set success message
                $message = "Data updated successfully";
            } catch (Exception $e) {
                // Rollback the transaction on error
                $conn->rollback();
                $message = "Error occurred: " . $e->getMessage();
            }

            // Close the database connection
            $conn->close();
        } else {
            // Set message if no brands selected
            $message = "No brands selected.";
            // Pass the error message back to create-user.php using URL parameter
            header("Location: ../setting.php?error=true&message=" . urlencode($message));
            exit();
        }
    } else {
        // Set message if department_pk is missing
        $message = "Department primary key is missing.";
        // Pass the error message back to create-user.php using URL parameter
        header("Location: ../setting.php?error=true&message=" . urlencode($message));
        exit();
    }
} else {
    // Set message for invalid request method
    $message = "Invalid request.";
    // Pass the error message back to create-user.php using URL parameter
    header("Location: ../setting.php?error=true&message=" . urlencode($message));
    exit();
}

// Pass the message back to create-user.php using URL parameter
header("Location: ../setting.php?success=true&message=" . urlencode($message));
exit();
?>

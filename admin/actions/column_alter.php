<?php
include '../../connection/connect.php';
// Check if the form has been submitted
if(isset($_POST['alter_table'])) {
    // Retrieve selected column names from the form
    $alter_column = isset($_POST['alter_column']) ? $_POST['alter_column'] : '';
    $after_column = isset($_POST['after_column']) ? $_POST['after_column'] : '';

    // Construct the ALTER TABLE query dynamically
    $alter_query = "ALTER TABLE `inventorymanagement`.`tblproduct_transaction` CHANGE `$alter_column` `$alter_column` INT(11) DEFAULT 0 NULL AFTER `$after_column`";

    // Execute the query
    if ($conn->query($alter_query) === TRUE) {
        header("Location: ../setting.php");
    } else {
        header("Location: ../setting.php");
    }
}

// Close the connection
$conn->close();
?>
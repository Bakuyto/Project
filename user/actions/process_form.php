<?php
// Check if the form is submitted via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Include your database connection script
    include '../../connection/connect.php';

    // Assuming your form fields are named after database columns
    // You can retrieve the values submitted in the form like this:
    $values = array();
    foreach ($_POST as $key => $value) {
        // Prevent SQL injection by using prepared statements
        $escaped_value = $conn->real_escape_string($value);

        // Set default value to '0' if the field is empty
        $values[$key] = !empty($escaped_value) ? $escaped_value : '0';

        // Check if product_name is empty and handle it as required
        if ($key === 'product_name' && empty($escaped_value)) {
            echo json_encode(array("success" => false, "error" => "Product name is required"));
            exit;
        }
    }

    // Now, you can process the submitted data, for example, inserting it into the database
    // Assuming 'tblproduct_transaction' is your table name
    $columns = implode(", ", array_keys($values));
    $columnValues = "'" . implode("', '", $values) . "'";

    $sql = "INSERT INTO tblproduct_transaction ($columns) VALUES ($columnValues)";
    if ($conn->query($sql) === TRUE) {
        // Insertion successful for tblproduct_transaction

        // Get the ID generated for the inserted record
        $last_insert_id = $conn->insert_id;

        // Now insert into tblproduct_sales_months with the obtained ID
        $product_fk = $last_insert_id; // Use the ID from tblproduct_transaction
        $sql_sales_months = "INSERT INTO tblproduct_sales_months (product_fk) VALUES ('$product_fk')";

        if ($conn->query($sql_sales_months) === TRUE) {
            // Insertion successful for tblproduct_sales_months
            echo json_encode(array("success" => true)); // Send success response
        } else {
            // Error occurred for tblproduct_sales_months
            echo json_encode(array("success" => false, "error" => $conn->error)); // Send error response
        }
    } else {
        // Error occurred for tblproduct_transaction
        echo json_encode(array("success" => false, "error" => $conn->error)); // Send error response
    }

    // Close the database connection
    $conn->close();
} else {
    // If the request is not via AJAX, handle accordingly
    // For example, redirect the user to an error page
    header("Location: error_page.php");
    exit; // Stop further execution
}
?>

<?php
// Check if the form is submitted via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Include your database connection script
    include '../../connection/connect.php';

    // Check if required fields are set and not empty
    $required_fields = array("product_name", "product_type_fk");
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(array("success" => false, "error" => ucfirst($field) . " is required"));
            exit;
        }
    }

    // Escape and prepare data for insertion
    $values = array();
    foreach ($_POST as $key => $value) {
        $escaped_value = $conn->real_escape_string($value);
        $values[$key] = !empty($escaped_value) ? "'" . $escaped_value . "'" : '0';
    }

    // Insert data into tblproduct_transaction
    $columns = implode(", ", array_keys($values));
    $columnValues = implode(", ", $values);

    $sql = "INSERT INTO tblproduct_transaction ($columns) VALUES ($columnValues)";
    if ($conn->query($sql) === TRUE) {
        // Get the ID generated for the inserted record
        $last_insert_id = $conn->insert_id;

        // Insert into tblproduct_sales_months with the obtained ID
        $product_fk = $last_insert_id; // Use the ID from tblproduct_transaction
        $sql_sales_months = "INSERT INTO tblproduct_sales_months (product_fk) VALUES ('$product_fk')";

        if ($conn->query($sql_sales_months) === TRUE) {
            echo json_encode(array("success" => true)); // Send success response
        } else {
            echo json_encode(array("success" => false, "error" => "Error occurred for tblproduct_sales_months: " . $conn->error)); // Send error response
        }
    } else {
        echo json_encode(array("success" => false, "error" => "Error occurred for tblproduct_transaction: " . $conn->error)); // Send error response
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

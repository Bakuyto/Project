<?php
include '../../connection/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Get the value of product type name from the form
    $product_type_name = $_POST['typeName'];

    // Check if the product type name already exists
    $check_stmt = $conn->prepare("SELECT * FROM tblproduct_type WHERE product_type_name = ?");
    $check_stmt->bind_param("s", $product_type_name);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(array("success" => false, "error" => "Product type already exists."));
    } else {
        // Prepare and bind parameters using a prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO tblproduct_type (product_type_name) VALUES (?)");
        $stmt->bind_param("s", $product_type_name);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false, "error" => "Error inserting data: " . $stmt->error));
        }

        // Close the statement and the database connection
        $stmt->close();
    }

    // Close the check statement and the database connection
    $check_stmt->close();
    $conn->close();
}
?>
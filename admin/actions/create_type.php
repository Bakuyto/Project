<?php
// Include your database connection or any necessary setup here
include '../../connection/connect.php'; // Adjust this path as per your actual setup

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Get the value of product type name from the form
    $typeName = $_POST['typeName'];

    // Check if the product type name already exists
    $check_stmt = $conn->prepare("SELECT * FROM tblproduct_type WHERE product_type_name = ?");
    $check_stmt->bind_param("s", $typeName);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Product type already exists
        echo json_encode(array("success" => false, "error" => "Product type already exists."));
    } else {
        // Product type does not exist, proceed with insertion
        $insert_stmt = $conn->prepare("INSERT INTO tblproduct_type (product_type_name) VALUES (?)");
        $insert_stmt->bind_param("s", $typeName);

        if ($insert_stmt->execute()) {
            // Insertion successful
            $product_id = $insert_stmt->insert_id;
            echo json_encode(array("success" => true, "product_id" => $product_id));
        } else {
            // Insertion failed
            echo json_encode(array("success" => false, "error" => "Error inserting product type."));
        }

        // Close insert statement
        $insert_stmt->close();
    }

    // Close check statement and connection
    $check_stmt->close();
    $conn->close();
}
?>

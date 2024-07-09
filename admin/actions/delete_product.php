<?php
include '../../connection/connect.php'; // Adjust path based on your file structure

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the product ID from the POST data and sanitize it
    $productId = intval($_POST['id']);
    
    // Prepare the SQL statement to delete the record
    $sql = "DELETE tblproduct_transaction, tblproduct_sales_months 
            FROM tblproduct_transaction 
            INNER JOIN tblproduct_sales_months 
            ON tblproduct_transaction.product_pk = tblproduct_sales_months.product_fk
            WHERE tblproduct_transaction.product_pk = ?";
    
    // Use prepared statements to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        
        // Check if the deletion was successful
        if ($stmt->affected_rows > 0) {
            $response = array('success' => true);
        } else {
            $response = array('success' => false, 'message' => 'Record not found or could not be deleted');
        }
        
        $stmt->close();
    } else {
        $response = array('success' => false, 'message' => 'Failed to prepare the SQL statement');
    }
    
    // Close the database connection
    $conn->close();
    
    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Return an error response if the request method is not POST
    $response = array('success' => false, 'message' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

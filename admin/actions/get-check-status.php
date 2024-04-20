<?php
// Include your database connection file
include '../connection/connect.php';

// Check if department PK is received
if(isset($_POST['department_pk'])) {
    // Sanitize and assign the department PK
    $department_pk = $_POST['department_pk'];

    // Prepare and execute SQL query to retrieve checked status of checkboxes for the specified department
    $sql = "SELECT product_tran_name_str FROM tblproductadjustpermission WHERE department_fk = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $department_pk);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the checked checkboxes and store them in an array
    $checked_boxes = array();
    while ($row = $result->fetch_assoc()) {
        $checked_boxes[] = $row['product_tran_name_str'];
    }

    // Close statement
    $stmt->close();

    // Encode the array as JSON and send the response
    echo json_encode($checked_boxes);
} else {
    // If department PK is not received, send an error response
    echo "Error: Department PK not received.";
}

// Close database connection
$conn->close();
?>

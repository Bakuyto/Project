<?php
// Include the database connection
include '../../connection/connect.php';

// Check if the product type is set
if(isset($_POST['productType'])) {
    // Get the selected product type
    $productType = $_POST['productType'];

    // Call the stored procedure to update table columns based on the selected product type
    $stmt = $conn->prepare("CALL update_table_column('', ?)");
    $stmt->bind_param("i", $productType);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the filtered data
    $filteredData = [];
    while($row = $result->fetch_assoc()) {
        $filteredData[] = $row;
    }

    // Close statement
    $stmt->close();

    // Output the filtered data
    echo json_encode($filteredData);
} else {
    // If product type is not set, return an empty array
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>

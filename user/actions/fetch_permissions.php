<?php

// Include your database connection file
include '../../connection/connect.php';

// Check if session is started
if (!isset($_SESSION)) {
    session_start();
}

// Fetch permission data from the database
if (isset($_SESSION['user_department_fk'])) {
    $user_department_fk = $_SESSION['user_department_fk'];
    $sql_permission = "SELECT product_tran_name_str FROM tblproductadjustpermission WHERE department_fk = '$user_department_fk'";
    $result_permission = $conn->query($sql_permission);

    // Check if there are any results
    if ($result_permission && $result_permission->num_rows > 0) {
        // Prepare an array to hold the permission data
        $permissions = array();

        // Loop through each row of the result set
        while ($row_permission = $result_permission->fetch_assoc()) {
            // Add the permission to the permissions array
            $permissions[] = $row_permission['product_tran_name_str'];
        }
    } else {
        // Handle case where no permissions are found
        $permissions = array();
    }
} else {
    // Handle case where user_department_fk is not set in session
    $permissions = array();
}


// Initialize an empty array to hold the data
$data = [];

// Get the search text and product type parameters from the GET request
$searchText = isset($_GET['search']) ? $_GET['search'] : '';
$productType = isset($_GET['product_type']) ? $_GET['product_type'] : null;

// Convert productType to null if it's 'null' or empty string
$productType = ($productType === null || $productType === 'null' || $productType === '') ? null : (int)$productType;

// Prepare the SQL query based on the presence of productType
if ($productType === null) {
    $sql = "CALL update_table_column(?, NULL)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $searchText);
} else {
    $sql = "CALL update_table_column(?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $searchText, $productType);
}

// Execute the statement
if ($stmt->execute()) {
    // Fetch the result set
    $result = $stmt->get_result();
    if ($result) {
        // Check if there are rows returned
        if ($result->num_rows > 0) {
            // Fetch each row from the result set
            while ($row = $result->fetch_assoc()) {
                // Add modified row to the data array
                $data[] = $row;
            }
        }
        // Get the total number of records
        $totalRecords = count($data);
        // Close the result set
        $result->close();
    } else {
        // Handle database error
        echo json_encode(["error" => "Database error: " . $stmt->error]);
        exit;
    }
} else {
    // Handle execution error
    echo json_encode(["error" => "Execution error: " . $stmt->error]);
    exit;
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();

// Combine data and permissions and return as JSON
$response = array(
    'data' => $data,
    'permissions' => $permissions,
    'totalRecords' => $totalRecords
);

// Output data as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

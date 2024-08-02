<?php

include '../../connection/connect.php';

session_start();

// Initialize variables
$permissions = [];
$data = [];
$totalRecords = 0;

// Fetch permissions
if (isset($_SESSION['user_department_fk'])) {
    $user_department_fk = $_SESSION['user_department_fk'];

    // Use prepared statements to fetch permissions
    $sql_permission = "SELECT product_tran_name_str FROM tblproductadjustpermission WHERE department_fk = ?";
    $stmt_permission = $conn->prepare($sql_permission);
    $stmt_permission->bind_param('i', $user_department_fk);
    $stmt_permission->execute();
    $result_permission = $stmt_permission->get_result();

    if ($result_permission->num_rows > 0) {
        while ($row_permission = $result_permission->fetch_assoc()) {
            $permissions[] = $row_permission['product_tran_name_str'];
        }
    }
    $stmt_permission->close();
}

// Get parameters
$searchText = isset($_GET['search']) ? $_GET['search'] : '';
$productType = isset($_GET['product_type']) ? $_GET['product_type'] : null;

// Sanitize inputs
$searchText = $conn->real_escape_string($searchText);
$productType = ($productType === 'null' || $productType === '') ? null : (int)$productType;

// Prepare SQL based on productType
if ($productType === null) {
    $sql = "CALL update_table_column(?, NULL)";
} else {
    $sql = "CALL update_table_column(?, ?)";
}

$stmt = $conn->prepare($sql);

// Bind parameters and execute
if ($productType === null) {
    $stmt->bind_param("s", $searchText);
} else {
    $stmt->bind_param("si", $searchText, $productType);
}

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $totalRecords = count($data);
        $result->close();
    } else {
        echo json_encode(["error" => "Database error: " . $stmt->error]);
        exit;
    }
} else {
    echo json_encode(["error" => "Execution error: " . $stmt->error]);
    exit;
}

$stmt->close();
$conn->close();

// Return response
$response = [
    "data" => $data,
    "permissions" => $permissions,
    "totalRecords" => $totalRecords
];

header('Content-Type: application/json');
echo json_encode($response);
?>

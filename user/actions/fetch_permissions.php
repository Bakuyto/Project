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

$searchText = "";

// Check if search parameter is provided
if(isset($_GET['search'])) {
    // Sanitize and store the search parameter
    $searchText = mysqli_real_escape_string($conn, $_GET['search']);
}

// Prepare the SQL query with the search text parameter
$sql = "CALL update_table_column('$searchText', NULL)";
$result = $conn->query($sql);

// Prepare an array to hold the fetched data
$data = array();

if ($result && $result->num_rows > 0) {
    // Fetch each row from the result set
    while ($row = $result->fetch_assoc()) {
        // Add modified row to the data array
        $data[] = $row;
    }
}

// Close the database connection
$conn->close();

// Combine data and permissions and return as JSON
$response = array(
    'data' => $data,
    'permissions' => $permissions
);

// Output data as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

<?php
include '../../connection/connect.php';  // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $department_id = intval($_POST['department_id']);
    $active_status = intval($_POST['active_status']);

    $stmt = $conn->prepare("UPDATE tbldepartment SET active_status = ? WHERE department_pk = ?");
    $stmt->bind_param('ii', $active_status, $department_id);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();  // Close the database connection
}
?>

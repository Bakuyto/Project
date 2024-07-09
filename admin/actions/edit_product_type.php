<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../connection/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newTypeName = $_POST['editTypeName'];
    $currentProductTypeID = $_POST['currentProductTypeID'];

    if (!$newTypeName || !$currentProductTypeID) {
        $response = ['status' => 'error', 'message' => 'Invalid input data'];
        echo json_encode($response);
        exit;
    }

    // Check if the new type name already exists
    $sql_check = "SELECT COUNT(*) FROM tblproduct_type WHERE product_type_name = ? AND product_type_pk != ?";
    $stmt_check = $conn->prepare($sql_check);
    if ($stmt_check === false) {
        $response = ['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error];
        echo json_encode($response);
        exit;
    }

    $stmt_check->bind_param("si", $newTypeName, $currentProductTypeID);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        $response = ['status' => 'error', 'message' => 'Product type already exists'];
        echo json_encode($response);
        exit;
    }

    // Proceed with the update if the type name is unique
    $sql_update = "UPDATE tblproduct_type SET product_type_name = ? WHERE product_type_pk = ?";
    $stmt_update = $conn->prepare($sql_update);
    if ($stmt_update === false) {
        $response = ['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error];
        echo json_encode($response);
        exit;
    }

    $stmt_update->bind_param("si", $newTypeName, $currentProductTypeID);

    if ($stmt_update->execute()) {
        $response = ['status' => 'success', 'message' => 'Product type updated successfully.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Execute failed: ' . $stmt_update->error];
    }

    echo json_encode($response);
    $stmt_update->close();
    $conn->close();
}
?>

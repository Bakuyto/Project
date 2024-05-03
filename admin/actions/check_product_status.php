<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['saveChangesBtn'])) {
        // Include the connection file
        include '../../connection/connect.php';

        // Fetch department names with product_status = 0
        $check_sql = "SELECT department_name FROM tbldepartment WHERE product_status = 0";
        $check_result = $conn->query($check_sql);
        
        if ($check_result) {
            $departments = [];
            while ($row = $check_result->fetch_assoc()) {
                $departments[] = $row['department_name'];
            }
            
            if (!empty($departments)) {
                // Some departments have product_status set to 0, so prevent insertion
                http_response_code(400); // Set HTTP response code to indicate failure
                echo json_encode($departments); // Return department names with product_status = 0
                exit; // Stop further execution
            }
        } else {
            // Error in executing the check query
            http_response_code(500); // Set HTTP response code to indicate server error
            echo "Error checking product_status: " . $conn->error;
            exit; // Stop further execution
        }

    } else {
        // Respond with a message indicating that Insert_data is not set
        http_response_code(400); // Set HTTP response code to indicate failure
        echo "Insert_data is not set";
        exit; // Stop further execution
    }
}
?>

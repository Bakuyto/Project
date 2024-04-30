<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Insert_data'])) {
        // Include the connection file
        include '../../connection/connect.php';

        // Check if any product_status values are not 1 or NULL
        $check_sql = "SELECT COUNT(*) AS count FROM tbldepartment WHERE product_status IS NULL OR product_status != 1";
        $check_result = $conn->query($check_sql);
        
        if ($check_result) {
            $row = $check_result->fetch_assoc();
            $count = $row['count'];
            if ($count > 0) {
                // Some product_status values are not 1 or NULL, so prevent insertion
                echo "Cannot insert data because not all product_status values are set to 1.";
                exit; // Stop further execution
            }
        } else {
            // Error in executing the check query
            echo "Error checking product_status: " . $conn->error;
            exit; // Stop further execution
        }

        // Prepare the SQL statement
        $sql = "CALL Insert_data()";

        // Assuming you are using mysqli for database connection
        if ($conn->query($sql) === TRUE) {
            // Reset all product_status values to 0
            $reset_sql = "UPDATE tbldepartment SET product_status = 0";
            if ($conn->query($reset_sql) === TRUE) {
                echo "Data inserted successfully and product_status values reset to 0.";
            } else {
                echo "Error resetting product_status values: " . $conn->error;
            }
        } else {
            // Respond with an error message
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Respond with a message indicating that Insert_data is not set
        echo "Insert_data is not set";
    }
}
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Insert_data'])) {
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

        // Prepare the SQL statement
        $sql = "CALL Insert_data()";

        // Assuming you are using mysqli for database connection
        if ($conn->query($sql) === TRUE) {
            $reset_sql = "UPDATE tbldepartment SET product_status = 0";
            if ($conn->query($reset_sql) === TRUE) {
                echo "Data inserted successfully and product_status values reset to 0.";
                exit;
            } else {
                echo "Error resetting product_status values: " . $conn->error;
                exit;
            } // Stop further execution
        } else {
            // Respond with an error message
            http_response_code(500); // Set HTTP response code to indicate server error
            echo "Error inserting data: " . $conn->error;
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

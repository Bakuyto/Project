<?php

// Include the connection file
include '../../connection/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['saveanyway'])) {
        // Validate user_pk
        $user_pk = $_POST['user_pk'];
        
        // Validate entered password
        $entered_password = $_POST['password'];

        // Prepare and execute statement to retrieve user's password
        $stmt = $conn->prepare("SELECT user_log_password FROM tbluser WHERE user_pk = ?");
        if ($stmt) {
            $stmt->bind_param("i", $user_pk);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($user_log_password);
                $stmt->fetch();
                
                // Verify password
                if ($entered_password === $user_log_password) {
                    // Proceed with data insertion
                    $sql = "CALL Insert_data()";

                    if ($conn->query($sql) === TRUE) {
                        $response = array('success' => true);
                        echo json_encode($response);
                        exit; // Stop further execution
                    } else {
                        $response = array('error' => 'Error inserting data: ' . $conn->error);
                        echo json_encode($response);
                        exit; // Stop further execution
                    }
                } else {
                    $response = array('error' => 'Incorrect password');
                    echo json_encode($response);
                    exit; // Stop further execution
                }
            } else {
                $response = array('error' => 'User not found');
                echo json_encode($response);
                exit; // Stop further execution
            }
        } else {
            $response = array('error' => 'Database error: ' . $conn->error);
            echo json_encode($response);
            exit; // Stop further execution
        }
    } else {
        $response = array('error' => 'saveanyway is not set');
        echo json_encode($response);
        exit; // Stop further execution
    }
}

?>

<?php
session_start(); // Start session if not already started
$response = array(); // Initialize an array to store the response

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Insert_data'])) {
        // Include the connection file
        include '../../connection/connect.php';

        // Validate user_pk
        if(isset($_POST['user_pk']) && is_numeric($_POST['user_pk'])) {
            $user_pk = $_POST['user_pk'];
            
            // Validate entered password
            if(isset($_POST['password'])) {
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
                                $reset_sql = "UPDATE tbldepartment SET product_status = 0";
                                if ($conn->query($reset_sql) === TRUE) {
                                    $response['success'] = true;
                                    $response['message'] = "Data inserted successfully";
                                } else {
                                    // Respond with an error message
                                    http_response_code(500); // Set HTTP response code to indicate server error
                                    $response['error'] = "Error resetting product_status values: " . $conn->error;
                                }
                            } else {
                                // Respond with an error message
                                http_response_code(500); // Set HTTP response code to indicate server error
                                $response['error'] = "Error inserting data: " . $conn->error;
                            }
                        } else {
                            // Password does not match
                            http_response_code(401); // Set HTTP response code to indicate unauthorized
                            $response['error'] = "Incorrect password";
                        }
                    } else {
                        // User not found
                        http_response_code(404); // Set HTTP response code to indicate not found
                        $response['error'] = "User not found";
                    }
                } else {
                    // Database error
                    $error_message = "Database error: " . $conn->error;
                    error_log($error_message); // Log the error
                    http_response_code(500); // Set HTTP response code to indicate server error
                    $response['error'] = $error_message;
                }
            } else {
                // Respond with a message indicating that password is not set
                http_response_code(400); // Set HTTP response code to indicate failure
                $response['error'] = "Password is not set";
            }
        } else {
            // Respond with a message indicating that user_pk is not set or invalid
            http_response_code(400); // Set HTTP response code to indicate failure
            $response['error'] = "Invalid user_pk";
        }
    } else {
        // Respond with a message indicating that Insert_data is not set
        http_response_code(400); // Set HTTP response code to indicate failure
        $response['error'] = "Insert_data is not set";
    }
} else {
    // Respond with a message indicating invalid request method
    http_response_code(405); // Set HTTP response code to indicate method not allowed
    $response['error'] = "Invalid request method";
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>

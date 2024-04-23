<?php
session_start();
include '../../connection/connect.php';


// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the received data
    if (isset($_POST['user_pk'], $_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword'])) {
        $user_pk =$_POST['user_pk'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        // Check if new password matches confirm password
        if ($newPassword !== $confirmPassword) {
            $response = array("success" => false, "message" => "New password and confirm password do not match.");
            echo json_encode($response);
            exit;
        }

        // Retrieve user data to validate current password
        $sql = "SELECT user_log_password FROM tbluser WHERE user_pk = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $user_pk);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $storedPassword = $row['user_log_password'];

                // Verify if the current password matches the one stored in the database
                if ($currentPassword === $storedPassword) {
                    // Update the password
                    $updateSql = "UPDATE tbluser SET user_log_password = ? WHERE user_pk = ?";
                    $stmt_update = $conn->prepare($updateSql);
                    if ($stmt_update) {
                        $stmt_update->bind_param("si", $newPassword, $user_pk);
                        if ($stmt_update->execute()) {
                            $response = array("success" => true, "message" => "Password updated successfully.");
                        } else {
                            $response = array("success" => false, "message" => "Error updating password.");
                        }
                        $stmt_update->close();
                    } else {
                        $response = array("success" => false, "message" => "Error preparing update statement.");
                    }
                } else {
                    $response = array("success" => false, "message" => "Incorrect current password.");
                }
            } else {
                $response = array("success" => false, "message" => "User not found.");
            }
            $stmt->close();
        } else {
            $response = array("success" => false, "message" => "Error preparing statement.");
        }
    } else {
        $response = array("success" => false, "message" => "Required fields are missing.");
    }
} else {
    $response = array("success" => false, "message" => "Update user data not received.");
}

// Output the JSON response
echo json_encode($response);

// Close the database connection
$conn->close();
?>

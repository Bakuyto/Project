<?php
session_start();
include '../../connection/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the received data
    if (isset($_POST['user_pk'], $_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword'])) {
        $user_pk = $_POST['user_pk'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        // Validate if the new password matches confirm password
        if ($newPassword !== $confirmPassword) {
            echo '<script>window.alert("New password and confirm password do not match."); window.location.href="../main.php";</script>';
            exit;
        }

        // Retrieve user data to validate current password
        $sql = "SELECT user_log_password FROM tbluser WHERE user_pk = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $user_pk);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) { // Changed to check if exactly one row is returned
                $row = $result->fetch_assoc();
                $storedPassword = $row['user_log_password'];

                // Verify if the current password matches the one stored in the database
                if ($currentPassword === $storedPassword) {
                    // Current password is valid, update the password
                    $updateSql = "UPDATE tbluser SET user_log_password = ? WHERE user_pk = ?";
                    $stmt_update = $conn->prepare($updateSql);
                    if ($stmt_update) {
                        $stmt_update->bind_param("si", $newPassword, $user_pk);
                        if ($stmt_update->execute()) {
                            echo '<script>window.alert("Password updated successfully."); window.location.href="../main.php";</script>';
                            exit;
                        } else {
                            echo '<script>window.alert("Error updating password.");</script>';
                            exit;
                        }
                        $stmt_update->close();
                    } else {
                        echo '<script>window.alert("Error preparing update statement."); window.location.href="../main.php";</script>';
                        exit;
                    }
                } else {
                    echo '<script>window.alert("Incorrect current password."); window.location.href="../main.php";</script>';
                    exit;
                }
            } else {
                echo '<script>window.alert("User not found."); window.location.href="../main.php";</script>';
                exit;
            }
            $stmt->close();
        } else {
            echo '<script>window.alert("Error preparing statement."); window.location.href="../main.php";</script>';
            exit;
        }
    } else {
        echo '<script>window.alert("Required fields are missing."); window.location.href="../main.php";</script>';
        exit;
    }
} else {
    echo "Update user data not received.";
    exit;
}

$conn->close();
?>
    
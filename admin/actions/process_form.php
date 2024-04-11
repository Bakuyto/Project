<?php
// Check if the form is submitted via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_input"])) {
    // Include your database connection script
    include '../../connection/connect.php';

    // Assuming your form fields are named after database columns
    // You can retrieve the values submitted in the form like this:
    $values = array();
    foreach ($_POST as $key => $value) {
        // Prevent SQL injection by using prepared statements
        $escaped_value = $conn->real_escape_string($value);
        
        // Set default value to '0' if the field is empty
        $values[$key] = !empty($escaped_value) ? $escaped_value : '0';
    }

    // Remove 'submit_input' from the array of values
    unset($values['submit_input']);

    // Now, you can process the submitted data, for example, inserting it into the database
    // Assuming 'tblproduct_transaction' is your table name
    $columns = implode(", ", array_keys($values));
    $columnValues = "'" . implode("', '", $values) . "'";

    $sql = "INSERT INTO tblproduct_transaction ($columns) VALUES ($columnValues)";
    if ($conn->query($sql) === TRUE) {
        // Insertion successful
        $response = "New record created successfully";
        echo json_encode($response); // Return success message as JSON
    } else {
        // Error occurred
        $response = "Error: " . $sql . "<br>" . $conn->error;
        echo json_encode($response); // Return error message as JSON
    }

    // Close the database connection
    $conn->close();
}
?>

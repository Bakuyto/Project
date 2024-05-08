<?php
// Include your database connection file
include '../../connection/connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected month and year from the form
    $selected_year_month = $_POST["year"];

    // Check if the input is empty
    if (empty($selected_year_month)) {
        // If input is empty, redirect to the same page
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        // Extract month and year from the selected value
        $selected_year = date('Y', strtotime($selected_year_month));
        $selected_month = date('m', strtotime($selected_year_month));
        
        // Prepare and execute your SQL query with the filtered year and month
        $sql = "CALL Load_Report_Data(?, ?)";
    }

    // Prepare SQL statement
    $stmt = $conn->prepare($sql);

    if (!empty($selected_year_month)) {
        // Bind parameters
        $stmt->bind_param("ss", $selected_month, $selected_year);
    }

    // Execute the stored procedure
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Check if result set is empty
    if ($result->num_rows === 0) {
         // Output a single cell with "No results found" message
         echo "<tr><td colspan='100' style='text-align: center; font-size: 18px; font-weight: bold;'>No results found.</td></tr>";
        exit();
    }

    // Initialize a counter for the ID
    $counter = 1;

    // Output the results directly into the table body
    while ($row = $result->fetch_assoc()) {
        // Start table row
        echo "<tr>";

        // Output the ID using the counter
        echo "<td>$counter</td>";
        $counter++; // Increment the counter

        // Loop through columns
        foreach ($row as $key => $value) {
            // Skip rendering specific columns
            if ($key == 'id' || $key == 'user_fk' || $key == 'product_fk' || $key == 'datetime') {
                continue;
            }
            // Output cell data
            echo "<td>$value</td>";
        }

        // End table row
        echo "</tr>";
    }
}
?>

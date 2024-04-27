<?php
// Include the database connection
include '../../connection/connect.php';

// Check if department_pk is received via POST
if(isset($_POST['department_pk'])) {
    // Initialize department_pk
    $department_pk = $_POST['department_pk'];

    // Prepare and execute SQL query to retrieve checked items for the specified department
    $sql_checked_items = "SELECT product_tran_name_str FROM tblproductadjustpermission WHERE department_fk = ?";
    $stmt_checked_items = $conn->prepare($sql_checked_items);
    
    if ($stmt_checked_items) {
        $stmt_checked_items->bind_param("i", $department_pk);
        $stmt_checked_items->execute();
        $result_checked_items = $stmt_checked_items->get_result();

        // Initialize an empty array to store the names of checked items
        $checked_items = array();

        // Fetch the names of checked items
        while ($row_checked_items = $result_checked_items->fetch_assoc()) {
            $checked_items[] = $row_checked_items['product_tran_name_str'];
        }

        // Close statement
        $stmt_checked_items->close();

        // Prepare and execute SQL query to retrieve all items
        $sql_all_items = "CALL Load_All_Transaction";
        $result_all_items = $conn->query($sql_all_items);

        if ($result_all_items && $result_all_items->num_rows > 0) {
            // Loop through all items
            while ($row_all_items = $result_all_items->fetch_assoc()) {
                $brand_name = $row_all_items["department_name"];
                $checked = in_array($brand_name, $checked_items) ? "checked" : ""; // Check if item is selected
                // Output each item with its corresponding checkbox
                echo "<div class='form-group mb-3 d-flex justify-content-between'>
                          <label>$brand_name</label>
                          <input class='form-check-input' type='checkbox' name='brands[]' value='$brand_name' $checked>
                      </div>";
            }
        } else {
            echo "<p>No results found</p>"; // Output if no results found
        }
    } else {
        echo "Error: Failed to prepare SQL statement for checked items.";
    }
} else {
    // If department PK is not received, send an error response
    echo "Error: Department PK not received.";
}

// Close the database connection
$conn->close();
?>

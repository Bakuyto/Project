<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reorder Table Columns</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        input {
            width: 50px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h2>Reorder Table Columns</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="border text-center text-white" scope="col" style="background-color: var(--blue); height:50px;">
                    Transaction
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                include '../connection/connect.php';
                $sql = "CALL Load_All_Transaction"; // SQL query to select data from the table
                $result = $conn->query($sql); // Execute the query
                if ($result && $result->num_rows > 0) {
                    $rowNumber = 0;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr data-row='$rowNumber'>";
                        $colNumber = 0;
                        foreach ($row as $columnName => $value) {
                            echo "<td class='d-flex justify-content-between border'>
                                    <span>$value</span>
                                    <input type='number' class='form-control column-order-input' 
                                           placeholder='Order' data-row='$rowNumber' data-col='$colNumber'>
                                  </td>";
                            $colNumber++;
                        }
                        echo "<td>
                                <button type='button' class='btn btn-danger delete-btn' 
                                    onclick='setTransactionToDelete(\"" . $row["department_name"] . "\")' 
                                    data-bs-toggle='modal' data-bs-target='#deleteModal'>
                                    <i class='fa-solid fa-trash-can text-light'></i>
                                </button>
                              </td>";
                        echo "</tr>";
                        $rowNumber++;
                    }
                } else {
                    echo "<tr><td colspan='1'>0 results</td></tr>"; // Output if no results found
                }
                $conn->close(); // Close the database connection
            ?>
        </tbody>
    </table>

    <button onclick="reorderColumns()">Reorder Columns</button>

    <script>
        function reorderColumns() {
            const table = document.querySelector('table tbody');
            const rows = Array.from(table.querySelectorAll('tr'));
            const numCols = rows[0].querySelectorAll('td').length - 1; // Excluding the delete button column

            // Create a new order array based on user inputs
            const orderArray = new Array(numCols);
            rows.forEach(row => {
                const inputs = row.querySelectorAll('.column-order-input');
                inputs.forEach(input => {
                    const colIndex = parseInt(input.dataset.col);
                    const newOrder = parseInt(input.value);
                    if (newOrder && newOrder > 0 && newOrder <= numCols) {
                        orderArray[newOrder - 1] = colIndex;
                    }
                });
            });

            if (orderArray.includes(undefined)) {
                alert('Please fill all the order inputs correctly.');
                return;
            }

            // Reorder each row's cells according to the new order
            rows.forEach(row => {
                const cells = Array.from(row.querySelectorAll('td:not(:last-child)')); // Excluding the delete button cell
                const newRow = document.createElement('tr');
                newRow.setAttribute('data-row', row.getAttribute('data-row'));
                orderArray.forEach(orderIndex => {
                    newRow.appendChild(cells[orderIndex].cloneNode(true));
                });
                // Append the delete button cell
                newRow.appendChild(row.querySelector('td:last-child').cloneNode(true));
                table.replaceChild(newRow, row);
            });
        }
    </script>
</body>
</html>

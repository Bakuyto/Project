<?php
session_start();

// Set a cookie named "loggedIn" with the value "false" and expiration time of 1 minutes
setcookie("loggedIn", "false", time() + 60, "/");

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
  // Redirect to the login page
  header("Location: ../common/login.php");
  exit(); // Ensure that script execution stops after the redirect
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report</title>
  <link rel="icon" href="assets/img/a.jpg">
  <!-- <link rel="stylesheet" href="assets/css/reports.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .btn:hover {
  transform: scaleY(1.1);
  transition: 1s;
}
* {
  margin: 0;
  padding: 0;
}

:root {
  --blue: #28ACE8;
  --white: #ffff;
  --grey: rgb(211, 211, 211);
}

.tbl-container {
  max-width: fit-content;
  max-height: fit-content;
  overflow: hidden;
}

.table-container.tbl-fixed {
  overflow-y: scroll;
  overflow-x: scroll;
}

table {
  min-width: max-content;
  border: 2px solid lightgrey;
}

table th {
  position: sticky;
  top: 0;
  background-color: var(--blue);
  padding-left: 10px;
  padding-right: 10px;
  height: 50px;
  z-index: 1;
}
th,td{
padding: 4px;
}

table thead tr th {
  text-align: center;
  outline: 2px solid lightgrey;
}

table tbody tr td {
  text-align: center;
  background-color: white;
  outline: 1px solid lightgrey;
}

table tbody tr td.sticky{
outline: 2px solid lightgrey;
}
/* Sticky Header Styles */
table thead th.sticky {
  position: sticky;
  top: 0;
  width: auto;
  z-index: 2;
}
table tbody tr td.sticky {
  position: sticky;
  z-index: 1;
}

table tbody tr td:focus{
font-weight: bolder;
background-color: var(--blue);
}
</style>
<body>
<div class="container-fluid m-0 p-0" style="height:100vh;">
  <?php include 'include/header.php'; ?>
  <div class="contianer-fluid" style="height:60px;">
    <div class="mx-5 months_year d-flex justify-content-between pt-2 pb-2">
    <form >
    <input class="form-control" type="search" id="searchInput" placeholder="Search by Name" aria-label="Search" style="width:260px">
    </form>
   
    <form id="month_year_search" method="post">
        <label for="year">Date: </label>
        <input type="month" id="year" name="year" style="height:38px;">
        <button class="btn ms-1 text-white fw-bolder" type="submit" style="background-color: #28ACE8;height:40px; margin-top:-5px;">search</button>
        <button id="export2excel" class="btn fw-bolder text-white" style="background-color: green;height:40px;margin-top:-5px;"><i class="fa-solid fa-file-export"></i> to <i class="fa-solid fa-file-excel"></i></button>
    </form>
    </div>
    <section>
        <div class="tables container-fluid px-5 py-2 tbl-container d-flex flex-column justify-content-start align-content-center" style="height: calc(100vh - 60px - 60px);">
            <div class="table-container tbl-fixed">
                <table class="table-striped table-condensed" style="width:auto !important;" id="myTable">
                    <thead>
                        <tr>
                            <th class="sticky">No</th>
                            <?php 
                            include '../connection/connect.php';

                            $sql = "CALL Load_Report_Data()";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Output data of each row
                                $row = $result->fetch_assoc();
                                foreach ($row as $column_name => $value) {
                                    // Skip rendering specific columns
                                    if ($column_name == 'user_fk' || $column_name == 'product_fk'||$column_name == 'datetime') {
                                        continue;
                                    }

                                    // Define background colors for specific columns
                                    $background_color = '';
                                    switch ($column_name) {
                                        case 'ETA':
                                        case 'RMA':
                                        $background_color = 'background-color: #92D050;';
                                        break;
                                        case 'Consignment_Stock':
                                        $background_color = 'background-color: red;';
                                        break;
                                        case 'Pre_Order':
                                        $background_color = 'background-color: #FFC000;';
                                        break;
                                        case 'Total':
                                        case 'Current_Stock':
                                        $background_color = 'background-color: #F79646;';
                                        break;
                                        case 'product_name';
                                        $background_color = 'background-color:#4BACC6;';
                                        break;
                                        default:
                                        $background_color = ''; // No specific background color
                                    }

                                    // Output the table header for each column
                                    echo "<th id='$column_name' name='$column_name' class='text-center' style='$background_color'>";
                                    switch ($column_name) {
                                        case 'ETA':
                                            echo "ETA";
                                            break;
                                        case 'product_name':
                                            echo "Product Name";
                                            break;
                                        case 'dateTime':
                                            echo "Date";
                                            break;
                                        case 'RMA':
                                            echo "RMA";
                                            break;
                                        case 'Consignment_Stock':
                                            echo "Consignment Stock";
                                            break;
                                        case 'Pre_Order':
                                            echo "Pre Order";
                                            break;
                                        case 'Total':
                                            echo "Total";
                                            break;
                                        case 'Current_Stock':
                                            echo "Current Stock";
                                            break;
                                        case 'Show_Room':
                                            echo "Show Room";
                                            break;
                                        default:
                                            // Output column name as is for other columns
                                            echo $column_name;
                                    }
                                    echo "</th>";
                                }
                            } else {
                                echo "<th colspan='8'>0 results</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tr id="sumRow">
                    </tr>
                    <tbody id="tableBody">
                    
                        <?php 
                        include '../connection/connect.php'; 

                        $sql = "CALL Load_Report_Data()";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Initialize a counter for the ID
                            $counter = 1;

                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";

                                // Output the ID using the counter
                                echo "<td class='sticky'>$counter</td>";
                                $counter++; // Increment the counter

                                // Loop for other columns
                                foreach ($row as $column_name => $value) {
                                    // Skip rendering specific columns
                                    if ($column_name == 'id' || $column_name == 'user_fk' || $column_name == 'product_fk' || $column_name == 'datetime') {
                                        continue;
                                    }
                                    // Output cell data
                                    echo "<td data-column='$column_name'>$value</td>";
                                }
                                echo "</tr>";
                            }
                        } else {
                            // No results message spanning all columns
                            echo "<tr id='noResultsRow' style='display: none;'><td colspan='8'>0 results</td></tr>";
                        }
                        ?>
                        
                    </tbody>
                    <tr id="noResultsRow" style="display: none;">
                        <td class="text-center" colspan="30"><h5 >0 results</h5></td>
                    </tr>
                </table>
                
            </div>
        </div>
    </section>

  </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="assets/js/table2excel.js"></script>

<script>
document.getElementById('export2excel').addEventListener('click', function () {
    var table = document.getElementById('myTable');
    var rowsToExport = table.querySelectorAll("tr:not(#noResultsRow)");
    var csvContent = "data:text/csv;charset=utf-8,";

    // Construct header row
    var headerRow = [];
    var headerCells = table.querySelectorAll("th");
    headerCells.forEach(function (headerCell) {
        headerRow.push('"' + headerCell.innerText.replace(/"/g, '""') + '"');
    });
    csvContent += headerRow.join(",");

    // Construct data rows
    rowsToExport.forEach(function (row) {
        var rowData = [];
        var cells = row.querySelectorAll("td");
        cells.forEach(function (cell) {
            rowData.push('"' + cell.innerText.replace(/"/g, '""') + '"');
        });
        csvContent += rowData.join(",") + "\n";
    });

    var encodedUri = encodeURI(csvContent);
    var link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "exported_data.csv");
    document.body.appendChild(link);

    link.click();

    document.body.removeChild(link);
});
</script>

<script>
    $(document).ready(function(){
        // Function to calculate column sums based on visible rows
        function calculateColumnSums(rows) {
            // Initialize an array to store column sums
            var columnSums = Array.from({ length: rows[0].getElementsByTagName("td").length }, () => 0);

            // Loop through each row
            for (var i = 0; i < rows.length; i++) {
                // Check if the row is visible
                if (rows[i].style.display !== "none") {
                    // Select all cells in the visible row
                    var cells = rows[i].getElementsByTagName("td");

                    // Loop through each cell, excluding specified columns
                    for (var j = 0; j < cells.length; j++) {
                        // Exclude columns by index (0 for No, 1 for product_name, 2 for dateTime)
                        if (j !== 0 && j !== 1 && j !== 2) {
                            // Parse the cell value as a number
                            var cellValue = parseFloat(cells[j].textContent.trim());

                            // If the cell contains a valid number, add it to the corresponding column sum
                            if (!isNaN(cellValue)) {
                                columnSums[j] += cellValue;
                            }
                        }
                    }
                }
            }

            // Select the footer row for displaying sums
            var footerRow = document.getElementById("sumRow");

            if (!footerRow) {
                return;
            }

            // Clear previous content
            footerRow.innerHTML = "";

            // Create and append cells for column sums
            for (var k = 0; k < columnSums.length; k++) {
                var cell = document.createElement("td");
                // Display static values for the first three indexes
                if (k === 0) {
                    cell.textContent = "Total";
                    cell.classList.add("text-danger","fw-bolder");
                } else if (k === 1) {
                    cell.textContent = "Name";
                    cell.classList.add("text-danger","fw-bolder");
                } else if (k === 2) {
                    cell.textContent = "( YYY/MMM/DDD )";
                    cell.classList.add("text-danger","fw-bolder");
                } else {
                    // Display sum for non-excluded columns
                    cell.textContent = columnSums[k];
                    cell.classList.add("text-danger","fw-bolder");
                }
                footerRow.appendChild(cell);
            }
        }

        function performSearch(searchText) {
    try {
        var noResultsFound = true; // Flag to check if no results found
        $('#tableBody tr').each(function(){
            var productName = $(this).find('td[data-column="product_name"]').text().toLowerCase();
            // Check if product name contains the search text
            if (productName.indexOf(searchText) > -1) {
                $(this).show(); // Show table row
                noResultsFound = false; // Set flag to false if results found
            } else {
                $(this).hide(); // Hide table row if no match
            }
        });

        // Update sum data after search
        calculateColumnSums($('#tableBody tr:visible'));
        
        // Show or hide "No results found" row based on search results
        if (noResultsFound) {
            $('#noResultsRow').show();
        } else {
            $('#noResultsRow').hide();
        }
    } catch (error) {
        $('#noResultsRow').show(); // Display "No results found" message for errors
    }
    // Freeze columns
    $(document).freezeColumns();
}

        // Add event listener to Enter key pressed anywhere in the document
        $(document).on('keydown', function(event){
            if (event.keyCode === 13) { // Check if Enter key is pressed
                if ($('#searchInput').is(':focus')) { // Check if search input is focused

                    performSearch($('#searchInput').val().toLowerCase());
                } else {
                    $('#searchInput').focus(); // If not focused, focus on the search input
                }
                return false; // Prevent default behavior of Enter key
            }
            
        });

        // Call calculateColumnSums function after the table data is loaded
        calculateColumnSums($('#tableBody tr'));

// Attach submit event listener to search form
$('#month_year_search').on('submit', function(event) {
    try {
        event.preventDefault(); // Prevent form submission
        const yearMonth = $(this).find('input[name="year"]').val();

        // If the input field is empty, show all rows
        if (!yearMonth) {
            showAllRows();
            return;
        }

        const selectedDate = new Date(yearMonth);
        const selectedMonth = selectedDate.getMonth() + 1; // Month is 0-indexed, so add 1
        const selectedYear = selectedDate.getFullYear();

        // Filter table rows based on selected month and year
        let foundMatch = false;
        const rows = $('#tableBody tr');
        rows.each(function() {
            const cells = $(this).find('td');
            if (cells.length > 0) {
                const dateCell = cells.eq(2); // Assuming the third cell contains the date
                const date = new Date(dateCell.text());
                const month = date.getMonth() + 1;
                const year = date.getFullYear();

                if (month === selectedMonth && year === selectedYear) {
                    $(this).show(); // Show row
                    foundMatch = true;
                } else {
                    $(this).hide(); // Hide row
                }
            }
        });

        // Update sum data after filter
        calculateColumnSums($('#tableBody tr:visible'));

        // Show or hide "No results found" message
        if (foundMatch) {
            $('#noResultsRow').hide();
        } else {
            $('#noResultsRow').show();
        }
    } catch (error) {
        $('#noResultsRow').show(); // Display "No results found" message for errors
    }
    // Freeze columns
    $(document).freezeColumns();
});
        // Function to show all rows
        function showAllRows() {
            $('#tableBody tr').show(); // Show all table rows

            // Update sum data
            calculateColumnSums($('#tableBody tr'));
            
            $('#noResultsRow').hide(); // Hide "No results found" message
        }
    });
</script>

<script>
    $(document).ready(function () {
        // Function to freeze columns
        $.fn.freezeColumns = function () {
            var freezePos = 0;
            var totalColumnName = 'January'; // Name of the column to freeze at
            $('thead th').each(function (index, val) {
                var $self = $(this);
                var curWidth = $self.outerWidth();
                if ($self.text().trim() === totalColumnName) {
                    return false; // Exit loop after the 'Total' column
                }
                $('th:nth-child(' + parseInt(index + 1) + '), td:nth-child(' + parseInt(index + 1) + ')').addClass('sticky').css('left', freezePos);
                freezePos += curWidth;
            });
        };

        // Freeze columns
        $(document).freezeColumns();

        // Synchronize horizontal scrolling of thead with tbody
        $('.table-container').on('scroll', function () {
            var scrollLeft = $(this).scrollLeft();
            $('.sticky-thead').css('left', -scrollLeft);
        });
    });
</script>

</html>
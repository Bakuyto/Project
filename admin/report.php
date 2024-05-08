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
  <link rel="stylesheet" href="assets/css/reports.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<div class="container-fluid m-0 p-0" style="height:100vh;">
  <?php include 'include/header.php'; ?>
  <div class="contianer-fluid" style="height:60px;">
    <div class="mx-5 months_year d-flex justify-content-between pt-2 pb-2">
    <form >
    <input class="form-control" type="search" id="searchInput" placeholder="Search by Product Name" aria-label="Search" style="width:260px">
    </form>
    <form id="filterForm" method="post" action="filter.php">
        <label for="year">Date Selection: </label>
        <input type="month" id="year" name="year" style="height:38px;">
        <button class="btn ms-1 text-white fw-bolder" type="submit" style="background-color: #28ACE8;height:40px; margin-top:-5px;">Filter</button>
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

                            $sql = "CALL Load_Report_Data(Null,Null)";
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
                        <td class="text-danger fw-bolder">Total: </td> <!-- Label cell for 'No' column -->
                        <!-- Empty cells for other columns where sums will be displayed -->
                        <?php
                        foreach ($row as $column_name => $value) {
                            // Skip rendering specific columns
                            if ($column_name == 'user_fk' || $column_name == 'product_fk'||$column_name == 'datetime') {
                                continue;
                            }
                            // Output empty cell for sum display
                            echo "<td class='text-danger fw-bolder' id='{$column_name}_sum'></td>";
                        }
                        ?>
                    </tr>
                    <tbody id="tableBody">
                        <?php 
                        include '../connection/connect.php'; 

                        $sql = "CALL Load_Report_Data(null,null)";
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
                            echo "<tr><td colspan='8'>0 results</td></tr>";
                        }
                        ?>
                        <tr id="noResultsRow" style="display: none;">
                        <td colspan="100">No results found</td> <!-- Adjust colspan based on the number of columns -->
                    </tr>
                    </tbody>
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

<script>
    $(document).ready(function(){
        // Add event listener to search input
        $('#searchInput').on('input', function(){
            var searchText = $(this).val().toLowerCase(); // Get search input value
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
            // Show or hide "No results found" row based on search results
            if (noResultsFound) {
                $('#noResultsRow').show();
            } else {
                $('#noResultsRow').hide();
            }
        });
    });
</script>

<script>
    // Add event listener to form submission
    document.getElementById("filterForm").addEventListener("submit", function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Get the value of the year input
        var yearInput = document.getElementById("year").value;

        // Check if the year input is empty
        if (yearInput.trim() === '') {
            // Refresh the page
            window.location.reload();
            return;
        }

        // If input is not empty, proceed with AJAX request
        // Get form data
        var formData = new FormData(this);

        // Send form data via AJAX
        fetch('actions/filter.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Update table body with filtered results
                    document.getElementById("tableBody").innerHTML = data;

                // Reapply column freezing after updating table body
                $(document).freezeColumns();
            })
            .catch(error => {
                console.error('Error:', error);
            });
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

<script>
$(document).ready(() => {
    const calculateSums = () => {
        const sums = {};

        // Initialize sums object
        $("#myTable th:not(:first)").each((index, element) => {
            const columnName = $(element).attr('id');
            sums[columnName] = 0;
        });

        // Calculate sums for visible rows
        $("#myTable tbody tr:visible").each((index, row) => {
            $(row).find("td").each((index, cell) => {
                const columnName = $(cell).attr('data-column');
                
                // Skip summing up values for "dateTime" column
                if (columnName === 'datetime') {
                    return true; // Skip to the next iteration
                }
                
                const cellValue = parseFloat($(cell).text().trim()) || 0;
                sums[columnName] += cellValue;
            });
        });

        // Update total row cells with sum values
        $.each(sums, (columnName, total) => {
            $(`#${columnName}_sum`).text(total);
        });

        // Set the sum for the "dateTime" column to 0
        $('#product_name_sum').text(' Product Name ');

        // Set the sum for the "dateTime" column to 0
        $('#dateTime_sum').text('( YYY/MMM/DDD )');
    };

    // Call calculateSums after the document is ready
    calculateSums();

    // Trigger sum calculation after table is filtered
    $('#myTable').on('search.dt', () => {
        calculateSums();
    });
});
</script>

</html>
<?php
session_start();

// Set a cookie named "loggedIn" with the value "false" and expiration time of 1 minutes
setcookie("loggedIn", "false", time() + 60, "/");

// Check if the user is not logged in
if (!isset($_SESSION['user_log_name'])) {
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
    <div class="filter-form d-flex">
        <form id="searchForm">
        <input class="form-control me-1" type="search" id="searchInput" placeholder="Search by Name" aria-label="Search" style="width:160px">
        </form>
        <select id="select-filter" class="form-select" style="height:38.1px;">
        <option class="text-dark" value="" selected disabled>Select Type</option>
        <?php 
                            include '../connection/connect.php';
                            $sql = "Select * from tblproduct_type"; // SQL query to select data from the table
                            $result = $conn->query($sql); // Execute the query
            
                            if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                  $product_name = $row['product_type_name'];
                                  $product_id = $row['product_type_pk'];
                          ?>
                                  <option id="<?php echo $product_id; ?>" value="<?php echo $product_id; ?>"><?php echo $product_name; ?> </option>
                          <?php
                              }
                          } else {
                              echo "<option value='' selected>No departments found</option>"; // Output if no results found
                          }
                            $conn->close(); // Close the database connection
                          ?>
                          <option value="all">All</option> <!-- New option for selecting all values -->
        </select>
    </div>
   
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
                                    if ($column_name == 'user_fk' ||$column_name == 'product_type_fk' || $column_name == 'product_fk'||$column_name == 'datetime') {
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
                                            echo "Date <br> Time";
                                            break;
                                        case 'RMA':
                                            echo "RMA";
                                            break;
                                        case 'Consignment_Stock':
                                            echo "Consignment <br> Stock";
                                            break;
                                        case 'STOCK_AVAILABLE':
                                            echo "STOCK <br> AVAILABLE";
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
                                    if ($column_name == 'id' || $column_name == 'user_fk' || $column_name == 'product_type_fk' || $column_name == 'product_fk' || $column_name == 'datetime') {
                                        continue;
                                    }
                                    // Output cell data
                                    echo "<td data-column='$column_name' data-product-type='".$row['product_type_fk']."'>$value</td>";
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
        $(document).ready(function(){
            // Function to filter the table
            function filterTable() {
                var selectedProductType = $('#select-filter').val();
                var yearMonth = $('input[name="year"]').val();
                var selectedDate = new Date(yearMonth);
                var selectedMonth = selectedDate.getMonth() + 1;
                var selectedYear = selectedDate.getFullYear();
                var searchText = $('#searchInput').val().toLowerCase();
                var hasVisibleRow = false;

                $('#tableBody tr').each(function() {
                    var productType = $(this).find('td[data-product-type]').attr('data-product-type');
                    var dateCell = $(this).find('td:eq(3)').text();
                    var date = new Date(dateCell);
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    var productName = $(this).find('td:eq(1)').text().toLowerCase();

                    if ((selectedProductType === "all" || selectedProductType === productType) &&
                        (!yearMonth || (month === selectedMonth && year === selectedYear)) &&
                        (productName.indexOf(searchText) > -1)) {
                        $(this).show();
                        hasVisibleRow = true;
                    } else {
                        $(this).hide();
                    }
                });

                if (hasVisibleRow) {
                    $('#noResultsRow').hide();
                } else {
                    $('#noResultsRow').show();
                }

                calculateColumnSums($('#tableBody tr:visible'));
                updateFrozenColumns(); // Update freezing columns after filtering
            }

            // Function to calculate column sums based on visible rows
            function calculateColumnSums(rows) {
                var columnSums = Array.from({ length: rows[0].getElementsByTagName("td").length }, () => 0);

                for (var i = 0; i < rows.length; i++) {
                    if (rows[i].style.display !== "none") {
                        var cells = rows[i].getElementsByTagName("td");
                        for (var j = 0; j < cells.length; j++) {
                            if (j !== 0 && j !== 1 && j !== 2 && j !== 3) {
                                var cellValue = parseFloat(cells[j].textContent.trim());
                                if (!isNaN(cellValue)) {
                                    columnSums[j] += cellValue;
                                }
                            }
                        }
                    }
                }

                var footerRow = document.getElementById("sumRow");
                if (!footerRow) {
                    return;
                }

                footerRow.innerHTML = "";
                for (var k = 0; k < columnSums.length; k++) {
                    var cell = document.createElement("td");
                    if (k === 0) {
                        cell.textContent = "Total";
                        cell.classList.add("text-danger", "fw-bolder");
                    } else if (k === 1) {
                        cell.textContent = "Product Name";
                        cell.classList.add("text-danger", "fw-bolder");
                    } else if (k === 2) {
                        cell.textContent = "PK+CI";
                        cell.classList.add("text-danger", "fw-bolder");
                    } else if (k === 3) {
                        cell.textContent = "( YYYY/MM/DD )";
                        cell.classList.add("text-danger", "fw-bolder");
                    } else {
                        cell.textContent = columnSums[k];
                        cell.classList.add("text-danger", "fw-bolder");
                    }
                    footerRow.appendChild(cell);
                }
            }

            // Freeze columns function
            $.fn.freezeColumns = function () {
                var freezePos = 0;
                var totalColumnName = 'January'; // Adjust as per your column name logic
                $('thead th').each(function (index, val) {
                    var $self = $(this);
                    var curWidth = $self.outerWidth();
                    if ($self.text().trim() === totalColumnName) {
                        return false; // Exit loop if it reaches the total column, adjust this condition as per your header structure
                    }
                    $('th:nth-child(' + parseInt(index + 1) + '), td:nth-child(' + parseInt(index + 1) + ')').addClass('sticky').css('left', freezePos);
                    freezePos += curWidth;
                });
            };

            // Function to update frozen columns after table filter
            function updateFrozenColumns() {
                $('.sticky-thead').css('left', 0); // Reset position
                $(document).freezeColumns(); // Recalculate freezing positions
            }

            // Initial filter on page load
            $('#select-filter').val("all");
            filterTable();

            // Event listeners for filtering
            $('#select-filter').change(filterTable);
            $('#month_year_search').submit(function(event) {
                event.preventDefault();
                filterTable();
            });
            $('#searchInput').on('input', filterTable);

            // Export to CSV function
            $('#export2excel').click(function () {
                var table = $('#myTable');
                var rowsToExport = $('#tableBody tr:visible');
                var csvContent = "data:text/csv;charset=utf-8,";
                var headerRow = [];

                table.find("th").each(function () {
                    headerRow.push('"' + $(this).text().replace(/"/g, '""') + '"');
                });
                csvContent += headerRow.join(",") + "\n";

                rowsToExport.each(function() {
                    var rowData = [];
                    $(this).find("td").each(function() {
                        rowData.push('"' + $(this).text().replace(/"/g, '""') + '"');
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

            // Call freezeColumns on document ready
            $(document).freezeColumns();

            // Call freezeColumns on scroll event
            $('.table-container').on('scroll', function () {
                var scrollLeft = $(this).scrollLeft();
                $('.sticky-thead').css('left', -scrollLeft);
            });

            // Initial column sum calculation
            calculateColumnSums($('#tableBody tr'));
            $(document).freezeColumns();
        });
    </script>

</html>
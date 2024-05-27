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
<!DOCTYPE html >
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Page</title>
  <link rel="icon" href="assets/img/a.jpg">
  <link rel="stylesheet" href="assets/css/Homepage.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container-fluid p-0 m-0" style="height:100vh;">
  <?php include 'include/header.php'; ?>
  <div class="container-fluid px-5 main-header d-flex justify-content-between py-2" style="height:60px;">
    
    <div class="filter-form d-flex">
        <form id="searchForm">
        <input class="form-control me-1" type="search" id="searchInput" placeholder="Search by Name" aria-label="Search" style="width:160px">
        </form>
            <select id="select-filter" class="form-select" style="height:38.1px;">
            <option class="text-dark" value="" selected disabled>Select Type</option>
            <?php 
                include '../connection/connect.php';
                $sql = "SELECT * FROM tblproduct_type"; // SQL query to select data from the table
                $result = $conn->query($sql); // Execute the query

                if ($result->num_rows > 0) {
                    // Fetch and display each row
                    while ($row = $result->fetch_assoc()) {
                        $product_name = htmlspecialchars($row['product_type_name']); // Escape for safety
                        $product_id = htmlspecialchars($row['product_type_pk']); // Escape for safety
                        echo "<option id='$product_id' value='$product_id'>$product_name</option>";
                    }
                } else {
                    // If no results found, display a message
                    echo "<option value='' disabled>No departments found</option>";
                }
                // Close the database connection
                $conn->close();
            ?>
            <option value="all">All</option> <!-- New option for selecting all values -->
        </select>

    </div>
    <div class="form-inline d-flex flex-row gap-1">
      <button type="button" id="saveChangesBtn" class="btn btn-danger"  style="height:40px;">Generate</button>
      <input type="number" id="row" style="width:80px; height: 40px;" class="form-control" />
      <button type="button" class="btn btn-success" style="height:40px" id="filter">Filter</button>
      <button type="button" class="btn text-white" style="height:40px;background-color: #28ACE8;" onclick="$('#addModal').modal('show')">Create</button>
      <button id="export2excel" class="btn fw-bolder text-white" style="background-color: green;height:40px;"><i class="fa-solid fa-file-export"></i> to <i class="fa-solid fa-file-excel"></i></button>
    </div>
  </div>
  <div class="fill" style="height: calc(100vh - 60px - 60px);">
  <section>
  <div class="tables container-fluid px-5 tbl-container d-flex flex-column justify-content-center align-content-center">
    <div class="table-container tbl-fixed">
      <!-- Main table -->
      <table class="table-striped table-condensed" style="width:auto !important;" id="myTable">
        <thead class="new-thead sticky-thead">
          <?php
          include '../connection/connect.php';
          $sql = "CALL update_table_column('',null)";
          $result = $conn->query($sql);

          if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Fetching only the first row
            echo "<tr>"; // Add opening <tr> tag here
            echo "<th class='text-center sticky'>No</th>";
            foreach ($row as $column_name => $value) {
              // Skip rendering specific columns
              if ($column_name == 'product_pk' ||$column_name == 'product_type_fk' || $column_name == 'product_status' || $column_name == 'product_fk') {
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
              echo "<th id='$column_name' name='$column_name' class='text-center' style='$background_color'";
              echo "<div class='sticky-background'>"; // Open div for sticky background
              // Special treatment for specific columns
              switch ($column_name) {
                case 'ETA':
                  echo "ETA";
                  break;
                case 'product_name':
                  echo "Product Name <br>";
                  break;
                case 'PK_CI':
                  echo "PK+CI";
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
                  echo "Current <br> Stock";
                  break;
                default:
                  // Output column name as is for other columns
                  echo $column_name;
              }
              echo "</div>"; // Close div for sticky background
              echo "</th>";
            }
            echo "</tr>"; // Add closing </tr> tag here
          }
          ?>
        </thead>
        
        <tbody id="tableBody">
          <div id="sumRow"></div>
        </tbody>      
      </table>
    </div>
  </div>
</section>
  </div>
</div>

           
<?php include 'include/footer.php' ?>
<!-- Create Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h2 class="modal-title" id="addModalLabel">Create</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="POST">
                  <div class="create-body row" style="display: flex; flex-wrap: nowrap; overflow-x: auto;">
                    <div class="select-part" style="width:200px">
                    <label class="w-100 pb-2 text-center fw-bolder">Product Type</label>
                    <div class="form-group d-flex">
                    <select id="productTypeSelect" class="form-select" style="border-radius:5px 0px 0px 5px;" required>
                        <option class="text-dark" value="" selected disabled>Select Type</option>

                        <?php 
                            include '../connection/connect.php';
                            $sql = "SELECT * FROM tblproduct_type"; // SQL query to select data from the table
                            $result = $conn->query($sql); // Execute the query

                            $product_id = ''; // Define product_id variable

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $product_name = $row['product_type_name'];
                                    $product_id = $row['product_type_pk'];
                                    echo "<option id='$product_id' value='$product_id'>$product_name</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No departments found</option>"; // Output if no results found
                            }
                            $conn->close(); // Close the database connection
                        ?>
                    </select>

                    <input type="hidden" id="product_type_fk" name="product_type_fk" value="<?php echo $product_id; ?>">
                    <button type="button" class="btn" style="border-radius:0px 5px 5px 0px; border:1px solid lightgrey" onclick="$('#createtypeModal').modal('show')">+</button>
                    </div>
                    </div>
                    <div class="input-part d-flex">
                    <?php
                        include '../connection/connect.php';

                        $sql = "SELECT
                            COLUMN_NAME AS department_name
                            FROM INFORMATION_SCHEMA.COLUMNS
                            WHERE TABLE_NAME = 'tblproduct_transaction'
                            AND COLUMN_NAME NOT IN ('product_status', 'product_type_fk')
                            AND ORDINAL_POSITION >= 2;";
                        $result = $conn->query($sql); // Execute the query

                        if ($result && $result->num_rows > 0) {
                            // Fetch column names from the database
                            $first = true; // Flag to track the first column
                            while ($row = $result->fetch_assoc()) {
                                $department_name = $row["department_name"];

                                // Rename the department names if they match the specified ones
                                switch ($department_name) {
                                    case 'product_name':
                                        $label = 'Product Name';
                                        $input_type = 'text'; // Change input type to text for 'product_name'
                                        break;
                                    case 'Consignment_Stock':
                                        $label = 'Consignment Stock';
                                        $input_type = 'number';
                                        break;
                                    case 'PK_CI':
                                        $label = 'PK+CI';
                                        $input_type = 'text'; // Change input type to text for 'PK_CI'
                                        break;
                                    case 'Pre_Order':
                                        $label = 'Pre Order';
                                        $input_type = 'number';
                                        break;
                                    default:
                                        $label = $department_name;
                                        $input_type = 'number';
                                }
                        ?>
                                <div class="col-12 mb-3 me-4" style="width: 200px; margin-left:-15px;">
                                    <label class="form-label text-center fw-bolder w-100"><?= $label ?></label>
                                    <input type="<?= $input_type ?>" class="form-control<?= $first && $department_name === 'product_name' ? ' required' : '' ?>" id="<?= $department_name ?>" name="<?= $department_name ?>"<?= $first && $department_name === 'product_name' ? ' required' : '' ?>>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>No results found</p>"; // Output if no results found
                        }
                        ?>

                    </div>
                  </div>
                  <div class="d-flex justify-content-end mt-3">
                        <!-- <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>   

<!-- Create Type Modal -->
<div class="modal fade" id="createtypeModal" tabindex="-1" aria-labelledby="createtypeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createtypeModalLabel">Create Product Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="create_type" method="post">
        <div class="mb-3">
            <label for="inputName" class="form-label">Type Name:</label>
            <input type="text" class="form-control" name="typeName" id="typeName" placeholder="Enter name" required>
          </div>
          <div class="d-flex justify-content-end mt-3">
        <button type="submit" id="createButton" class="btn btn-primary">Create</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Create Success Modal -->
<div class="modal fade" id="successsModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-success" >
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fw-bolder" style="border:none;">
              <p class="h6 fw-bolder" id="errorrMessage">Form submitted successfully.</p>
            </div>
        </div>
    </div>
</div>

<!-- Create Error Modal -->
<div class="modal fade" id="errorrModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="errorModalLabel">Error</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body" style="border:none;">
        <p class="h6 fw-bolder" id="errorrMessage">Product name is required</p>
      </div>
    </div>
  </div>
</div>

<!-- Insert Modal For ALL Department Is Equal 1 -->
<div class="modal fade" id="InsertModal" tabindex="-1" role="dialog" aria-labelledby="InsertModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="InsertModalForm" method="POST">
      <div class="modal-header text-white" style="background-color: #28ACE8;">
        <h5 class="modal-title" id="InsertModalLabel">Generate</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        Please Enter Your Password To Insert Data:
        <input type="hidden" name="user_pk" value="<?php echo isset($_SESSION['user_pk']) ? $_SESSION['user_pk'] : ''; ?>"> <!-- Hidden field to send user primary key -->
        <div class="password-container">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          <i id="togglePasswordInsert" class="show-password fa-regular fa-eye-slash"></i> <!-- Unique ID for the eye icon -->
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="Insert_data" class="btn text-white" style="background-color: #28ACE8;">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Insert Error Modal For Departments or One of the Departments is still Equal 0 or All of the departments Equal 0 -->
<div class="modal fade" id="InserterrorModal" tabindex="-1" role="dialog" aria-labelledby="InserterrorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="saveanywayForm" method="POST">
        <div class="modal-header text-white bg-warning" style="background-color: #28ACE8;">
          <h5 class="modal-title" id="InsertModalLabel">!!! Warning !!!</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <p id="InserterrorMessage"></p>
          Please Enter Your Password To Insert Data:
          <input type="hidden" name="user_pk" value="<?php echo isset($_SESSION['user_pk']) ? $_SESSION['user_pk'] : ''; ?>"> <!-- Hidden field to send user primary key -->
          <div class="password-container">
            <input type="password" name="password" id="passwordError" class="form-control" placeholder="Password" required> <!-- Unique ID for the password input field -->
            <i id="togglePasswordError" class="show-password fa-regular fa-eye-slash"></i> <!-- Unique ID for the eye icon -->
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="saveanyway" value="true"> 
          <button type="submit" name="saveanyway" class="btn text-white bg-warning">Save Anyway</button>
        </div>
        </form>
      </div>
    </div>
</div>

<!-- ErrorSaveAnyway Success Modal -->
<div class="modal fade" id="saveanywaysuccessModal" tabindex="-1" role="dialog" aria-labelledby="saveanywaysuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-white bg-success">
          <h5 class="modal-title" id="saveanywaysuccessModalLabel">Success</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          Data inserted successfully
        </div>
      </div>
    </div>
</div>

<!-- ErrorSaveAnyway Error Modal -->
<div class="modal fade" id="saveanywayerrorModal" tabindex="-1" role="dialog" aria-labelledby="saveanywayerrorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-danger" style="background-color: #28ACE8;">
                <h5 class="modal-title" id="saveanywayerrorModalLabel">Error</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="saveanywayErrorMessage"></p>
            </div>
        </div>
    </div>
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="assets/js/colResizable.js" ></script>
<script src="assets/js/colResizable.min.js" ></script>


<!-- live Edit and UpdateTable -->
<script>
$(document).ready(function() {
    var currentPage = 1; // Current page
    var rowsPerPage = 30; // Number of rows per page
    var totalRecords; // Total number of records
    var data; // Variable to hold the fetched data
    var searchText = ''; // Global variable to store search text
    var productType;

    // Event listener for Export to Excel button click
    $("#export2excel").on("click", function () {
        var visibleRows = $("tbody tr:visible"); // Select only visible rows after filtering and pagination
        var csvContent = "data:text/csv;charset=utf-8,";

        // Construct header row
        var headerRow = [];
        $("#myTable th").each(function () {
            headerRow.push('"' + $(this).text().replace(/"/g, '""') + '"');
        });
        csvContent += headerRow.join(",") + "\n";

        // Construct data rows
        visibleRows.each(function () {
            var rowData = [];
            $(this).find("td").each(function () {
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

    $(document).on("keydown", "tbody td.editable", function(event) {
    // Cache frequently used elements
    var cell = $(this);
    var tableRows = $("tbody tr");
    var numCols = tableRows.eq(0).find("td").length;

    // Get current cell index and text length
    var columnIndex = cell.index();
    var rowIndex = cell.closest("tr").index();
    var textLength = cell.text().length;

    // Function to focus on a cell and set selection range
    function focusCell(row, col) {
        var targetCell = tableRows.eq(row).find("td").eq(col);
        targetCell.focus().get(0).setSelectionRange(textLength, textLength);
    }

    // Handle arrow key events
    switch (event.key) {
        case "ArrowLeft":
            if (columnIndex > 0) {
                focusCell(rowIndex, columnIndex - 1);
            }
            break;
        case "ArrowUp":
            if (rowIndex > 0) {
                focusCell(rowIndex - 1, columnIndex);
            }
            break;
        case "ArrowRight":
            if (columnIndex < numCols - 1) {
                focusCell(rowIndex, columnIndex + 1);
            }
            break;
        case "ArrowDown":
            var numRows = tableRows.length;
            if (rowIndex < numRows - 1) {
                focusCell(rowIndex + 1, columnIndex);
            }
            break;
    }
});

    // Input validation for numeric columns
    $(document).on("input", "tbody td.editable", function(event) {
    var column = $(this).attr("data-column");
    var value = $(this).text().trim();
    
    console.log("Column:", column, "Value:", value); // Add this line for debugging

    if (column !== "product_name" && column !== "PK_CI" && !(/^\d*\.?\d*$/.test(value))) {
        $(this).text("0");
    }
    });


    // Event listener for Enter key press in search input
    $("#searchInput").on("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            searchText = $(this).val().trim(); // Update global search text
            currentPage = 1; // Reset page to 1 when searching
            fetchData(); // Fetch data based on search text and product type
        }
    });

    $("#select-filter").on("change", function() {
    console.log("Selected value:", $(this).val()); // Log selected value
    if ($(this).val() === "all") {
        console.log("Setting productType to null"); // Log when setting to null
        productType = null;
    } else {
        productType = parseInt($(this).val());
    }
    console.log("productType:", productType); // Log productType
    fetchData(); // Fetch data based on search text and product type
});


     // Function to fetch data based on search text, product type, and pagination
    function fetchData() {
        var offset = (currentPage - 1) * rowsPerPage;
        $.ajax({
            url: "actions/fetch_data.php",
            type: "GET",
            data: {
                offset: offset,
                limit: rowsPerPage,
                search: searchText, // Include search text parameter
                product_type: productType // Include product type parameter
            },
            dataType: "json",
            success: function(response) {
                data = response.data;
                totalRecords = response.totalRecords;
                updateTable(data);
                updatePagination();
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    }

    // Update the table content with the fetched data
    function updateTable(data) {
        $('tbody').empty(); // Clear existing table rows

        // Calculate totals for each column
        var columnTotals = {};
        $.each(data, function(index, row) {
            $.each(row, function(column_name, value) {
                if (column_name !== 'product_pk' && column_name !== 'product_type_fk' && column_name !== 'product_status' && column_name !== 'product_fk') {
                    // Handle NaN for product name column
                    if (column_name === 'Product Name' && value === null) {
                        value = ''; // Set value to empty string for product name column
                    }
                    columnTotals[column_name] = (columnTotals[column_name] || 0) + parseFloat(value);
                }
            });
        });

        // Add total row to the top of tbody
        var totalRow = $("<tr>");
        totalRow.append("<td class='text-center text-danger fw-bolder'>Total</td>");
        $.each(columnTotals, function(column_name, total) {
            if (column_name === 'product_name') {
                totalRow.append("<td><span name='" + column_name + "_sum' id='" + column_name + "_sum' class='text-center text-danger fw-bolder'>Name</span></td>");
            } else if(column_name === 'PK_CI') {
                totalRow.append("<td><span name='" + column_name + "_sum' id='" + column_name + "_sum' class='text-center text-danger fw-bolder'>PK+CI</span></td>");
            }
            else {
                totalRow.append("<td><span name='" + column_name + "_sum' id='" + column_name + "_sum' class='text-center text-danger fw-bolder'>" + total + "</span></td>");
            }
        });
        $('tbody').append(totalRow);

        if (data.length === 0) {
            // If no results found, display message in a single cell row
            var tr = $("<tr>").appendTo("tbody");
            $("<td colspan='100'>").text("No results found").appendTo(tr);
            return;
        }

        var startIndex = (currentPage - 1) * rowsPerPage;
        var endIndex = startIndex + rowsPerPage;
        var paginatedData = data.slice(startIndex, endIndex);

        // Calculate the starting loop ID for the current page
        var startingLoopId = (currentPage - 1) * rowsPerPage + 1;

        $.each(paginatedData, function(index, row) {
            var tr = $("<tr>").attr("id", "row_" + row.product_pk);

            // Add a loop ID column
            var loopIdTd = $("<td>").text(startingLoopId + index);
            tr.append(loopIdTd);

            $.each(row, function(column_name, value) {
                  if (column_name !== 'product_pk' && column_name !== 'product_type_fk' && column_name !== 'product_status' && column_name !== 'product_fk') {
                    if (column_name === 'product_name' && column_name === 'PK_CI' && value === null) {
                        value = '';
                    }
                    var td = $("<td>").attr({
                        "id": column_name,
                        "data-column": column_name,
                        "type": "number"
                    }).text(value);
                    
                    // Check if column_name is 'Current Stock' or 'Total'
                    if (column_name !== 'Current_Stock' && column_name !== 'Total') {
                        td.addClass("editable");
                        td.attr("contenteditable", "true");
                    }

                    tr.append(td);
                }
            });

            $('tbody').append(tr);
        });
        $(document).freezeColumns();
    }

    // Function to update pagination controls
    function updatePagination() {
        var totalPages = Math.ceil(totalRecords / rowsPerPage);
        $("#current-page").text(currentPage);
        $("#total-pages").text(totalPages);
        $("#page-number").val(currentPage); // Update input field value
    }


    function updateValue(cell, newValue, oldValue) {
    var column = cell.attr("data-column");

    // If column is not product_name or PK_CI, validate if newValue is numeric
    if (column !== "product_name" && column !== "PK_CI" && isNaN(newValue)) {
        alert("Please enter a valid numeric value.");
        cell.text(oldValue); // Revert the cell text to the original value
        return;
    }

    var productId = cell.closest("tr").attr("id").split("_")[1]; // Extract product ID

    // Send AJAX request to update the value
    $.ajax({
        url: "actions/update.php",
        type: "POST",
        data: {
            id: productId,
            column: column,
            newValue: newValue
        },
        dataType: "json",

        success: function(response) {
            if (response.success) {
                cell.text(newValue); // Update the cell text with the new value
                // Retrieve the search input value
                var searchText = $("#searchInput").val().trim();
                fetchData(searchText); // Fetch new data after successful update
            } else {
                cell.text(oldValue); // Revert the cell text to the original value
            }
        },

        error: function(xhr, status, error) {
            cell.text(oldValue); // Revert the cell text to the original value
        },
        complete: function() {
            // Remove the contenteditable attribute and reattach click event handler
            cell.removeAttr("contenteditable");
        }
    });
}

    // Function to handle pagination
    function paginate(direction) {
        var totalPages = Math.ceil(totalRecords / rowsPerPage);
        if (direction === "next" && currentPage < totalPages) {
            currentPage++;
        } else if (direction === "prev" && currentPage > 1) {
            currentPage--;
        }
        fetchData(); // Fetch data for the updated page
    }

    // Previous button click event
    $("#prev-btn").click(function() {
        paginate("prev");
    });

    // Next button click event
    $("#next-btn").click(function() {
        paginate("next");
    });

    // Input field change event
    $("#page-number").on("change", function() {
        var pageNum = parseInt($(this).val());
        if (!isNaN(pageNum) && pageNum >= 1 && pageNum <= Math.ceil(totalRecords / rowsPerPage)) {
            currentPage = pageNum;
            fetchData(); // Fetch data for the updated page
        }
    });


    // Combine filtering and pagination logic
    $('#filter').on('click', function() {
        const rowLimit = $('#row').val();
        filterAndPaginate(rowLimit);
    });

    function filterAndPaginate(rowLimit) {
        const $table = $("#myTable");
        const $tbodyRows = $table.find("tbody tr");
        $tbodyRows.hide();

        if (!rowLimit || parseInt(rowLimit) <= 0) {
            // Show error message or handle this case as per your requirement
            location.reload();
            return;
        } else {
            $tbodyRows.slice(0, parseInt(rowLimit)).show();
        }

        currentPage = 1;
        rowsPerPage = parseInt(rowLimit); // Update rowsPerPage based on the filtered value
        fetchData();
    }

    // Event listener for Enter key to save edited value
    $(document).on("keydown", "tbody td.editable", function(event) {
        // Check if the key pressed is Enter
        if (event.key === "Enter") {
            event.preventDefault(); // Prevent default Enter behavior (newline)
            
            var cell = $(this);
            var newValue = cell.text().trim();
            var oldValue = cell.data("oldValue");

            // Check if the value has changed
            if (newValue !== oldValue) {
                // Update the cell value
                updateValue(cell, newValue, oldValue);
            } else {
                // If the value hasn't changed, simply remove the contenteditable attribute
                cell.removeAttr("contenteditable");
            }
        }
    });

    // Function to handle when a cell is clicked for editing
    $(document).on("click", "tbody td.editable", function(event) {
        var cell = $(this);
        // Store the old value for potential revert
        cell.data("oldValue", cell.text().trim());
        // Make the cell editable
        cell.attr("contenteditable", "true");
        // Focus on the cell
        cell.focus();
    });

    // Call fetchData when the page loads to fetch initial data
    fetchData();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('productTypeSelect').addEventListener('change', function() {
        document.getElementById('product_type_fk').value = this.value;
    });
});
</script>

<!-- Freeze Column -->
<script>
    $(document).ready(function () {
        // Function to freeze columns
        $.fn.freezeColumns = function () {
            var freezePos = 0;
            var totalColumnName = 'December'; // Name of the column to freeze at
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

        // Initialize colResizable
        $("#myTable").colResizable({
            liveDrag: true,
            resizeMode: 'fit'
        });
    });
</script>

<!-- Check Password -->
<script>
  const passwordFieldInsert = document.getElementById('password');
  const togglePasswordButtonInsert = document.getElementById('togglePasswordInsert');
  
  const passwordFieldError = document.getElementById('passwordError');
  const togglePasswordButtonError = document.getElementById('togglePasswordError');

  togglePasswordButtonInsert.addEventListener('click', function() {
    const type = passwordFieldInsert.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordFieldInsert.setAttribute('type', type);
    
    // Toggle eye icon
    if (type === 'password') {
      togglePasswordButtonInsert.classList.remove('fa-eye');
      togglePasswordButtonInsert.classList.add('fa-eye-slash');
    } else {
      togglePasswordButtonInsert.classList.remove('fa-eye-slash');
      togglePasswordButtonInsert.classList.add('fa-eye');
    }
  });

  togglePasswordButtonError.addEventListener('click', function() {
    const type = passwordFieldError.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordFieldError.setAttribute('type', type);
    
    // Toggle eye icon
    if (type === 'password') {
      togglePasswordButtonError.classList.remove('fa-eye');
      togglePasswordButtonError.classList.add('fa-eye-slash');
    } else {
      togglePasswordButtonError.classList.remove('fa-eye-slash');
      togglePasswordButtonError.classList.add('fa-eye');
    }
  });
</script>

<script>
$(document).ready(function(){    
    $('#InsertModalForm').submit(function(e){
        e.preventDefault();
        
        $.ajax({
            type: 'POST',
            url: 'actions/Insert_data.php',
            data: $(this).serialize() + '&Insert_data=1', // Add Insert_data parameter here
            dataType: 'json',
            success: function(response){
                if(response.success){
                  $('#saveanywaysuccessModal').modal('show').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                    $('#InsertModal').modal('hide');
                    $('#InsertModalForm')[0].reset();
                } else {
                    $('#saveanywayerrorModal').modal('show');
                    $('#InsertModal').modal('hide');
                    $('#saveanywayErrorMessage').text(response.error);
                    $('#InsertModalForm')[0].reset();
                }
            },
            error: function(xhr, status, error){
                $('#saveanywayerrorModal').modal('show');
                $('#InsertModal').modal('hide');
                var errorMessage = xhr.responseJSON ? xhr.responseJSON.error : "An error occurred";
                $('#saveanywayErrorMessage').text(errorMessage);
                $('#InsertModalForm')[0].reset();
            }
        });
    });
});

</script>


<script>
    $(document).ready(function(){
        $('#saveanywayForm').submit(function(e){
            e.preventDefault();
            
            $.ajax({
                type: 'POST',
                url: 'actions/save_anyway.php',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#saveanywaysuccessModal').modal('show');
                        $('#InserterrorModal').modal('hide');
                        $('#saveanywayForm')[0].reset();
                    } else {
                        $('#saveanywayerrorModal').modal('show');
                        // $('#InserterrorModal').modal('hide');
                        $('#saveanywayErrorMessage').text(response.error);
                        $('#saveanywayForm')[0].reset();
                    }
                },
                error: function(xhr, status, error){
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#saveChangesBtn').click(function(){
            // Send AJAX request
            $.ajax({
                url: 'actions/check_product_status.php',
                type: 'post',
                data: {saveChangesBtn: true}, // Set the Insert_data parameter to true
                success: function(response){
                    // Show the modal on successful insertion
                    // $('#insertSuccessModal').modal('show');
                    $('#InsertModal').modal('show');
                },
                error: function(xhr, status, error) {
    // Show error modal with department names that have product_status = 0
    var departments = JSON.parse(xhr.responseText);
    var errorMessage = "The following departments are still not ready:";
    
    // Create an unordered list element
    var departmentList = $('<ul>');
    
    // Populate the list with departments
    departments.forEach(function(department) {
        // Create a list item for each department
        var listItem = $('<li>').text(department);
        // Add margin-right to the list item
        listItem.css('margin-right', '10px');
        // Append the list item to the list
        departmentList.append(listItem);
    });
    
    // Add CSS class to make the list items display vertically using flexbox
    departmentList.css({
        'display': 'flex',
        'flex-direction': 'row',
        'list-style-type': 'none'
    });
    
    // Append the list to the error message
    errorMessage += departmentList.prop('outerHTML');
    
    // Set the error message in the error modal
    $('#InserterrorMessage').html(errorMessage);
    
    // Show the error modal
    $('#InserterrorModal').modal('show');
    
    // Hide the insert modal
    $('#InsertModal').modal('hide');
}

            });
        });
    });
</script>

<script>
$(document).ready(() => {
    $('#createButton').click(function () {
        // Get the value of the type name input field
        var typeName = $('#typeName').val().trim();

        // Check if the input is empty
        if (typeName === '') {
            return; // Exit the function, preventing further execution
        }
        // Serialize form data
        var formData = $('#create_type').serialize();

        // AJAX request
        $.ajax({
            type: 'POST',
            url: 'actions/create_type.php',
            data: formData,
            success: function (response) {
                // Check if the operation was successful
                if (response.success) {
                    location.reload();
                } else {

                }
            },
            error: function (xhr, status, error) {
                // Display error message to the user
                alert('An error occurred. Please try again later.');
            }
        });
    });
});
</script>

<script>
$(document).ready(function () {
    // Function to refresh the page
    function refreshPage() {
        location.reload(true); // Reload the page
    }

    // Submit form via AJAX
    $('#addForm').submit(function (event) {
        // Prevent default form submission
        event.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        // AJAX request
        $.ajax({
            type: 'POST',
            url: 'actions/process_form.php',
            data: formData,
            success: function (response) {
                // Parse the JSON response
                var responseData = JSON.parse(response);

                // Check if the operation was successful
                if (responseData.success) {
                    // Show success modal
                    $('#successsModal').modal('show');

                    // Clear form inputs
                    $('#addForm')[0].reset();
                } else {
                    // Show error modal
                }
            },
            error: function (xhr, status, error) {
                // Display error message to the user
                alert('An error occurred. Please try again later.');
            }
        });
    });

    // Refresh page when addForm modal is hidden
    $('#addModal').on('hidden.bs.modal', function () {
        refreshPage();
    });
});

</script>

</html>
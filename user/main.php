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
  <title>Main Page</title>
  <link rel="icon" href="assets/img/a.jpg">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container-fluid p-0 m-0" style="height:100vh;">
  <?php include 'include/header.php'; ?>
  <div class="container-fluid px-5 main-header d-flex justify-content-between py-2" style="height:60px;">
        <form id="searchForm">
          <input class="form-control me-1" type="search"  id="searchInput" placeholder="Search by Name" aria-label="Search" style="width:260px">
        </form>

        <div class="form-inline d-flex flex-row gap-1">
          <button type="button" class="btn text-white" style="height:40px;background-color: #28ACE8;" onclick="$('#addModal').modal('show')">Create</button>
          <input type="number" id="row" style="width:80px; height: 40px;" class="form-control"/>
          <button type="button" class="btn btn-success" style="height:40px" id="filter">Filter</button>
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
          $sql = "CALL update_table_column('')";
          $result = $conn->query($sql);

          if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Fetching only the first row
            echo "<tr>"; // Add opening <tr> tag here
            echo "<th class='text-center sticky'>No</th>";
            foreach ($row as $column_name => $value) {
              // Skip rendering specific columns
              if ($column_name == 'product_pk' || $column_name == 'product_status' || $column_name == 'product_fk') {
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
              echo "<th id='$column_name' class='text-center' style='$background_color'";
              echo "<div class='sticky-background'>"; // Open div for sticky background
              // Special treatment for specific columns
              switch ($column_name) {
                case 'ETA':
                  echo "ETA";
                  break;
                case 'product_name':
                  echo "Product Name <br>";
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
                default:
                  // Output column name as is for other columns
                  echo $column_name;
              }
              echo "</div>"; // Close div for sticky background
            }
            echo "</tr>"; // Add closing </tr> tag here
          }
          ?>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</section>
  </div>
        </div>
           


<?php include 'include/footer.php' ?>
<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h2 class="modal-title" id="addModalLabel">Create</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="POST" action="actions/process_form.php">
                    <div class="row g-3" style="display: flex; flex-wrap: nowrap; overflow-x: auto;">
                        <?php
                        include '../connection/connect.php';

                        $sql = "SELECT
                            COLUMN_NAME AS department_name
                            FROM INFORMATION_SCHEMA.COLUMNS
                            WHERE TABLE_NAME = 'tblproduct_transaction'
                            AND COLUMN_NAME != 'product_status'
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
                                        break;
                                    case 'Consignment_Stock':
                                        $label = 'Consignment Stock';
                                        break;
                                    case 'Pre_Order':
                                        $label = 'Pre Order';
                                        break;
                                    default:
                                        $label = $department_name;
                                }
                                ?>
                                <div class="col-12 mb-3" style="flex: 0 0 auto; width: 200px;">
                                    <label class="form-label text-center fw-bolder w-100"><?= $label ?></label>
                                    <input type="<?= $department_name === 'product_name' ? 'text' : 'number' ?>" class="form-control<?= $first ? ' required' : '' ?>" id="<?= $department_name ?>" name="<?= $department_name ?>"<?= $first ? ' required' : '' ?>>
                                </div>
                                <?php
                                $first = false; // Unset flag after the first iteration
                            }
                        } else {
                            echo "<p>No results found</p>"; // Output if no results found
                        }
                        ?>
                    </div>
                    <!-- Submit button -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="submitButton" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successsModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-success" >
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fw-bolder" style="border:none;">
                Form submitted successfully.
            </div>
            <div class="modal-footer fw-bolder" style="border:none;">
                <button type="button " class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorrModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="errorModalLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body" style="border:none;">
        <p class="h5 fw-bolder" id="errorrMessage">Product name is required</p>
      </div>
      <div class="modal-footer" style="border:none;">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="productStatusModal" tabindex="-1" aria-labelledby="productStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productStatusModalLabel">Select Product Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="productStatusForm" action="actions/Insert_product_status.php" method="post">
          <?php
            // Fetch the current status if available
            if(isset($_SESSION['user_department_fk'])) {
              $id = intval($_SESSION['user_department_fk']);
              $sql = "SELECT product_status FROM tbldepartment WHERE department_pk = $id";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $current_status = $row["product_status"];
              }
              $result->close();
            }
          ?>
          <div class="mb-3 form-check">
            <input type="radio" id="active" name="status" value="1" class="form-check-input"<?php if($current_status == 1) echo ' checked'; ?>>
            <label for="active" class="form-check-label">Active</label>
          </div>
          <div class="mb-3 form-check">
            <input type="radio" id="inactive" name="status" value="0" class="form-check-input"<?php if($current_status == 0) echo ' checked'; ?>>
            <label for="inactive" class="form-check-label">Inactive</label>
          </div>
          <div class="d-flex justify-content-end mt-3">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
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

<script>
    $(document).ready(function() {
      // Function to freeze columns
      $.fn.freezeColumns = function() {
        var freezePos = 0;
        var totalColumnName = 'December'; // Name of the column to freeze at
        $('thead th').each(function(index, val) {
          var $self = $(this);
          var curWidth = $self.outerWidth();
          if ($self.text().trim() === totalColumnName) {
            return false; // Exit loop after the 'Total' column
          }
          $('th:nth-child(' + parseInt(index + 1) + '), td:nth-child(' + parseInt(index + 1) + ')').addClass('sticky').css('left', freezePos);
          freezePos += curWidth;
        });
      };

      $(document).freezeColumns();

      // Synchronize horizontal scrolling of thead with tbody
      $('.table-container').on('scroll', function() {
        var scrollLeft = $(this).scrollLeft();
        $('.sticky-thead').css('left', -scrollLeft);
      });
    });
  </script>

<!-- Resizable Table -->
<script>
$(document).ready(function () {
  $("#myTable").colResizable({
    liveDrag: true,
    resizeMode: 'fit'
  });
});
</script>

<!-- Make tbody editable -->
<script>
  $(document).ready(function() {
    var currentPage = 1; // Current page
    var rowsPerPage = 30; // Number of rows per page
    var totalRecords; // Total number of records
    var data; // Variable to hold the fetched data
    // Add permissions variable
    var permissions = {};

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
        
        // Check if the entered value is numeric for non-"Product Name" columns
        if (column !== "product_name" && !(/^\d*\.?\d*$/.test(value))) {
            $(this).text("0"); // Display "0" if not numeric
        }
    });

     // Event listener for form submission
     $("#searchForm").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Retrieve the search input value
        var searchText = $("#searchInput").val().trim();

        // Call the function to fetch data with the search text
        fetchData(searchText);
    });

    // Function to fetch updated data from the server along with permissions
function fetchData(searchText = '') {
    $.when(
        // Fetch data with permissions
        $.ajax({
            url: "actions/fetch_permissions.php?search=" + searchText,
            type: "GET",
            dataType: "json",
            success: function(response) {
                console.log("Permissions:", response.permissions);
                data = response.data;
                permissions = response.permissions;
            },
            error: function(xhr, status, error) {
                console.error("Data Fetch Error:", error);
            }
        })
    ).then(function() {
        totalRecords = data.length;
        updateTable(data, permissions); // Pass permissions to updateTable
        updatePagination();
        $(document).freezeColumns();
    });
}

    // Call fetchData when the page loads to fetch initial data
    fetchData();

// Update the table content with the fetched data and apply permissions
function updateTable(data, permissions) {
    $('tbody').empty(); // Clear existing table rows

    // Calculate totals for each column
    var columnTotals = {};
    $.each(data, function(index, row) {
        $.each(row, function(column_name, value) {
            if (column_name !== 'product_pk' && column_name !== 'product_status' && column_name !== 'product_fk') {
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
        totalRow.append("<td><span id='" + column_name + "_sum' class='text-center text-danger fw-bolder'>" + total + "</span></td>");
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
        var loopIdTd = $("<td>").text(startingLoopId + index).css("color","grey");
        tr.append(loopIdTd);

        $.each(row, function(column_name, value) {
            if (column_name !== 'product_pk' && column_name !== 'product_status' && column_name !== 'product_fk') {
                var td = $("<td>").attr({
                    "id": column_name,
                    "style": "color:grey",
                    "data-column": column_name,
                    "contenteditable": "false" // Set default to false
                }).text(value);

                // Check if permission is set for this column
                permissions.forEach(function(permission) {
                    if (permission === column_name) {
                        // Allow editing
                        td.attr("contenteditable", "true").addClass("editable text-dark fw-bolder").css("border","2px solid grey");
                    }
                });

                tr.append(td);
            }
        });
        $('tbody').append(tr);
    });
}
    // Function to update pagination controls
    function updatePagination() {
      var totalPages = Math.ceil(totalRecords / rowsPerPage);
      $("#current-page").text(currentPage);
      $("#total-pages").text(totalPages);
      $("#page-number").val(currentPage); // Update input field value
    }


// Function to update value with permission check
function updateValue(cell, newValue, oldValue) {
    // Check permissions before updating
    var productId = cell.closest("tr").attr("id").split("_")[1]; // Extract product ID
    var column = cell.attr("data-column");

    if (permissions[productId] && permissions[productId][column] === false) {
        alert("You don't have permission to edit this cell.");
        cell.text(oldValue); // Revert the cell text to the original value
        return;
    }

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
            console.log("AJAX Success:", response);
            if (response.success) {
                cell.text(newValue); // Update the cell text with the new value
                // Retrieve the search input value
                var searchText = $("#searchInput").val().trim();
                fetchData(searchText); // Fetch new data after successful update
            } else {
                console.error("Update failed:", response.message);
                cell.text(oldValue); // Revert the cell text to the original value
            }
        },

        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
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

  });
</script>

<!-- Sum Column -->
<script>
    $(document).ready(function() {
        // Function to calculate and update sums
        function updateSums() {
            // Initialize sums for each column
            var sums = {};

            // Iterate over each table header (th) except the first one (No)
            $("#myTable th:not(:first)").each(function() {
                var columnName = $(this).attr('id'); // Get column name
                sums[columnName] = 0; // Initialize sum for the column
            });

            // Iterate over each table row (tr)
            $("#myTable tbody tr").each(function() {
                // Iterate over each cell in the row (td)
                $(this).find("td").each(function() {
                    var columnName = $(this).attr('data-column'); // Get column name
                    var cellValue = parseFloat($(this).text().trim()) || 0; // Parse cell value as float, default to 0 if NaN
                    sums[columnName] += cellValue; // Add cell value to the sum of the column
                });
            });

            // Update sums in the table footer
            $.each(sums, function(columnName, total) {
                $('#' + columnName + '_sum').text(total); // Update the sum display
            });
        }

        // Initial calculation and update on page load
        updateSums();

        // Function to update sums when cell value changes
        $(document).on("input", "#myTable td.editable", function() {
            updateSums(); // Recalculate sums when a cell value changes
        });
    });
</script>

<!-- Adding New Value -->
<script>
$(document).ready(function () {
    $('#submitButton').click(function () {
        // Serialize form data
        var formData = $('#addForm').serialize();

        // console.log("Form data:", formData); // Debugging statement

        // AJAX request
        $.ajax({
            type: 'POST',
            url: 'actions/process_form.php',
            data: formData,
            success: function (response) {
                console.log("AJAX success response:", response); // Debugging statement

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
                    $('#errorrModal').modal('show');
                    $('#addModal').modal('hide');
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error("AJAX error:", error); // Log error for debugging
                // Display error message to the user
                alert('An error occurred. Please try again later.');
            }
        });
    });
});
</script>

</html>
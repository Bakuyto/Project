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
<!DOCTYPE html >
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Page</title>
  <link rel="stylesheet" href="assets/css/styling.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container-fluid p-0 m-0" style="height:100vh;">
  <?php include 'include/header.php'; ?>
  <div class="container-fluid px-5 main-header d-flex justify-content-between py-2" style="height:60px;">
    <form id="searchForm">
      <input class="form-control me-1" type="search" id="searchInput" placeholder="Search by Name" aria-label="Search" style="width:260px">
    </form>

    <div class="form-inline d-flex flex-row gap-1">
      <button type="button" id="saveChangesBtn" class="btn btn-danger"  style="height:40px;">Generate</button>
      <button type="button" class="btn text-white" style="height:40px;background-color: #28ACE8;" onclick="$('#addModal').modal('show')">Create</button>
      <input type="number" id="row" style="width:80px; height: 40px;" class="form-control" />
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
            echo "<th class='text-center sticky'>No<br><br><span ></span></th>";
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
              echo "<br><span id='$column_name'></span><span id='{$column_name}_sum'></span></th>";
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
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body" style="border:none;">
        <p class="h5 fw-bolder" id="errorrMessage">Product name is required</p>
      </div>
      <div class="modal-footer" style=" :none;">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
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

<!-- Error Modal -->
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

<!-- Success Modal -->
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

<!-- Error Modal -->
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
        console.log("Form submitted"); // Debugging statement
        e.preventDefault();
        
        $.ajax({
            type: 'POST',
            url: 'actions/Insert_data.php',
            data: $(this).serialize() + '&Insert_data=1', // Add Insert_data parameter here
            dataType: 'json',
            success: function(response){
                console.log("AJAX request successful"); // Debugging statement
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
                console.log("AJAX request failed"); // Debugging statement
                console.log(xhr.responseText); // Log the responseText for debugging
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
                    console.log(xhr.responseText);
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
                    // Check the response if needed
                    console.log(response);
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

    // Click event handler for editing cells
    $(document).on("click", "td.editable", function() {
      var cell = $(this);
      var oldValue = cell.text().trim();
      var column = cell.attr("data-column");

      // Set the contenteditable attribute to true to make the cell editable
      cell.attr("contenteditable", "true").focus();

      // On blur event, send AJAX request to update the value
      // cell.one("blur", function() {
      //   var newValue = cell.text().trim();
      //   updateValue(cell, newValue, oldValue, column);
      // });

      // On pressing Enter key, confirm the edited value
      cell.on("keydown", function(event) {
        if (event.key === "Enter") {
          event.preventDefault(); // Prevent default behavior of Enter key
          var newValue = cell.text().trim();
          updateValue(cell, newValue, oldValue, column);
        }
      });

      // Input validation for numeric columns
      if (column !== "product_name") {
        cell.on("input", function(event) {
          var value = $(this).text().trim();
          if (isNaN(value)) {
            $(this).text(oldValue); // Revert the cell text to the original value
          }
        });
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

    // Function to fetch updated data from the server
    function fetchData(searchText = '') {
        // Modify your SQL query to include the search text as a parameter
        $.ajax({
            url: "actions/fetch_data.php?search=" + searchText,
            type: "GET",
            dataType: "json",
            success: function(response) {
                data = response;
                totalRecords = data.length;
                updateTable(data);
                updatePagination();
                $(document).freezeColumns();
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }

    // Call fetchData when the page loads to fetch initial data
    fetchData();

    // Update the table content with the fetched data
    function updateTable(data) {
        $('tbody').empty(); // Clear existing table rows

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
                if (column_name !== 'product_pk' && column_name !== 'product_status' && column_name !== 'product_fk') {
                    var td = $("<td>").attr({
                        "id": column_name,
                        "class": "editable",
                        "data-column": column_name,
                        "contenteditable": "true",
                        "type": "number"
                    }).text(value);
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


    function updateValue(cell, newValue, oldValue) {
      var column = cell.attr("data-column");

      // If column is not product_name, validate if newValue is numeric
      if (column !== "product_name" && isNaN(newValue)) {
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

  });
</script>

<!-- Sum Column -->
<!-- <script>
    $(document).ready(function() {
    // Function to calculate and update sums
    function updateSums() {
        // AJAX request to fetch sum data from server
        $.ajax({
            url: 'actions/fetch_sums.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Update sums in the table
                $.each(data, function(columnName, total) {
                    $('#' + columnName + '_sum').text('(' + total + ')');
                });
                
                // Call updateSums again after current update completes
                updateSums();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching sums:', error);
                
                // Call updateSums again in case of error
                updateSums();
            }
        });
    }

    // Initial calculation and update on page load
    updateSums();
});
</script> -->

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
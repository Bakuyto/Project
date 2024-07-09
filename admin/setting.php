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
  <title>Setting</title>
  <link rel="icon" href="assets/img/a.jpg">
  <link rel="stylesheet" href="assets/css/create.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php include 'include/header.php'; ?>
  
  <!-- Main Content -->
  <div class="container-fluid px-5 pt-4 pb-4">
  <div class="d-flex justify-content-between">
  <div class="list_dep d-flex">
<?php
    include '../connection/connect.php';  // Include the database connection

    $sql = "CALL Load_All_department()";  // Stored procedure call

    if ($result = $conn->query($sql)) {
        if ($result->num_rows > 0) {
            echo "<div class='form-group mb-4'>";
            echo "<label class='h5'>Check All</label>";
            echo "<input class='form-check-input ms-1 me-3' type='checkbox' id='checkAll'>";
            echo "</div>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='form-group mb-4'>";
                echo "<label class='h5'>" . $row['department_name'] . "</label>";
                $checked = $row['active_status'] == 1 ? 'checked' : '';
                echo "<input class='form-check-input ms-1 me-3' type='checkbox' data-department-id='" . $row['department_pk'] . "' $checked>";
                echo "</div>";
            }
        } else {
            echo '<p>No departments found.</p>';
        }
        $result->free();  // Free result set
    } else {
        echo '<p>Error: ' . $conn->error . '</p>';
    }

    $conn->close();  // Close the database connection
    ?>
</div>
  <form class="d-flex" action="actions/column_alter.php" method="post">
    <div class="select1 me-1" style="margin-top:-20px;">
    <label for="alter_column">Select Column to Alter:</label>
    <select class="form-select" id="alter_column" name="alter_column" style="height:40px;">
        <?php
          include '../connection/connect.php';
        // Fetch column names
        $sql = 'SELECT
            COLUMN_NAME AS column_name
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = "' . $dbname . '" AND TABLE_NAME = "tblproduct_transaction"';
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $columnName = $row["column_name"];
            if ($columnName == 'product_pk' || $columnName == 'product_type_fk' || $columnName == 'product_name') {
                continue;
            }
            echo "<option value='" . $columnName . "'>" . $columnName . "</option>";
        }
        }
        ?>
    </select>
    </div>
    <div class="select2 me-1" style="margin-top:-20px;">
    <label for="after_column">Alter After Column:</label>
    <select class="form-select" id="after_column" name="after_column" style="height:40px;">
        <?php

          // Fetch column names again
          $result = $conn->query($sql);

          if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  $columnName = $row["column_name"];
                  if ($columnName == 'product_pk' || $columnName == 'product_type_fk' || $columnName == 'product_name') {
                      continue;
                  }
                  echo "<option value='" . $columnName . "'>" . $columnName . "</option>";
              }
          }
          ?>
    </select>
    </div>
    <button class="btn btn-success mt-1" type="submit" name="alter_table" style="height:38px;">Alter Table</button>
</form>
</div>
      <div class="row m-auto text-center">  
      <div class="box1 col-sm-12 col-lg-4 border">
    <div class="box-header">
        <div class="h1 mt-5">New Department</div>
        <form method="POST" action="actions/insert-department.php">
            <input name="department_name" class="form-control m-auto mt-5 border-black" style="width:80%;" required>
            <div class="save-but d-flex justify-content-center m-auto mt-5">
                <button type="submit" name="submit_department" style="background-color: var(--blue);"
                    class="btn fw-bolder text-white mb-5 w-50">Save</button>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="table-container tbl-fixed" style="height:90vh;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="border text-center text-white" scope="col"
                            style="background-color: var(--blue); height:50px;">
                            Department
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include '../connection/connect.php';
                    $sql = "CALL Load_All_department"; // SQL query to select data from the table
                    $result = $conn->query($sql); // Execute the query

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Output data row by row
                            echo "<tr>
                                    <td class='d-flex justify-content-between border' name='" . $row["department_name"] . "' id='" . $row["department_pk"] . "'>" . $row["department_name"] . "
                                    <form method='POST'>
                                        <button 
                                            type='button'
                                            name='plus-button'
                                            data-department-name='" . $row["department_name"] . "' 
                                            data-department-pk='" . $row["department_pk"] . "' 
                                            class='btn btn-primary plus-btn fw-bolder' 
                                            data-bs-toggle='modal' 
                                            data-bs-target='#exampleModal'>
                                            <i class='fa-solid fa-plus'></i>
                                        </button>
                                    </form>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='1'>0 results</td></tr>"; // Output if no results found
                    }
                    $conn->close(); // Close the database connection
                    ?>

                </tbody>
            </table>
        </div>
    </div>
      </div>
        <div class="box2 col-sm-12 col-lg-4 border">
          <div class="box-header">
            <div class="h1 mt-5">New Transaction</div>
            <form method="POST" action="actions/insert-column.php">
              <input name="column_name" class="form-control m-auto mt-5 border-black" style="width:80%;" required>
              <div class="save-but d-flex justify-content-center m-auto mt-5">
                <button type="submit" name="submit_transaction" style="background-color: var(--blue);"
                  class="btn fw-bolder text-white mb-5 w-50">Save</button>
              </div>
            </form>
          </div>
          <div class="container">
            <div class="table-container tbl-fixed" style="height:90vh;">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="border text-center text-white" scope="col" style="background-color: var(--blue); height:50px;">
                      Transation
                    </th>
                  </tr>
                </thead>
                <tbody>

                <?php
                      include '../connection/connect.php';
                      $sql = "CALL Load_All_Transaction"; // SQL query to select data from the table
                      $result = $conn->query($sql); // Execute the query
                  if ($result && $result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          // Output data row by row
                          echo "<tr>
                                  <td class='d-flex justify-content-between border'>" . $row["department_name"] . " 
                                      <button type='button' class='btn btn-danger delete-btn' 
                                          onclick='setTransactionToDelete(\"" . $row["department_name"] . "\")' 
                                          data-bs-toggle='modal' data-bs-target='#deleteModal'>
                                          <i class='fa-solid fa-trash-can text-light'></i>
                                      </button>
                                  </td>
                                </tr>";
                      }
                  } else {
                      echo "<tr><td colspan='1'>0 results</td></tr>"; // Output if no results found
                  }
                  $conn->close(); // Close the database connection
              ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="box3 col-sm-12 col-lg-4 border">
          <div class="h1 mt-5">New User</div>
              <form method="POST" action="actions/insert-user.php">
          <div class="form-group">
          <label class="d-flex mx-5 text-start">FullName</label>
          <input type="text" name="user_full_name" class="form-control m-auto mb-3 border-black" style="width:80%;" required>
          </div>
        <div class="form-group">
          <label class="d-flex mx-5 text-start">Username</label>
          <input type="text" name="user_log_name" class="form-control m-auto mb-3 border-black" style="width:80%;" required>
        </div>
        <div class="form-group">
          <label class="d-flex mx-5 text-start">Password</label>
          <input type="password" name="user_log_password" class="form-control m-auto mb-3 border-black" style="width:80%;" required>
        </div>
        <select name="user_level_fk" class="form-select m-auto mb-3"
             style="width:80%;max-height:20vh; overflow-y:scroll;" aria-label="Default select example" required>
              <option class="text-dark" value="" selected disabled>User Level</option>
              <?php
                    include '../connection/connect.php';
                    $sql = "SELECT * FROM tbluserlevel"; // SQL query to select data from the table
                    $result = $conn->query($sql); // Execute the query
    
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          $userlevel_name = $row['userlevel_name']; // Fetch department name
                          $option = $row['userlever_pk'];// Fetch userlever_pk
                          // Output data row by row
                  ?>
                          <option value="<?php echo $option; ?>"><?php echo $userlevel_name; ?> </option>
                  <?php
                      }
                  } else {
                      echo "<option value='' selected>No departments found</option>"; // Output if no results found
                  }
                    $conn->close(); // Close the database connection
                  ?>
            </select>
            <select name="user_department_fk" class="form-select m-auto mb-5"
              style="width:80%;max-height:20vh; overflow-y:scroll;"    required>
              <option class="text-dark" value="" selected disabled>Select Department</option>

              <?php 
                    include '../connection/connect.php';
                    $sql = "CALL Load_All_department"; // SQL query to select data from the table
                    $result = $conn->query($sql); // Execute the query
    
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          $department_name = $row['department_name']; // Fetch department name
                          $option = $row['department_pk'];// Fetch department pk
                          // Output data row by row
                  ?>
                          <option value="<?php echo $option; ?>"><?php echo $department_name; ?> </option>
                  <?php
                      }
                  } else {
                      echo "<option value='' selected>No departments found</option>"; // Output if no results found
                  }
                    $conn->close(); // Close the database connection
                  ?>

            </select>
            <div class="save-but d-flex justify-content-center m-auto">
              <button type="submit" name="submit_user" style="background-color: var(--blue);"
                class="btn fw-bolder text-white mb-5 w-50">Save</button>
            </div>
              </form>
              <div class="container">
            <div class="table-responsive" style="height:40vh;">
              <table class="table ">
                <thead>
                  <tr class="sticky-top top-0" style="z-index:1;">
                    <th class="text-center text-white" scope="col" style="background-color: var(--blue); height:50px;">
                      User List
                    </th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  include '../connection/connect.php';
                  $sql = "CALL Load_All_User"; // SQL query to select data from the table
                  $result = $conn->query($sql); // Execute the query
                  
                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          // Output data row by row
                          echo "<tr>
                                <td class='d-flex justify-content-between border'>" . $row["user_full_name"] . " 
                                <input type='hidden' name='user_pk' value='".$row["user_pk"]." '>
                                <button type='button' id='".$row["user_pk"]."' class='btn btn-primary mx-2 update-btn' data-user-fullname='".$row["user_full_name"]."' data-user-username='".$row["user_log_name"]."' data-user-password='".$row["user_log_password"]."' data-user-level='".$row["user_level_fk"]."' data-user-department='".$row["user_department_fk"]."'><i class='fa-solid fa-pen-to-square'></i></button>
                                </td>
                              </tr>";
                              
                      }
                  } else {
                      echo "<tr><td colspan='1'>0 results</td></tr>"; // Output if no results found
                  }
                  $conn->close(); // Close the database connection
              ?>


                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Modal -->
<div id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #28ACE8;">
                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateUserForm" method="POST" action="actions/update-user.php">
                <input type="hidden" id="user_pk" name="user_pk" value="">
                <div class="form-group">
                    <label class="d-flex mx-5 text-start">FullName</label>
                    <input type="text" id="user_full_name" name="user_full_name" class="form-control m-auto mb-3 border-black" style="width:80%;">
                </div>
                <div class="form-group">
                    <label class="d-flex mx-5 text-start">Username</label>
                    <input type="text" id="user_log_name" name="user_log_name" class="form-control m-auto mb-3 border-black" style="width:80%;">
                </div>
                <div class="form-group">
                    <label for="password" class="d-flex mx-5 text-start">Password</label>
                    <input  id="user_log_password" name="user_log_password" class="form-control m-auto mb-3 border-black" style="width:80%;">
                </div>
                <select id="user_level_fk" name="user_level_fk" class="form-select m-auto mb-3" style="width:80%;max-height:20vh; overflow-y:scroll;" aria-label="Default select example">
                    <option class="text-dark" selected disabled>User Level</option>
                    <?php
                    include '../connection/connect.php';
                    $sql = "SELECT * FROM tbluserlevel"; // SQL query to select data from the table
                    $result = $conn->query($sql); // Execute the query

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $userlevel_name = $row['userlevel_name']; // Fetch department name
                            $option = $row['userlever_pk'];// Fetch userlever_pk
                            // Output data row by row
                            ?>
                            <option value="<?php echo $option; ?>"><?php echo $userlevel_name; ?> </option>
                            <?php
                        }
                    } else {
                        echo "<option value='' selected>No departments found</option>"; // Output if no results found
                    }
                    $conn->close(); // Close the database connection
                    ?>
                </select>
                <select id="user_department_fk" name="user_department_fk" class="form-select m-auto mb-5" style="width:80%;max-height:20vh; overflow-y:scroll;" aria-label="Default select example">
                    <option class="text-dark" selected disabled>Select Department</option>
                    <?php
                    include '../connection/connect.php';
                    $sql = "CALL Load_All_department"; // SQL query to select data from the table
                    $result = $conn->query($sql); // Execute the query

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $department_name = $row['department_name']; // Fetch department name
                            $option = $row['department_pk'];// Fetch department pk
                            // Output data row by row
                            ?>
                            <option value="<?php echo $option; ?>"><?php echo $department_name; ?> </option>
                            <?php
                        }
                    } else {
                        echo "<option value='' selected>No departments found</option>"; // Output if no results found
                    }
                    $conn->close(); // Close the database connection
                    ?>
                </select>
                <div class="save-but d-flex justify-content-center m-auto">
                    <button type="submit" name="update-user" style="background-color: var(--blue);" class="btn fw-bolder text-white mb-5 w-50">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #28ACE8;">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method='POST' action="actions/save-multiple-checkbox.php">
                    <?php
                    include '../connection/connect.php';

                    // Initialize $department_pk
                    $department_pk = isset($_POST['department_pk']) ? $_POST['department_pk'] : '';

                    // Output the hidden input field for department_pk
                    echo "<input type='hidden' name='department_pk' id='department_pk_input' value='$department_pk'>";

                    ?>
                    <!-- Output the checkboxes dynamically -->
                    <div id="checkboxes_container"></div>
                    <div class='form-group mb-3 d-flex justify-content-end'>
                        <button type='button' class='btn btn-secondary mx-2' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' name='save_multiple_checkbox' class='btn btn-primary'>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Transaction Deletion</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this transaction?</p>
          <form id="deleteTransactionForm" action="actions/delete-column.php" class="d-flex justify-content-center" method="POST">
            <input type="hidden" name="transactionToDelete" id="transactionToDelete">
            <button type="button" class="btn btn-secondary mx-1" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="submit_delete_transaction" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Success Message -->
<div class="modal fade" id="successModall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-success">
                <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                // Output success message from URL parameter
                if (isset($_GET['message'])) {
                    echo $_GET['message'];
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Error Message -->
<div class="modal fade" id="errorModall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>No Brands Have Been Selected!!!!</p>
            </div>
        </div>
    </div>
</div>

<?php
// Check if success parameter is present in the URL
if (isset($_GET['success']) && $_GET['success'] === 'true') {
    // Output JavaScript to trigger the success modal
    echo "<script>
            $(document).ready(function(){
                $('#successModall').modal('show');
            });
          </script>";
}

// Check if error parameter is present in the URL
if (isset($_GET['error']) && $_GET['error'] === 'true') {
    // Output JavaScript to trigger the error modal
    echo "<script>
            $(document).ready(function(){
                $('#errorModall').modal('show');
            });
          </script>";
}
?>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <script>
 $(document).ready(function (){
   $('#exampleModal').on('show.bs.modal', function (event) {
     var button = $(event.relatedTarget);
     var department_pk = button.data('department-pk');
     var modal = $(this);
     modal.find('#department_pk_input').val(department_pk);
   });
 });
  </script>
<script>
  $(document).ready(function() {
    $('.update-btn').click(function() {
      var userId = $(this).attr('id'); // Get the user ID from the button

      // Assuming you have hidden input fields in your modal to hold the user's data
      // Populate these fields with the user's information
      var fullName = $(this).closest('tr').find('.user-full-name').text().trim();
      var username = $(this).closest('tr').find('.username').text().trim();
      var password = $(this).closest('tr').find('.password').text().trim();

      // Retrieve data from the button attributes or from another source
      var userFullName = $(this).data('user-fullname');
      var userUsername = $(this).data('user-username');
      var userPassword = $(this).data('user-password');
      var userLevel = $(this).data('user-level');
      var userDepartment = $(this).data('user-department');

      $('#user_pk').val(userId); // Set the user_pk value
      $('#user_full_name').val(fullName || userFullName);
      $('#user_log_name').val(username || userUsername);
      $('#user_log_password').val(password || userPassword);
      $('#user_level_fk').val(userLevel);
      $('#user_department_fk').val(userDepartment);

      $('#updateModal').modal('show'); // Show the modal
    });
  });
</script>
<script>
  function setTransactionToDelete(transactionName) {
    document.getElementById('transactionToDelete').value = transactionName;
  }
</script>
<script>
   document.querySelectorAll('.plus-btn').forEach(button => {
        button.addEventListener('click', function () {
          var departmentName = this.getAttribute('data-department-name');
          var modalTitle = document.querySelector('#exampleModal .modal-title');
          modalTitle.textContent = departmentName;
          modalTitle.id = ""; // Clear the ID first
          modalTitle.id = this.parentNode.id; // Set the ID based on the department ID
        });
      });
</script>

<script>
$(document).ready(function() {
    $('.plus-btn').click(function() {
        var department_pk = $(this).data('department-pk');
        $.ajax({
            url: 'actions/get-check-status.php', // PHP script to fetch checkboxes based on department_pk
            type: 'POST',
            data: {
                department_pk: department_pk
            },
            success: function(response) {
                $('#checkboxes_container').html(response); // Populate checkboxes in the modal
            }
        });
    });
});
</script>


<script>
$(document).ready(function() {
    // Handle individual checkbox change
    $('.form-check-input[data-department-id]').change(function() {
        let departmentId = $(this).data('department-id');
        let activeStatus = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: 'actions/update_department_status.php',
            type: 'POST',
            data: {
                department_id: departmentId,
                active_status: activeStatus
            },
            success: function(response) {
                console.log(response); // Optional: log the response
            },
            error: function(xhr, status, error) {
                console.error(error); // Handle errors
            }
        });
    });

    // Handle "Check All" functionality
    $('#checkAll').change(function() {
        let isChecked = $(this).is(':checked');
        $('.form-check-input[data-department-id]').each(function() {
            $(this).prop('checked', isChecked).trigger('change');
        });
    });

    // Set the "Check All" checkbox based on individual checkboxes' state
    function updateCheckAllStatus() {
        let allChecked = $('.form-check-input[data-department-id]').length === $('.form-check-input[data-department-id]:checked').length;
        $('#checkAll').prop('checked', allChecked);
    }

    // Run on page load to set the "Check All" checkbox correctly
    updateCheckAllStatus();

    // Re-check the "Check All" checkbox state whenever an individual checkbox changes
    $('.form-check-input[data-department-id]').change(updateCheckAllStatus);
});
</script>

</html>
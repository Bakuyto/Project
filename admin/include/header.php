<?php
$current_page = basename($_SERVER['PHP_SELF']); // Get the current page filename
?>
<nav class="navbar w-100 navbar-expand-lg bg-info sticky-top top-0" style="height:60px;">
  <div class="container-fluid px-5">
    <a class="navbar-brand text-light" href="main.php"><h3>Pacific</h3></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center"
      id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a
            class="nav-link <?php if($current_page == 'main.php') echo 'text-light active'; ?>"
            href="main.php"><h4>Home</h4></a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link <?php if($current_page == 'report.php') echo 'text-light active'; ?>"
            href="report.php"><h4>Report</h4></a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link <?php if($current_page == 'create-user.php') echo 'text-light active'; ?>"
            href="create-user.php"><h4>Create</h4></a>
        </li>
        <!-- <li class="nav-item d-sm-none d-md-none">
          <a href="#"><div
              class="nav-link justify-content-end"><h4>Logout</h4></div></a>
        </li> -->
      </ul>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent"
      style="flex-grow:0;">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown d-flex">
          <!-- Profile Picture -->
          <div class="pf-pic rounded-circle bg-secondary"
            style="width: 40px; height: 40px;">
            <img
              src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
              alt="Profile Picture"
              style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
          </div>
          <!-- Username and Dropdown -->
          <a class="nav-link dropdown-toggle fw-bold fs-6 text-white" href="#"
            id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <?php 
                if(isset($_SESSION['user_full_name'])) {
                    echo $_SESSION['user_full_name'];
                } else {
                    echo 'user_full_name';
                }
            ?>
          </a>
          <!-- Dropdown Menu -->
          <div class="dropdown-menu dropdown-menu-right mt-5 bg-white"
            aria-labelledby="navbarDropdown" style="margin-left:-20px;">
            <div class="profile-info">
              <h5 class="ms-3"><?php 
                if(isset($_SESSION['user_full_name'])) {
                  echo $_SESSION['user_full_name'] . '<br>';
                  // Check if user_level_fk is set in the session and display role accordingly
                  if(isset($_SESSION['user_level_fk'])) {
                      if ($_SESSION['user_level_fk'] == 1) {
                          echo ' (Admin)';
                      } elseif ($_SESSION['user_level_fk'] == 2) {
                          echo ' (Staff)';
                      }
                  }
              } else {
                  echo 'Username';
              }
            ?></h5>
            </div>
            <div class="dropdown-divider"></div>        
            <button type="button" id="changePasswordBtn" data-userpk="<?php echo $_SESSION['user_pk']; ?>" onclick="$('#changePasswordModal').modal('show');" class="dropdown-item">Change Password</button>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../admin/logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body">
      <form id="changePasswordForm" action="../admin/actions/change_password.php" method="post">
    <input type="hidden" name="user_pk" value="<?php echo isset($_SESSION['user_pk']) ? $_SESSION['user_pk'] : ''; ?>">
    <div class="form-group">
        <label for="currentPassword">Current Password</label>
        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
    </div>
    <div class="form-group">
        <label for="newPassword">New Password</label>
        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
    </div>
    <div class="form-group">
        <label for="confirmPassword">Confirm New Password</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
    </div>
    
    <div class="d-flex justify-content-center mt-2">
        <button type="submit" class="w-50 btn btn-primary mt-2">Submit</button>
    </div>
</form>
      </div>
    </div>
  </div>
</div>



<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-success">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Password Changed successfully.
            </div>
            <div class="modal-footer" style="border:none;">
                <button type="button " class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-white bg-danger">
        <h5 class="modal-title" id="errorModalLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="errorMessage"></p>
      </div>
      <div class="modal-footer" style="border-top:none;">
      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
  $('#changePasswordForm').submit(function(e) {
      e.preventDefault(); // Prevent the form from submitting normally

      // Serialize the form data
      var formData = $(this).serialize();

      // Send an AJAX request
      $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data: $(this).serialize(),
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                  // If password change is successful, show success modal and close password change modal
                  $('#successModal').modal('show');
                  $("#currentPassword, #newPassword, #confirmPassword").val('');
                  $('#changePasswordModal').modal('hide');
              } else {
                  // If there's an error, show error modal with appropriate message
                  $('#errorMessage').text(response.message);
                  $('#errorModal').modal('show');
                  // $('#changePasswordModal').modal('hide');
              }
          },
          error: function(xhr, status, error) {
              // If AJAX request fails, show generic error message
              console.error(xhr.responseText);
              $('#errorMessage').text('An error occurred while processing your request. Please try again.');
              $('#errorModal').modal('show');
          }
      });
  });
});
</script>

<script>
document.getElementById('changePasswordBtn').addEventListener('click', function() {
    var userPk = this.getAttribute('data-userpk');

    // Send an AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'change_password.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText);
            // Redirect to main.php after password change
            window.location.href = "../main.php";
        }
    };
    xhr.send('user_pk=' + userPk );
}); // <-- Closing parenthesis was missing here
</script>


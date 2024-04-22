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
              src="data:image/jpeg;base64,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"
              alt="Profile Picture"
              style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
          </div>
          <!-- Username and Dropdown -->
          <a class="nav-link dropdown-toggle fw-bold fs-6 text-white" href="#"
            id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <?php 
                if(isset($_SESSION['username'])) {
                    echo $_SESSION['username'];
                } else {
                    echo 'Username';
                }
            ?>
          </a>
          <!-- Dropdown Menu -->
          <div class="dropdown-menu dropdown-menu-right mt-5 bg-white"
            aria-labelledby="navbarDropdown" style="margin-left:-10px;">
            <div class="profile-info">
              <h5 class="ms-3"><?php 
                if(isset($_SESSION['username'])) {
                  echo $_SESSION['username'] . '<br>';
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
            <button type="button" id="changePasswordBtn" data-userpk="<?php echo $_SESSION['user_pk']; ?>" data-toggle="modal" data-target="#changePasswordModal" class="dropdown-item" href="#">Change Password</button>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    console.log("Document is ready."); // Check if document is ready
    $("#changePasswordForm").submit(function(event){
        console.log("Form submission intercepted."); // Check if form submission is intercepted
        event.preventDefault();
        var formData = $(this).serialize();
        console.log("Form data serialized:", formData);
        
        $.ajax({
    type: "POST",
    url: "actions/change_password.php",
    data: formData,
    dataType: "json",
    success: function(response) {
        // Check if the request was successful
        if (response.success) {
            // If successful, display success message
            alert(response.message);
            // Clear input fields
            $("#currentPassword, #newPassword, #confirmPassword").val('');
        } else {
            // If not successful, display error message
            alert(response.message);

            $("#currentPassword, #newPassword, #confirmPassword").val('');

        }
    },
    error: function(xhr, status, error) {
        // If there was an error with the request, display a generic error message
        alert("An error occurred while processing your request. Please try again later.");
        console.log(xhr.responseText);
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


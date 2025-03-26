<?php session_start(); ?>

<?php
  include '../config/config.php';
  class data extends Connection{ 
      public function managedata(){ 

?>
<!DOCTYPE html>
<html>
<head>
<?php include 'head.php'; ?>
<style>
.dropdown-menu {
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}

.dropdown-menu > li > a {
    display: block;
    padding: 8px 20px;
    clear: both;
    font-weight: 400;
    color: #333;
    white-space: nowrap;
}

.dropdown-menu > li > a:hover {
    background-color: #f5f5f5;
    text-decoration: none;
}

.dropdown-menu > li > a > i {
    margin-right: 10px;
}

.modal-xl {
    width: 95%;
    max-width: 1400px;
}

.modal-body {
    max-height: 85vh;
    overflow-y: auto;
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


<?php include 'navbar.php'; ?>
<?php include 'profile.php'; ?>
<?php include 'sidebar.php'; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="overflow-y: scroll;height: 100vh;padding-bottom: 50px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LOG
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">LOG</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th></th>
                  <th></th>
                  <th></th> 
                  <th></th>
                </thead>
                <tbody>
                  <?php $sql = "SELECT *,request.id AS request_id FROM request INNER JOIN users ON request.users_id=users.id WHERE request.status = 'Approved'";
                  $stmt = $this->conn()->query($sql);
                  while ($row = $stmt->fetch()) { ?>
                    <tr>
                      <td>
                        <p><b>Name:</b> <?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></p>
                        <p><b>Event:</b> <?php echo $row['department'] ?></p>
                        <p><b>File:</b> <a href="../file/<?php echo $row['file'] ?>"><?php echo $row['file'] ?></a></p>
                        <p><b>Status:</b> <?php echo $row['status'] ?></p>
                      </td>
                      <td>
                        <p><b>Time:</b> <?php echo $row['timeneeded'] ?></p>
                        <p><b>Date:</b> <?php echo $row['dateneeded'] ?></p>
                      </td>
                      <td>
                        <p><b>Person in-charge:</b> <?php echo $row['personincharge'] ?></p>
                        <p><b>Contact:</b> <?php echo $row['contactnumber'] ?></p>
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                              <a href="#" class="view-details" data-request_id="<?php echo $row['request_id'] ?>">
                                Details
                              </a>
                            </li>
                            <li>
                              <a href="#" class="edit" data-request_id="<?php echo $row['request_id'] ?>"> Edit Form
                              </a>
                            </li>
                            <li>
                              <a href="#" class="createevent" 
                                data-request_id="<?php echo $row['request_id'] ?>"
                                data-users_id="<?php echo $row['users_id'] ?>"
                                data-department="<?php echo $row['department'] ?>">
                                Create Event
                              </a>
                            </li>
                            <li>
                              <a href="#" class="delete" data-delete_id="<?php echo $row['id'] ?>">
                                Delete
                              </a>
                            </li>
                          </ul> 
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>  
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>


</div>
<!-- ./wrapper -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editForm" method="POST">
        <div class="modal-body">

          <div id="editFormContent"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detailsContent">
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
<?php include 'modal/deleteModal.php'; ?>
<?php include 'modal/dashboardModal.php'; ?>
<!-- Active Script -->
<script>

    $(document).on('click', '#admin_profile', function(e){
    e.preventDefault();
    $('#profile').modal('show');
    var user_id = $(this).data('user_id');
    var firstname = $(this).data('firstname');
    var email = $(this).data('email');
    var password = $(this).data('password');

    $('#user_id').val(user_id)
    $('#firstname').val(firstname)
    $('#email').val(email)
    $('#password').val(password)

  });
$(function(){
  var url = window.location;
  
  $('ul.sidebar-menu a').filter(function() {
      return this.href == url;
  }).parent().addClass('active');

  // for treeview
  $('ul.treeview-menu a').filter(function() {
      return this.href == url;
  }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

});
</script>
<!-- Data Table Initialize -->
<script>
  $(function () {
    $('#example1').DataTable({
      responsive: true
    })
  })
</script>

<script>
  $('.delete').click(function(){
    $('#deleteModal').modal('show');
    delete_id = $(this).data('delete_id')
    $('#delete_id').val(delete_id)
  })

  $('.createevent').click(function(){
    $('#event_entry_modal').modal('show');
    request_id = $(this).data('request_id')
    users_id = $(this).data('users_id')
    department = $(this).data('department')
    

    $('#request_id').val(request_id)
    $('#users_id').val(users_id)
    $('#event_name').val(department)
  })

  $(document).ready(function () {
    $('.edit').click(function () {
      const requestId = $(this).data('request_id');
      $.ajax({
        url: '../controller/get_form_data.php',
        type: 'POST',
        data: { id: requestId },
        success: function (response) {
          $('#editFormContent').html(response);
          $('#editModal').modal('show');
        },
        error: function () {
          alert('Failed to fetch form data.');
        }
      });
    });

    $('#editForm').submit(function (e) {
      e.preventDefault();
      $.ajax({
        url: '../controller/update_form_data.php',
        data: $(this).serialize(),
        success: function (response) {
          alert('Form updated successfully.');
          $('#editModal').modal('hide');
          location.reload();
        },
        error: function () {
          alert('Failed to update form.');
        }
      });
    });

    $('.view-details').click(function(e) {
      e.preventDefault();
      const requestId = $(this).data('request_id');
      $.ajax({
        url: '../controller/get_request_details.php',
        type: 'POST',
        data: { id: requestId },
        success: function(response) {
          $('#detailsContent').html(response);
          $('#detailsModal').modal('show');
        },
        error: function() {
          alert('Failed to fetch request details.');
        }
      });
    });
  });
</script>
</body>
</html>
<?php  } } $data = new data();  $data->managedata(); ?>

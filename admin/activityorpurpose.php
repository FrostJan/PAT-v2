<?php session_start(); ?>

<?php
  include '../config/config.php';
  class data extends Connection{ 
      public function managedata(){ 

?>
<!DOCTYPE html>
<html>
<head><?php include 'head.php'; ?></head>
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
        Activity Purpose
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Activity Purpose</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-success btn-sm btn-flat">ADD</a> 
            </div>
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Name</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php $sql = "SELECT * FROM activitypurpose";
                  $stmt = $this->conn()->query($sql);
                  while ($row = $stmt->fetch()) { ?>
                    <tr>
                      <td><?php echo $row['name'] ?></td>
                      <td>
                        <button class="btn btn-success btn-sm edit" style="padding: 5px 5px;color: #000;border: unset;"
                        data-edit_id="<?php echo $row['id'] ?>"
                        data-edit_name="<?php echo $row['name'] ?>"
                        

                        ><b>Edit</b></button>
                        <button class="btn btn-danger btn-sm delete" style="padding: 5px 5px;color: #000;border: unset;"
                        data-delete_id="<?php echo $row['id'] ?>"><b>Delete</b></button>
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

<?php include 'footer.php'; ?>
<?php include 'modal/activityorpurposeModal.php'; ?>
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
  /** add active class and stay opened when selected */
  var url = window.location;
  
  // for sidebar menu entirely but not cover treeview
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
    $('#delete').modal('show');
    delete_id = $(this).data('delete_id')
    $('#delete_id').val(delete_id)
  })

  $('.edit').click(function(){
    $('#edit').modal('show');
    edit_id = $(this).data('edit_id')
    edit_name = $(this).data('edit_name')

    $('#edit_id').val(edit_id)
    $('#edit_name').val(edit_name)
  })
</script>
</body>
</html>
<?php  } } $data = new data();  $data->managedata(); ?>
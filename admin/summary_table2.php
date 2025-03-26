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
        Summary
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Summary</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="row">
        <div class="col-xs-12">
          <div>
            <h4>Month: <?php
            $month = isset($_GET['month']) ? (int)$_GET['month'] : 5;
            echo date('F', mktime(0, 0, 0, $month, 1, date('Y')));
            ?>
            </h4>
          </div>
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
                  <?php $sql = "SELECT * FROM request WHERE Month(datefilled) = '".$_GET['month']."'";
                  $stmt = $this->conn()->query($sql);
                  while ($row = $stmt->fetch()) { ?>
                    <tr>
                      <td>
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
                        <a class="btn btn-success btn-sm" href="document_history.php?id=<?php echo $row['id'] ?>" style="padding: 5px 5px;color: #000;background-color: #c6dc41;border: unset;"><b>Details</b></a>
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
<?php include 'modal/deleteModal.php'; ?>
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

</body>
</html>
<?php  } } $data = new data();  $data->managedata(); ?>
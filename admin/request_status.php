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

  <div class="content-wrapper" style="overflow-y: scroll;height: 100vh;padding-bottom: 50px;">
    <section class="content-header">
      <h1>
        Request Status
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Request Status</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Event</th>
                  <th>Date Filed</th>
                  <th>Date Needed</th>
                  <th>Status</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php 
                  $sql = "SELECT * FROM request WHERE users_id = '".$_SESSION['id']."' ORDER BY datefilled DESC";
                  $stmt = $this->conn()->query($sql);
                  while ($row = $stmt->fetch()) { ?>
                    <tr>
                      <td><?php echo $row['department'] ?></td>
                      <td><?php echo date('M d, Y', strtotime($row['datefilled'])) ?></td>
                      <td><?php echo date('M d, Y', strtotime($row['dateneeded'])) ?></td>
                      <td>
                        <?php if($row['status'] == 'Approved'): ?>
                          <span class="label label-success"><?php echo $row['status'] ?></span>
                        <?php elseif($row['status'] == 'Declined'): ?>
                          <span class="label label-danger"><?php echo $row['status'] ?></span>
                        <?php else: ?>
                          <span class="label label-warning">Pending</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <button class="btn btn-info btn-sm view-details" data-id="<?php echo $row['id'] ?>">
                          <i class="fa fa-eye"></i> View Details
                        </button>
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

<?php include 'footer.php'; ?>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg" role="document" style="width: 90%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="detailsModalLabel">Document Details</h4>
      </div>
      <div class="modal-body" id="details_content">
        <!-- Details content will be loaded here -->
      </div>
    </div>
  </div>
</div>

<script>
$(function () {
  $('#example1').DataTable({
    'order': [[1, 'desc']],
    responsive: true
  })
})
</script>

<script>
$(document).ready(function() {
  $('.view-details').click(function() {
    var id = $(this).data('id');
    
    // Load details into modal
    $.ajax({
      url: 'get_request_details.php',
      type: 'POST',
      data: {id: id},
      success: function(response) {
        $('#details_content').html(response);
        $('#detailsModal').modal('show');
      }
    });
  });
});
</script>

</body>
</html>
<?php  } } $data = new data();  $data->managedata(); ?>
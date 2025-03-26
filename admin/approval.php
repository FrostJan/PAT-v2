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
        APPROVAL REQUESTS
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">APPROVAL REQUESTS</li>
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
                  <th>Deparment</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>File</th>
                </thead>
                <tbody>
                  <?php $sql = "SELECT * FROM request";
                  $stmt = $this->conn()->query($sql);
                  while ($row = $stmt->fetch()) { ?>
        
                          <tr>
                            <td>
                              <a class="btn btn-success btn-flat" href="approval.php?id=<?php echo $row['id'] ?>" style="color: black;"><b>OPEN FORM</b></a>
                              <button class="btn btn-primary btn-flat approval" data-request_id="<?php echo $row['id'] ?>"><b>Approval</b></button>
                            </td>
                            <td><?php echo $row['department'] ?></td>
                            <td><?php echo $row['datefilled'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td>
                              <a href="../file/<?php echo $row['file'] ?>" target="_blank"><?php echo $row['file'] ?></a>
                            </td>
                          </tr>
    
                      <?php 

                          }
                          ?>



                </tbody>
              </table>

              
              <?php if (isset($_GET['id'])) { ?>
                <br>
              <h2 style="background-color: #000;color: #fff;padding: 5px;"><b>Document</b></h2>
                <?php
                $sql = "SELECT * FROM request WHERE id = '".$_GET['id']."'";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch();
                ?>


              <?php if (isset($_GET['id'])) { ?>

      <?php
      $sql = "SELECT * FROM request WHERE id = '".$_GET['id']."'";
      $stmt = $this->conn()->query($sql);
      $row = $stmt->fetch();
      ?>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <a href="details_print.php?id=<?php echo $_GET['id'] ?>" class="btn btn-success btn-sm btn-flat" target="_blank">Print</a>
                <h3>Document Details</h3>
              </div>
              <div class="box-body">
                <form class="form-horizontal" method="POST" action="../controller/facility_formController.php" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-4 col-md-12">
                      <div class="form-group">
                        <label for="project_list_id" class="col-sm-4">Department: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="<?php echo $row['department'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="project_list_id" class="col-sm-4">Activity/Purpose: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="<?php echo $row['activityorpurpose'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="project_list_id" class="col-sm-4">Division: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="<?php echo $row['division'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="project_list_id" class="col-sm-4">Number of attendees: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="<?php echo $row['numberofattendees'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="project_list_id" class="col-sm-4">Date filled: </label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" value="<?php echo $row['datefilled'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="project_list_id" class="col-sm-4">Time Needed: </label>
                        <div class="col-sm-8">
                          <div style="display: flex;">
                            <input class="form-control" value="<?php echo $row['timeneeded'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="project_list_id" class="col-sm-4">Date Needed: </label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" value="<?php echo $row['dateneeded'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="project_list_id" class="col-sm-4">Person in-charge: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="<?php echo $row['personincharge'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="project_list_id" class="col-sm-4">Contact number: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="<?php echo $row['contactnumber'] ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-12" style="padding-left:100px;">
                      <div class="row">
                        <h4 style="font-weight: bold;">SERVICES TO BE PROVIDED:</h4>
                      </div>

                      <div class="row">
                        <div class="col-xs-4">
                          <div class="form-group">
                              <div style="display: flex;">
                                <input type="checkbox" <?php if ($row['pat'] == 'yes') { echo "checked"; } ?> disabled><label style="margin-top: 7px;margin-left: 3px;"> PAT </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group">
                              <div style="display: flex;">
                                <input type="checkbox" <?php if ($row['emcroom'] == 'yes') { echo "checked"; } ?> disabled><label style="margin-top: 7px;margin-left: 3px;"> EMC ROOM </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group">
                              <div style="display: flex;">
                                <input type="checkbox" <?php if ($row['tvroom'] == 'yes') { echo "checked"; } ?> disabled><label style="margin-top: 7px;margin-left: 3px;"> TVROOM </label>
                              </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <h4 style="font-weight: bold;">CLASSIFICATION OF ACTIVITY:</h4>
                      </div>
                      <div class="row">
                        <div class="col-xs-4">
                          <div class="form-group" style="margin-bottom: unset;">
                              <div style="display: flex;">
                                <input type="checkbox" <?php if ($row['institutional'] == 'yes') { echo "checked"; } ?> disabled><label style="margin-top: 7px;margin-left: 3px;"> Institutional </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group" style="margin-bottom: unset;">
                              <div style="display: flex;">
                                <input type="checkbox" <?php if ($row['curricular'] == 'yes') { echo "checked"; } ?> disabled><label style="margin-top: 7px;margin-left: 3px;"> Curricular </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group" style="margin-bottom: unset;">
                              <div style="display: flex;">
                                <input type="checkbox" <?php if ($row['outsidegroup'] == 'yes') { echo "checked"; } ?> disabled><label style="margin-top: 7px;margin-left: 3px;"> Outside Group </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group" style="margin-bottom: unset;">
                              <div style="display: flex;">
                                <input type="checkbox" <?php if ($row['cocurricular'] == 'yes') { echo "checked"; } ?> disabled><label style="margin-top: 7px;margin-left: 3px;"> Co-Curricular </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group">
                              <div style="display: flex;">
                                <input type="checkbox" <?php if ($row['extracurricular'] == 'yes') { echo "checked"; } ?> disabled><label style="margin-top: 7px;margin-left: 3px;"> Extra Curricular </label>
                              </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-3">
                          <div class="form-group">
                            <div style="background-color: rgba(0, 0, 0, 0.2);border: 2px solid black;text-align: center;padding: 15px;">
                              <div style="text-align: left;"><label>Noted By:</label></div>
                              <div><label>Oliver Junio</label></div>
                              <div><label>Department Head</label></div>
                              <!-- <div><label>Status: <label class="text-success">Signed</label></label></div> -->
                              <!-- <div><button class="btn btn-sm" style="background-color: #e1ee95;"><b>Send</b></button></div> -->
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="form-group">
                            <div style="padding: 15px;">
                              <div><label style="margin-bottom: unset;">Recommending Approval:</label></div>
                              <div><span>(For Audiovisual Facilities UPHSL)</span></div>
                              <div style="text-align: center;margin-top: 7px;">
                                <div><label>Mr. Ruel B. Rilloraza</label></div>
                                <div><span>Head of Audiovisual Facilities</span></div>
                                <!-- <div><label>Status: <label class="text-success">Signed</label></label></div> -->
                                <!-- <div><button class="btn btn-sm" style="background-color: #e1ee95;"><b>Send</b></button></div> -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12" style="margin-top: 5px;">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="form-group" style="max-width: 800px;margin: auto;">
                            <div style="background-color: #c9c9c933;border: 2px solid black;text-align: center;padding: 5px;">
                              <div><span>APPROVED BY:</span></div>
                              <div><label style="margin-bottom: unset;">Dr. Ferdinand C. Somido</label></div>
                              <div><span>Executive School director</span></div>
                              <!-- <div><label style="margin-bottom: unset;">Status: <label class="text-success">Signed</label></label></div> -->
                              <!-- <div><button class="btn btn-sm" style="background-color: #e1ee95;"><b>Send</b></button></div> -->
                            </div>
                          </div>
                        </div>
                        <br><br><br><br>
                        <div class="col-xs-12">
                          <div class="form-group" style="max-width: 800px;margin: auto;">
                            <div style="background-color: #c9c9c933;border: 2px solid black;padding: 5px;">
                              <div><span>Once everything is signed, provide a copy of accomplishment form to the following:</span></div>
                              <div style="text-align: center;margin-top: 7px;">
                                <!-- <div><button class="btn btn-sm" style="background-color: #e1ee95;"><b>Send</b></button></div> -->
                                <div><label style="margin-bottom: unset;">Audiovisual Facilities Office</label></div>
                                <div><label style="margin-bottom: unset;">Audiovisual (MU)</label></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12" style="margin-top: 20px;">
                      <embed src="../file/<?php echo $row['file'] ?>" type="application/pdf" width="100%" height="600px" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>
            
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
         <!-- <embed src="COMMENTS-NA-NEED-MAMEET-SA-SYSTEMUpdated.pdf" type="application/pdf" width="100%" height="600px" /> -->

  </div>


</div>
<!-- ./wrapper -->

<?php include 'footer.php'; ?>
<?php include 'modal/approvalModal.php'; ?>

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

  $('.approval').click(function(){
    $('#approvalModal').modal('show');
    request_id = $(this).data('request_id')
    $('#request_id').val(request_id)
  })
</script>

</body>
</html>
     <?php
                      }
                        
                  }

                    $data = new data();
                    $data->managedata();
                              
                  ?>
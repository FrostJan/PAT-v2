<?php session_start(); ?>

<?php
  include '../config/config.php';
  class data extends Connection{ 
      public function managedata(){ 

?>
<!DOCTYPE html>
<html>
<head><?php include 'head.php'; ?></head>
<style>
  .form-control{
    height: 25px;
  }
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


<?php include 'navbar.php'; ?>
<?php include 'profile.php'; ?>
<?php include 'sidebar.php'; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #fff;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="text-align: center;font-weight: bold;">
        COMMON FACILITY REQUEST FORM
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="">
            <div class="box-body">
              <form class="form-horizontal" method="POST" action="../controller/facility_formController.php" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-lg-4 col-md-12">
                    <div class="form-group">
                      <label for="project_list_id" class="col-sm-4">Department: </label>
                      <div class="col-sm-8">
                        <select class="form-control" id="" name="department" style="height: 33px;" required>
                          <option value="">Select</option>
                          <option value="College of Arts and Sciences">College of Arts and Sciences</option>
                          <option value="College of Business and Accountancy">College of Business and Accountancy</option>
                          <option value="College of Computer Studies">College of Computer Studies</option>
                          <option value="College of Criminology">College of Criminology</option>
                          <option value="College of Education">College of Education</option>
                          <option value="College of Engineering and Aviation">College of Engineering and Aviation</option>
                          <option value="College of International Hospitality Management">College of International Hospitality Management</option>
                          <option value="College of Maritime">College of Maritime</option>
                          <option value="Senior High School">Senior High School</option>
                          <option value="Basic Education">Basic Education</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="project_list_id" class="col-sm-4">Activity/Purpose: </label>
                      <div class="col-sm-8">
                        <select class="form-control" id="" name="activityorpurpose" style="height: 33px;" required>
                          <option value="">Select</option>
                          <?php
                          $sql = "SELECT * FROM activitypurpose";
                          $stmt = $this->conn()->query($sql);
                          while($row = $stmt->fetch()){ ?>
                            <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="project_list_id" class="col-sm-4">Division: </label>
                      <div class="col-sm-8">
                        <input class="form-control" id="" name="division" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="project_list_id" class="col-sm-4">Number of attendees: </label>
                      <div class="col-sm-8">
                        <input class="form-control" id="" name="numberofattendees" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="project_list_id" class="col-sm-4">Date filled: </label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" id="" name="datefilled" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="project_list_id" class="col-sm-4">Time Needed: </label>
                      <div class="col-sm-8">
                        <div style="display: flex;">
                          <input class="form-control" id="" name="timeneeded1" required> &nbsp;&nbsp;To&nbsp;&nbsp; <input class="form-control" id="" name="timeneeded2" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="project_list_id" class="col-sm-4">Date Needed: </label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" id="" name="dateneeded" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="project_list_id" class="col-sm-4">Person in-charge: </label>
                      <div class="col-sm-8">
                        <input class="form-control" id="" name="personincharge" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="project_list_id" class="col-sm-4">Contact number: </label>
                      <div class="col-sm-8">
                        <input class="form-control" id="" name="contactnumber" required>
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
                              <input type="checkbox" id="" name="pat"><label style="margin-top: 7px;margin-left: 3px;"> PAT </label>
                            </div>
                        </div>
                      </div>
                      <div class="col-xs-4">
                        <div class="form-group">
                            <div style="display: flex;">
                              <input type="checkbox" id="" name="emcroom"><label style="margin-top: 7px;margin-left: 3px;"> EMC ROOM </label>
                            </div>
                        </div>
                      </div>
                      <div class="col-xs-4">
                        <div class="form-group">
                            <div style="display: flex;">
                              <input type="checkbox" id="" name="tvroom"><label style="margin-top: 7px;margin-left: 3px;"> TVROOM </label>
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
                              <input type="checkbox" id="" name="institutional"><label style="margin-top: 7px;margin-left: 3px;"> Institutional </label>
                            </div>
                        </div>
                      </div>
                      <div class="col-xs-4">
                        <div class="form-group" style="margin-bottom: unset;">
                            <div style="display: flex;">
                              <input type="checkbox" id="" name="curricular"><label style="margin-top: 7px;margin-left: 3px;"> Curricular </label>
                            </div>
                        </div>
                      </div>
                      <div class="col-xs-4">
                        <div class="form-group" style="margin-bottom: unset;">
                            <div style="display: flex;">
                              <input type="checkbox" id="" name="outsidegroup"><label style="margin-top: 7px;margin-left: 3px;"> Outside Group </label>
                            </div>
                        </div>
                      </div>
                      <div class="col-xs-4">
                        <div class="form-group" style="margin-bottom: unset;">
                            <div style="display: flex;">
                              <input type="checkbox" id="" name="cocurricular"><label style="margin-top: 7px;margin-left: 3px;"> Co-Curricular </label>
                            </div>
                        </div>
                      </div>
                      <div class="col-xs-4">
                        <div class="form-group">
                            <div style="display: flex;">
                              <input type="checkbox" id="" name="extracurricular"><label style="margin-top: 7px;margin-left: 3px;"> Extra Curricular </label>
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
                    <div>
                 
                      <div>
                        <input type="file" name="file" id="fileInput" style="display: none;">
                        <label for="fileInput" id="fileInputLabel" class="btn btn-flat" style="width: 120px;background-color: #363636;color: #fff;font-weight: bold;">ATTACH</label>
                        <label id="fileName" style="color: #1136e9;"></label>
                      </div>
                    </div>
                    <br>
                    <div><button type="submit" name="add" class="btn btn-flat" style="width: 120px;background-color: #363636;color: #fff;font-weight: bold;">SAVE</button></div>

                    <br>
                    <div><a href="facility_form.php" class="btn btn-flat" style="width: 120px;background-color: #363636;color: #fff;font-weight: bold;">DELETE FORM</a></div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>


</div>
<!-- ./wrapper -->

<?php include 'footer.php'; ?>

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
        $(document).ready(function() {
            // When a file is selected, update the label and show the file name
            $('#fileInput').change(function() {
                const fileName = $(this).val().split('\\').pop();
                $('#fileName').text(fileName);
            });
        });
    </script>

</body>
</html>
     <?php
                      }
                        
                  }

                    $data = new data();
                    $data->managedata();
                              
                  ?>
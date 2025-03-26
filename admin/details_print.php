<?php session_start(); ?>

<?php
  include '../config/config.php';
  class data extends Connection{ 
      public function managedata(){ 

?>
<!DOCTYPE html>
<html>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="padding-bottom: 50px;">

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
                <h2 style="text-align: center;">Document Details</h2>
              </div>
              <div class="box-body">
                <form class="form-horizontal" method="POST" action="../controller/facility_formController.php" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-4 col-md-12">
                      <div style="display: flex;width: 100%;justify-content: space-between;">
                        <div class="form-group">
                          <strong for="project_list_id" class="col-sm-4">Department: </strong>
                            <?php echo $row['department'] ?>
                        </div>
                        <div class="form-group">
                          <strong for="project_list_id" class="col-sm-4">Activity/Purpose: </strong>
                            <?php echo $row['activityorpurpose'] ?>
                        </div>
                      </div>
                      <br>
                      <div style="display: flex;width: 100%;justify-content: space-between;">
                        <div class="form-group">
                          <strong for="project_list_id" class="col-sm-4">Division: </strong>
                            <?php echo $row['division'] ?>
                        </div>
                        <div class="form-group">
                          <strong for="project_list_id" class="col-sm-4">Number of attendees: </strong>
                            <?php echo $row['numberofattendees'] ?>
                        </div>
                      </div>

                      <br>
                      <div style="display: flex;width: 100%;justify-content: space-between;">
                        <div class="form-group">
                          <strong for="project_list_id" class="col-sm-4">Date filled: </strong>
                            <?php echo $row['datefilled'] ?>
                        </div>
                        <div class="form-group">
                          <strong for="project_list_id" class="col-sm-4">Time Needed: </strong>
                              <?php echo $row['timeneeded'] ?>
                        </div>
                      </div>

                      <br>
                      <div style="display: flex;width: 100%;justify-content: space-between;">
                        <div class="form-group">
                          <strong for="project_list_id" class="col-sm-4">Date Needed: </strong>
                            <?php echo $row['dateneeded'] ?>
                        </div>
                        <div class="form-group">
                          <strong for="project_list_id" class="col-sm-4">Person in-charge: </strong>
                            <?php echo $row['personincharge'] ?>
                        </div>
                        <div class="form-group">
                          <strong for="project_list_id" class="col-sm-4">Contact number: </strong>
                            <?php echo $row['contactnumber'] ?>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="col-lg-8 col-md-12">
                      <div class="row">
                        <h4 style="font-weight: bold;">SERVICES TO BE PROVIDED:</h4>
                      </div>

                      <div style="display: flex;width: 100%;justify-content: space-between;">
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
                      <div style="display: flex;width: 100%;justify-content: space-between;">
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
                      <br>
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
                        <br>
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
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>

  </div>

</div>

<script>
  window.print()
</script>


</body>
</html>
<?php  } } $data = new data();  $data->managedata(); ?>
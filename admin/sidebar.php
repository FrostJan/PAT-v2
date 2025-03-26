<style>
  .main-sidebar a{
  color:white !important;
}
</style>
<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li style="text-align: center;padding: 20px;display: flex;place-items: center;"><img src="../images/logo.png" width="60px"> <div style="text-align: left;font-size: 15px;font-weight: bold;color: #fff;padding-left: 5px;">PERFORMING<br>ARTS THEATER</div></li>

      <li><a href="dashboard.php"><i class="fas fa-calendar"></i> <span>CALENDAR</span></a></li>
      <?php if($_SESSION['type'] == 0): ?>
        <li><a href="document_history.php"><i class="fas fa-book"></i> <span>DOCUMENT HISTORY</span></a></li>
        <li><a href="log.php"><i class="fas fa-chart-bar"></i> <span>LOG</span></a></li>
        <li><a href="summary.php"><i class="fas fa-bar-chart"></i> <span>Summary Statistics</span></a></li>
        <li><a href="activityorpurpose.php"><i class="fas fa-list"></i> <span>Activity Purpose</span></a></li>
      <?php endif; ?>

      <?php if($_SESSION['type'] == 1): ?>
        <li><a href="approval.php"><i class="fas fa-check-circle"></i> <span>APPROVAL</span></a></li>
        <li><a href="summary.php"><i class="fas fa-bar-chart"></i> <span>Summary Statistics</span></a></li>
        <li><a href="facility_form.php"><i class="fas fa-book"></i> <span>FACILITY FORM</span></a></li>
      <?php endif; ?>

      <?php if($_SESSION['type'] == 2): ?>
        <li><a href="facility_form.php"><i class="fas fa-book"></i> <span>FACILITY FORM</span></a></li>
        <li><a href="request_status.php"><i class="fas fa-clipboard-check"></i> <span>REQUEST STATUS</span></a></li>
      <?php endif; ?>

    </ul>
    <ul class="profile-bottom" style="padding: 5px 10px;">
      <ul class="profile-bottom-wrapper">
        <li style="list-style: none;display: flex;color: #fff;place-items: center;" class="user-header">
          <?php
                  $sql = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
          $stmt = $this->conn()->query($sql);
          $row = $stmt->fetch();
                ?>
           <a href="#profile" data-toggle="modal" id="admin_profile" data-user_id="<?php echo $_SESSION['id'] ?>" data-firstname="<?php echo $row['firstname'] ?>" data-email="<?php echo $row['email'] ?>" data-password="<?php echo $row['passwordtxt'] ?>">
          <img src="../images/<?php echo $row['img'] ?>" class="img-circle" alt="User Image" style="width: 40px;height: 40px;">
          </a>
          <div style="margin-left: 10px;">
            <div><b><?php echo $row['firstname'] ?></b></div>
            <div style="margin-top: -5px;"><small>@<?php echo str_replace('@gmail.com', '', $row['email']); ?></small></div>
          </div>
        </li>
        <li style="list-style: none;text-align: right;" class="user-footer">
          <div>
            <a href="../logout.php" class="btn btn-flat btn-sm" style="background-color: #c0c0c0;color: red;padding: 1px 10px;border-radius: 5px;">Sign out</a>
          </div>
        </li>
      </ul>
    </ul>
  </section>
</aside>
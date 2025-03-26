<?php session_start(); ?>

<?php
  include_once '../config/config.php'; // Use include_once to prevent multiple inclusions
  class data extends Connection { 
      public function managedata() { 
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
          <h4>Status: <?php echo $_GET['status']; ?></h4>
          <h4>Date: 
            <?php
              $year = isset($_GET['year']) ? $_GET['year'] : 'all';
              $month = isset($_GET['month']) ? $_GET['month'] : 'all';

              if ($year === 'all' && $month === 'all') {
                  echo "All";
              } elseif ($month === 'all') {
                  echo "Year: $year";
              } else {
                  $monthName = date('F', mktime(0, 0, 0, (int)$month, 1));
                  echo "$monthName $year";
              }
            ?>
          </h4>
        </div>
        <div class="box">
          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered">
              <thead>
                <th>Event</th>
                <th>File</th>
                <th>Status</th>
                <th>Date</th>
              </thead>
              <tbody>
                <?php
                  $status = $_GET['status'];
                  $all = isset($_GET['all']) ? $_GET['all'] : 0;
                  $year = isset($_GET['year']) ? $_GET['year'] : null;
                  $month = isset($_GET['month']) ? $_GET['month'] : null;

                  $conn = new Connection();
                  $pdo = $conn->conn();

                  // Build the query dynamically
                  $conditions = ["status = ?"];
                  $params = [$status];

                  if ($all != 1) {
                      if (!empty($year) && $year !== 'all') {
                          $conditions[] = "YEAR(datefilled) = ?"; 
                          $params[] = $year;
                      }

                      if (!empty($month) && $month !== 'all') {
                          $conditions[] = "MONTH(datefilled) = ?";
                          $params[] = $month;
                      }
                  }

                  $whereClause = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';
                  $sql = "SELECT * FROM request $whereClause";
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute($params);

                  // Display the filtered data
                  while ($row = $stmt->fetch()) {
                      echo "<tr>";
                      echo "<td><b>Event:</b> " . $row['department'] . "</td>";
                      echo "<td><b>File:</b> <a href='../file/" . $row['file'] . "'>" . $row['file'] . "</a></td>";
                      echo "<td><b>Status:</b> " . $row['status'] . "</td>";
                      echo "<td><b>Date:</b> " . $row['dateneeded'] . "</td>";
                      echo "</tr>";
                  }
                ?>
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
  $(function () {
    $('#example1').DataTable({
      responsive: true
    });
  });
</script>

</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>
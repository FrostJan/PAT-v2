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
  .month-btn{
    padding: 15px 30px;
    margin: 20px;
  }

  #piechart{
    height: 505px !important;
  }

</style>
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
        Summary Statistics
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Summary Statistics</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                  <div class="card text-center">
                    <div>
                      <h2>Approved / Declined</h2>
                      <select class="btn" id="approvedordeclinedyear" style="border: 1px solid rgba(0, 0, 0, 0.3);">
                        <option value="">Select Year</option>
                        <?php
                          $currentYear = date("Y");
                          for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
                              echo "<option value='$year'>$year</option>";
                          }
                        ?>
                      </select>
                      <select class="btn" id="approvedordeclinedmonth" style="border: 1px solid rgba(0, 0, 0, 0.3);">
                        <option value="">Select Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                      </select>
                      <button class="btn btn-primary" id="fetchAll" style="margin-left: 10px;" onclick="location.reload();">All</button>
                    </div>
                    <canvas id="approveddeclined" width="600" height="320"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                  <h2 class="text-center">Monthly Event</h2>
                  <div class="card text-center">
                    <a href="summary_table2.php?month=1" class="btn btn-success month-btn">January</a>
                    <a href="summary_table2.php?month=2" class="btn btn-success month-btn">February</a>
                    <a href="summary_table2.php?month=3" class="btn btn-success month-btn">March</a>
                    <a href="summary_table2.php?month=4" class="btn btn-success month-btn">April</a>
                    <a href="summary_table2.php?month=5" class="btn btn-success month-btn">May</a>
                    <a href="summary_table2.php?month=6" class="btn btn-success month-btn">June</a>
                    <a href="summary_table2.php?month=7" class="btn btn-success month-btn">July</a>
                    <a href="summary_table2.php?month=8" class="btn btn-success month-btn">August</a>
                    <a href="summary_table2.php?month=9" class="btn btn-success month-btn">September</a>
                    <a href="summary_table2.php?month=10" class="btn btn-success month-btn">October</a>
                    <a href="summary_table2.php?month=11" class="btn btn-success month-btn">November</a>
                    <a href="summary_table2.php?month=12" class="btn btn-success month-btn">December</a>
                  </div>
                  <br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xs-12">
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                  <div class="card text-center">
                    <div>
                      <h2>Acitivity Purpose</h2>
                    </div>
                    <div style="text-align: center;justify-content: center;display: flex;">
                      <canvas id="piechart"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                  <div class="card text-center">
                    <div>
                      <h2>Services And Classification of Activity</h2>
                      <select class="btn" id="selectservicesandclassification" style="border: 1px solid rgba(0, 0, 0, 0.3);">
                        <option value="0">Select</option>
                        <option value="1">Services</option>
                        <option value="2">Classification of Activity</option>
                      </select>
                    </div>
                    <canvas id="servicesandclassification" height="90"></canvas>
                  </div>
                </div>
              </div>
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
    $('#deleteModal').modal('show');
    delete_id = $(this).data('delete_id')
    $('#delete_id').val(delete_id)
  })

  $('.createevent').click(function(){
    $('#event_entry_modal').modal('show');
    request_id = $(this).data('request_id')
    users_id = $(this).data('users_id')

    $('#request_id').val(request_id)
    $('#users_id').val(users_id)
  })
</script>

<!-- Active Script -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

   <?php
    $sql = "SELECT COUNT(id) AS declined FROM request WHERE status = 'Declined'";
    $stmt = $this->conn()->query($sql);
    $row = $stmt->fetch();
    $declined = $row['declined'];

    $sql = "SELECT COUNT(id) AS approved FROM request WHERE status = 'Approved'";
    $stmt = $this->conn()->query($sql);
    $row = $stmt->fetch();
    $approved = $row['approved'];

?>


<script>

let approveddeclined = document.getElementById('approveddeclined').getContext('2d');

var MonthlyChart = new Chart(approveddeclined, {

    type: 'bar',

    data: {

        labels: ['Approved','Declined'],

        datasets: [
            {
                data: [<?php echo $approved.",".$declined; ?>],
                backgroundColor: ['#4CAF50', '#F44336']
            },


        ]

    },
    options: {
        scales: {
            y: {
                ticks: {
                    stepSize: 1,
                },
            },
        },
        plugins: {
            legend: {
                display: false
            },

            datalabels: {
                formatter: (value, context) => {
                    return Math.round(value).toLocaleString(); // Convert to whole numbers and use locale string for formatting
                },
                color: '#fff',
                backgroundColor: (context) => {
                    return context.dataset.backgroundColor[context.dataIndex];
                },
                borderRadius: 4,
                font: {
                    weight: 'bold'
                },
                padding: 6
            },
        },

           
        onClick: function(event, elements) {
    var approvedordeclinedyear = $('#approvedordeclinedyear').val();
    var approvedordeclinedmonth = $('#approvedordeclinedmonth').val();

    if (elements.length > 0) {
        var index = elements[0].index;
        var label = this.data.labels[index];

        if (label === 'Approved') {
            if (approvedordeclinedyear === 'all' || approvedordeclinedyear === '' || approvedordeclinedmonth === 'all' || approvedordeclinedmonth === '') {
                // Redirect to "All" case for Approved
                window.location.href = 'summary_table.php?status=Approved&all=1';
            } else {
                // Redirect with year and month for Approved
                window.location.href = 'summary_table.php?status=Approved&year=' + approvedordeclinedyear + '&month=' + approvedordeclinedmonth;
            }
        } else if (label === 'Declined') {
            if (approvedordeclinedyear === 'all' || approvedordeclinedyear === '' || approvedordeclinedmonth === 'all' || approvedordeclinedmonth === '') {
                // Redirect to "All" case for Declined
                window.location.href = 'summary_table.php?status=Declined&all=1';
            } else {
                // Redirect with year and month for Declined
                window.location.href = 'summary_table.php?status=Declined&year=' + approvedordeclinedyear + '&month=' + approvedordeclinedmonth;
            }
        }
    }
},

    },
    plugins: [ChartDataLabels] 
});

</script>

<script>
  $(document).ready(function () {
    // Event listener for year and month selection
    $('#approvedordeclinedyear, #approvedordeclinedmonth').change(function () {
      const year = $('#approvedordeclinedyear').val();
      const month = $('#approvedordeclinedmonth').val();

      if (year && month) {
        fetchData(year, month);
      }
    });

    // Event listener for "All" button
    $('#fetchAll').click(function () {
        // Reset the dropdown values to "all"
        $('#approvedordeclinedyear').val('all');
        $('#approvedordeclinedmonth').val('all');

        // Fetch data for "All"
        fetchData('all', 'all');
    });

    // Function to fetch data
    function fetchData(year, month) {
      $.ajax({
        url: 'fetch_approved_declined.php',
        method: 'POST',
        data: { year: year, month: month },
        success: function (response) {
          const data = JSON.parse(response);

          // Update the chart with new data
          MonthlyChart.data.datasets[0].data = [data.approved, data.declined];
          MonthlyChart.update();
        },
        error: function (xhr, status, error) {
          console.error('Error fetching data:', error);
        },
      });
    }
  });
</script>

<?php
    // Array to store the counts of each activity purpose
    $activityCounts = [];
    $totalActivities = 0;
    $urls = [];

    // Get the list of all activity purposes
    $sql = "SELECT name FROM activitypurpose";
    $stmt = $this->conn()->query($sql);
    while($row = $stmt->fetch()){
        $activitypurpose = $row['name'];

        // Get the count of each activity purpose
        $sql2 = "SELECT COUNT(id) AS total FROM request WHERE activityorpurpose = '".$activitypurpose."'";
        $stmt2 = $this->conn()->query($sql2);
        $row2 = $stmt2->fetch();

        // Store the count in the array
        $activityCounts[$activitypurpose] = $row2['total'];
        // Add to the total count of all activities
        $totalActivities += $row2['total'];

        // Construct the URL for each activity purpose
        $urls[$activitypurpose] = 'summary_table3.php?activitypurpose=' . urlencode($activitypurpose);
    }

    // Calculate percentages
    $percentages = [];
    foreach($activityCounts as $activity => $count) {
        $percentages[$activity] = ($count / $totalActivities) * 100;
    }
?>



<script>
let activityData = {
    labels: <?php echo json_encode(array_keys($percentages)); ?>,
    datasets: [{
        data: <?php echo json_encode(array_values($percentages)); ?>,
        backgroundColor: ['#4CAF50', '#F44336', '#FFC107', '#2196F3', '#9C27B0', '#FF9800'] // Add more colors if necessary
    }]
};

// Define the URLs for each segment
let urls = <?php echo json_encode($urls); ?>;

let activityChartCtx = document.getElementById('piechart').getContext('2d');

var activityChart = new Chart(activityChartCtx, {
    type: 'pie',
    data: activityData,
    options: {
        plugins: {
            legend: {
                display: true
            },
            datalabels: {
                formatter: (value, context) => {
                    return value.toFixed() + '%'; // Display percentage with two decimal places
                },
                color: '#fff',
                backgroundColor: (context) => {
                    return context.dataset.backgroundColor[context.dataIndex];
                },
                borderRadius: 4,
                font: {
                    weight: 'bold'
                },
                padding: 6
            }
        },
        onClick: (event, elements) => {
            if (elements.length > 0) {
                // Get the index of the clicked segment
                let index = elements[0].index;
                // Get the label of the clicked segment
                let label = activityChart.data.labels[index];
                // Get the URL for the clicked segment
                let url = urls[label];
                // Redirect to the URL
                window.location.href = url;
            }
        }
    },
    plugins: [ChartDataLabels] // Register the data labels plugin
});
</script>




  <?php
    // First data line chart
    $sql = "SELECT COUNT(pat) AS totalpat FROM request WHERE pat = 'yes'";
    $stmt = $this->conn()->query($sql);
    $row = $stmt->fetch();
    $totalpat = $row['totalpat'];

    $sql = "SELECT COUNT(emcroom) AS totalemcroom FROM request WHERE emcroom = 'yes'";
    $stmt = $this->conn()->query($sql);
    $row = $stmt->fetch();
    $totalemcroom = $row['totalemcroom'];

    $sql = "SELECT COUNT(tvroom) AS totaltvroom FROM request WHERE tvroom = 'yes'";
    $stmt = $this->conn()->query($sql);
    $row = $stmt->fetch();
    $totaltvroom = $row['totaltvroom'];



    // Second data line chart
    $sql = "SELECT COUNT(institutional) AS totalinstitutional FROM request WHERE institutional = 'yes'";
    $stmt = $this->conn()->query($sql);
    $row = $stmt->fetch();
    $totalinstitutional = $row['totalinstitutional'];

    $sql = "SELECT COUNT(cocurricular) AS totalcocurricular FROM request WHERE cocurricular = 'yes'";
    $stmt = $this->conn()->query($sql);
    $row = $stmt->fetch();
    $totalcocurricular = $row['totalcocurricular'];

    $sql = "SELECT COUNT(curricular) AS totalcurricular FROM request WHERE curricular = 'yes'";
    $stmt = $this->conn()->query($sql);
    $row = $stmt->fetch();
    $totalcurricular = $row['totalcurricular'];

    $sql = "SELECT COUNT(extracurricular) AS totalextracurricular FROM request WHERE extracurricular = 'yes'";
    $stmt = $this->conn()->query($sql);
    $row = $stmt->fetch();
    $totalextracurricular = $row['totalextracurricular'];

    $sql = "SELECT COUNT(outsidegroup) AS totaloutsidegroup FROM request WHERE outsidegroup = 'yes'";
    $stmt = $this->conn()->query($sql);
    $row = $stmt->fetch();
    $totaloutsidegroup = $row['totaloutsidegroup'];
  ?>
<script>
    let servicesandclassification = document.getElementById('servicesandclassification').getContext('2d');

    var staticData = {
        labels: ['Institutional','Co-Curricular','Curricular','Extra-Curricular','Outside Group'],
        datasets: [
            {
                label: 'Static Data',
                data: [<?php echo $totalinstitutional . "," . $totalcocurricular . "," . $totalcurricular . "," . $totalextracurricular . "," . $totaloutsidegroup; ?>],
                borderColor: '#4CAF50',
                backgroundColor: 'rgba(76, 175, 80, 0.2)',
                fill: false
            }
        ]
    };

    var dynamicData = {
        labels: ['Pat', 'EMC Room', 'TV Room'],
        datasets: [
            {
                label: 'Dynamic Data',
                data: [<?php echo $totalpat . "," . $totalemcroom . "," . $totaltvroom; ?>],
                borderColor: '#F44336',
                backgroundColor: 'rgba(244, 67, 54, 0.2)',
                fill: false
            }
        ]
    };

    var MonthlyChart2 = new Chart(servicesandclassification, {
        type: 'line',
        data: staticData,
        options: {
            scales: {
                y: {
                    ticks: {
                        stepSize: 1,
                    },
                },
            },
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    formatter: (value, context) => {
                        return Math.round(value).toLocaleString();
                    },
                    color: '#fff',
                    backgroundColor: (context) => {
                        return context.dataset.backgroundColor;
                    },
                    borderRadius: 4,
                    font: {
                        weight: 'bold'
                    },
                    padding: 6
                },
            },
onClick: (event, elements) => {
                if (elements.length > 0) {
                    var index = elements[0].index;
                    var label = MonthlyChart2.data.labels[index];
                    if (label === 'Institutional') {
                        window.location.href = 'summary_table4.php?label=institutional';
                    } else if (label === 'Co-Curricular') {
                        window.location.href = 'summary_table4.php?label=cocurricular';
                    } else if (label === 'Curricular') {
                        window.location.href = 'summary_table4.php?label=curricular';
                    } else if (label === 'Extra-Curricular') {
                        window.location.href = 'summary_table4.php?label=extracurricular';
                    } else if (label === 'Outside Group') {
                        window.location.href = 'summary_table4.php?label=outsidegroup';
                    } else if (label === 'Pat') {
                        window.location.href = 'summary_table4.php?label=pat';
                    } else if (label === 'EMC Room') {
                        window.location.href = 'summary_table4.php?label=emcroom';
                    } else if (label === 'TV Room') {
                        window.location.href = 'summary_table4.php?label=tvroom';
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });


    document.getElementById('selectservicesandclassification').addEventListener('change', function() {
        var selectedValue = this.value;
        if (selectedValue == 1) {
            MonthlyChart2.data = staticData;
        } else if (selectedValue == 2) {
            MonthlyChart2.data = dynamicData;
        }
        MonthlyChart2.update();
    });

</script>

</body>
</html>
<?php  } } $data = new data();  $data->managedata(); ?>



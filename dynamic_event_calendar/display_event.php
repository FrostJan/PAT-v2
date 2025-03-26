<?php
	session_start();
  include '../config/config.php';
  class data extends Connection{ 
      public function managedata(){ 


$users_id = $_SESSION['id'];
$type = $_SESSION['type'];

if ($type == 2) {
	$sql = "SELECT event_id,request_id,users_id,event_name,event_start_date,event_end_date FROM calendar WHERE users_id = '$users_id'";
} else {
	$sql = "SELECT event_id,request_id,users_id,event_name,event_start_date,event_end_date FROM calendar";
}

$stmt = $this->conn()->query($sql);
$stmt->execute([]);
 
if($stmt->rowcount() > 0) 
{
	$data_arr=array();
    $i=1;
	while($row = $stmt->fetch())
	{	
	$data_arr[$i]['event_id'] = $row['event_id'];
	$data_arr[$i]['request_id'] = $row['request_id'];
	$data_arr[$i]['users_id'] = $row['users_id'];
	$data_arr[$i]['title'] = $row['event_name'];
	$data_arr[$i]['start'] = date("Y-m-d", strtotime($row['event_start_date']));
	$data_arr[$i]['end'] = date("Y-m-d", strtotime($row['event_end_date']));
	$data_arr[$i]['color'] = '#'.substr(uniqid(),-6); // 'green'; pass colour name
	$i++;
	}
	
	$data = array(
                'status' => true,
                'msg' => 'successfully!',
				'data' => $data_arr
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Error!'				
            );
}
echo json_encode($data);
?>

<?php } }

  $data = new data();
  $data->managedata();
            
?>
<?php
    include '../config/config.php';

    class controller extends Connection{

        public function managcontroller(){

            if (isset($_POST['add'])) {
                
                $request_id = $_POST['request_id'];
                $users_id = $_POST['users_id'];
                $event_name = $_POST['event_name'];
                $event_start_date = $_POST['event_start_date'];
                $event_end_date = $_POST['event_end_date'];

                $sqlinsert = "INSERT INTO calendar (request_id,users_id,event_name,event_start_date,event_end_date) VALUES (?,?,?,?,?)";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([$request_id,$users_id,$event_name,$event_start_date,$event_end_date]);

                echo "<script type='text/javascript'>alert('Succesfully Add Event');</script>";
                echo "<script>window.location.href='../admin/dashboard.php';</script>";
            }

            if (isset($_POST['delete'])) {
                
                $event_id = $_POST['event_id'];

                $sqlinsert = "DELETE FROM calendar WHERE event_id = ?";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([$event_id]);

                echo "<script type='text/javascript'>alert('Succesfully Delete Event');</script>";
                echo "<script>window.location.href='../admin/dashboard.php';</script>";
            }
            

            
        }
    }
    $controllerrun = new controller();
    $controllerrun->managcontroller();
?>

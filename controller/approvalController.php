<?php
    
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['save'])) {

                $request_id = $_POST['request_id'];
                $status = $_POST['status'];
                
                $sql = "UPDATE request SET status = ? WHERE id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$status,$request_id]);

                echo "<script type='text/javascript'>alert('Successfully Change Status');</script>";
                echo "<script>window.location.href='../admin/approval.php';</script>";
                
            }

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>

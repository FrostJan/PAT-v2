<?php
    include '../config/config.php';

    class controller extends Connection{

        public function managcontroller(){

            if (isset($_POST['delete'])) {
                
                $id = $_POST['id'];

                $query = "SELECT * FROM request WHERE id = '".$id."'";
                $stmt = $this->conn()->query($query);
                $row = $stmt->fetch();
                $users_id = $row['users_id'];

                $sql = "DELETE FROM calendar WHERE request_id = ? AND users_id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$id,$users_id]);


                $sql = "DELETE FROM request WHERE id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$id]);

                echo "<script type='text/javascript'>alert('Succesfully Delete Data');</script>";
                echo "<script>window.location.href='../admin/log.php';</script>";
            }
            

            
        }
    }
    $controllerrun = new controller();
    $controllerrun->managcontroller();
?>

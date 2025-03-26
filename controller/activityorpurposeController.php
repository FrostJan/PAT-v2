<?php
    include '../config/config.php';

    class controller extends Connection{

        public function managcontroller(){

            if (isset($_POST['add'])) {
                
                $name = $_POST['name'];

                $query = "SELECT * FROM activitypurpose WHERE name = ?";
                $stmt = $this->conn()->prepare($query);
                $stmt->execute([$name]);

                if ($stmt->rowcount() > 0) {
                    echo "<script type='text/javascript'>alert('Already Exist Activity Purpose');</script>";
                } else {
                    $sqlinsert = "INSERT INTO activitypurpose (name) VALUES (?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$name]);
                    echo "<script type='text/javascript'>alert('Succesfully Add Activity Purpose');</script>";
                }

                echo "<script>window.location.href='../admin/activityorpurpose.php';</script>";
            }

            if (isset($_POST['edit'])) {
                
                $id = $_POST['id'];
                $name = $_POST['name'];

                $sqlinsert = "UPDATE activitypurpose SET name = ? WHERE id = ?";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([$name,$id]);
                echo "<script type='text/javascript'>alert('Succesfully Update Activity Purpose');</script>";

                echo "<script>window.location.href='../admin/activityorpurpose.php';</script>";
            }

            if (isset($_POST['delete'])) {
                
                $id = $_POST['id'];

                $sqlinsert = "DELETE FROM activitypurpose WHERE id = ?";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([$id]);

                echo "<script type='text/javascript'>alert('Succesfully Delete Activity Purpose');</script>";
                echo "<script>window.location.href='../admin/activityorpurpose.php';</script>";
            }
            

            
        }
    }
    $controllerrun = new controller();
    $controllerrun->managcontroller();
?>

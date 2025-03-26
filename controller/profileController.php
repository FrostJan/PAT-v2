<?php
    
    include '../config/config.php';
    session_start();
    class users extends Connection{

        public function manageusers(){

            if (isset($_POST['saveadmin'])) {

                $user_id = $_POST['user_id'];
                $firstname = $_POST['firstname'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $img = $_FILES['img']['name'];
                move_uploaded_file($_FILES['img']['tmp_name'], "../images/".$img);
                
                if ($img == '') {
                    $sqlinsert = "UPDATE users SET firstname = ?, email = ?,password = ?, passwordtxt = ? WHERE id = '".$user_id."'";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$firstname,$email,$password,$_POST['password']]);
               
                    echo "<script type='text/javascript'>alert('Successfully Edit Profile');</script>";
                    echo "<script>window.location.href='../admin/dashboard.php';</script>";
                } else {

                    $sqlinsert = "UPDATE users SET img = ?, firstname = ?,email = ?,password = ?, passwordtxt = ? WHERE id = '".$user_id."'";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$img,$firstname,$email,$password,$_POST['password']]);
               
                    
                }

                if ($_SESSION['type'] == 0) {
                    echo "<script type='text/javascript'>alert('Successfully Edit Profile');</script>";
                    echo "<script>window.location.href='../admin/dashboard.php';</script>";
                }else{
                    echo "<script type='text/javascript'>alert('Successfully Edit Profile');</script>";
                    echo "<script>window.location.href='../admin/dashboard.php';</script>";
                }

                    
                
            }

        }

    }

    $usersrun = new users();
    $usersrun->manageusers();

?>

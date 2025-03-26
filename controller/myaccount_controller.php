<?php
    include '../gmail.php';
    include '../config/config.php';

    class add extends Connection{

        public function managadd(){

            $user_email_address = $_SESSION['user_email_address'];
            $user_first_name = $_POST['user_first_name'];
            $user_last_name = $_POST['user_last_name'];
            $user_contact = $_POST['user_contact'];
            $user_address = $_POST['user_address'];
            $user_email_address = $_POST['user_email_address'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $passwordtxt = $_POST['password'];


            $img = $_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], "../images/".$img);

            if ($img == '') {

                $sqlinsert = "UPDATE users SET user_first_name = ?, user_last_name = ?, user_email_address = ?, password = ?, passwordtxt = ?, user_contact = ?, user_address = ? WHERE user_email_address = '".$user_email_address."'";
            $statementinsert = $this->conn()->prepare($sqlinsert);
            $statementinsert->execute([$user_first_name,$user_last_name,$user_email_address,$password,$passwordtxt,$user_contact,$user_address]);

            } else {

                $sqlinsert = "UPDATE users SET img = ?, user_first_name = ?, user_last_name = ?, user_email_address = ?, password = ?, passwordtxt = ?, user_contact = ?, user_address = ? WHERE user_email_address = '".$user_email_address."'";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([$img,$user_first_name,$user_last_name,$user_email_address,$password,$passwordtxt,$user_contact,$user_address]);

            }

            

            echo "<script type='text/javascript'>alert('Succesfully Update Profile');</script>";
            echo "<script>window.location.href='../users/my_account.php';</script>";

            
        }
    }
    $addrun = new add();
    $addrun->managadd();
?>

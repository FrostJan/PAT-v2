<?php
  
  include '../config/config.php';
  session_start();
  
  class login extends Connection{
  
    public function loginuser(){ 

      if (isset($_POST['signin'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sqlselect_users = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn()->prepare($sqlselect_users);
        $stmt->execute([$email]);

        if ($stmt->rowcount() > 0) {

          $row = $stmt->fetch();

          if (password_verify($password, $row['password'])) {

            header('location:../admin/dashboard.php');
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_first_name'] = $row['user_first_name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['type'] = $row['type'];
      
          } else {

              echo "<script type='text/javascript'>alert('Invalid Email And Password');</script>";
              echo "<script>window.location.href='../login.php';</script>";
  
          }

        } else {

            echo "<script type='text/javascript'>alert('Invalid Email And Password');</script>";
            echo "<script>window.location.href='../login.php';</script>";

        } 
       
      } 
         
    }

  }

  $loginrun = new login();
  $loginrun->loginuser();

?>




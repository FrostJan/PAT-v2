<?php
    
    include '../config/config.php';

    class products extends Connection{

        public function manageproducts(){

            $customers_code = $_GET['customers_code'];
            $users_id = $_GET['users_id'];
            $label = $_GET['label'];
            if (isset($_GET['status'])) {

            $customers_orders_id = $_GET['customers_orders_id'];

            $sql = "SELECT * FROM customers_info WHERE customers_code = '".$customers_code."'";
            $stmt = $this->conn()->query($sql);
            $row2 = $stmt->fetch();
            $payment_method = $row2['payment_method'];
            
            $sql = "SELECT * FROM orders WHERE customers_orders_id = '".$customers_orders_id."'";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();
            $amount = $row2['total'] + $row2['shipping_fee'];

            if ($payment_method == 'Cash On Delivery') {
                if ($_GET['status'] == 'confirmed') {
                    $sqlinsert = "UPDATE orders SET status = 1  WHERE customers_orders_id = '".$customers_orders_id."'";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([]);


                $sql = "SELECT * FROM trackingstatus WHERE customers_orders_id = '".$customers_orders_id."' AND status = 1";
                $stmt = $this->conn()->query($sql);
                if ($stmt->rowcount() > 0) {

                } else {
                    $sqlinsert = "INSERT INTO trackingstatus (customers_orders_id,status) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$customers_orders_id,1]);

                    $description = "Your Orders Has Been Confirmed";

                    $sqlinsert = "INSERT INTO activitylogs (seller_id,description) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$users_id,$description]);
                }

                } else if ($_GET['status'] == 'processing') {
                    $sqlinsert = "UPDATE orders SET status = 2  WHERE customers_orders_id = '".$customers_orders_id."'";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([]);

                $sql = "SELECT * FROM trackingstatus WHERE customers_orders_id = '".$customers_orders_id."' AND status = 2";
                $stmt = $this->conn()->query($sql);
                if ($stmt->rowcount() > 0) {

                } else {
                    $sqlinsert = "INSERT INTO trackingstatus (customers_orders_id,status) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$customers_orders_id,2]);

                    $description = "Your Orders Has Been Processing";

                    $sqlinsert = "INSERT INTO activitylogs (seller_id,description) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$users_id,$description]);
                }

                } else if ($_GET['status'] == 'quality') {
                    $sqlinsert = "UPDATE orders SET status = 3  WHERE customers_orders_id = '".$customers_orders_id."'";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([]);

                $sql = "SELECT * FROM trackingstatus WHERE customers_orders_id = '".$customers_orders_id."' AND status = 3";
                $stmt = $this->conn()->query($sql);
                if ($stmt->rowcount() > 0) {

                } else {
                    $sqlinsert = "INSERT INTO trackingstatus (customers_orders_id,status) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$customers_orders_id,3]);

                    $description = "Your Orders Has Been Quality Check";

                    $sqlinsert = "INSERT INTO activitylogs (seller_id,description) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$users_id,$description]);
                }

                } else if ($_GET['status'] == 'dispatched') {
                    $sqlinsert = "UPDATE orders SET status = 4  WHERE customers_orders_id = '".$customers_orders_id."'";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([]);

                $sql = "SELECT * FROM trackingstatus WHERE customers_orders_id = '".$customers_orders_id."' AND status = 4";
                $stmt = $this->conn()->query($sql);
                if ($stmt->rowcount() > 0) {

                } else {
                    $sqlinsert = "INSERT INTO trackingstatus (customers_orders_id,status) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$customers_orders_id,4]);

                    $description = "Your Orders Has Been Dispatched";

                    $sqlinsert = "INSERT INTO activitylogs (seller_id,description) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$users_id,$description]);
                }

                } else if ($_GET['status'] == 'delivered') {
                    $sqlinsert = "UPDATE orders SET status = 5  WHERE customers_orders_id = '".$customers_orders_id."'";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([]);

                $sqlinsert = "UPDATE payments SET amount = ?  WHERE customers_code = '".$customers_code."'";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([$amount]);

                $sql = "SELECT * FROM trackingstatus WHERE customers_orders_id = '".$customers_orders_id."' AND status = 5";
                $stmt = $this->conn()->query($sql);
                if ($stmt->rowcount() > 0) {

                } else {
                    $sqlinsert = "INSERT INTO trackingstatus (customers_orders_id,status) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$customers_orders_id,5]);

                    $description = "Your Orders Has Been Delivered";

                    $sqlinsert = "INSERT INTO activitylogs (seller_id,description) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$users_id,$description]);
                }

                }
            }else{
                if ($_GET['status'] == 'confirmed') {
                    $sqlinsert = "UPDATE orders SET status = 1  WHERE customers_orders_id = '".$customers_orders_id."'";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([]);

                $sql = "SELECT * FROM trackingstatus WHERE customers_orders_id = '".$customers_orders_id."' AND status = 1";
                $stmt = $this->conn()->query($sql);
                if ($stmt->rowcount() > 0) {

                } else {
                    $sqlinsert = "INSERT INTO trackingstatus (customers_orders_id,status) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$customers_orders_id,1]);

                    $description = "Your Orders Has Been Confirmed";

                    $sqlinsert = "INSERT INTO activitylogs (seller_id,description) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$users_id,$description]);
                }

                } else if ($_GET['status'] == 'processing') {
                    $sqlinsert = "UPDATE orders SET status = 2  WHERE customers_orders_id = '".$customers_orders_id."'";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([]);

                $sql = "SELECT * FROM trackingstatus WHERE customers_orders_id = '".$customers_orders_id."' AND status = 2";
                $stmt = $this->conn()->query($sql);
                if ($stmt->rowcount() > 0) {

                } else {
                    $sqlinsert = "INSERT INTO trackingstatus (customers_orders_id,status) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$customers_orders_id,2]);

                    $description = "Your Orders Has Been Processing";

                    $sqlinsert = "INSERT INTO activitylogs (seller_id,description) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$users_id,$description]);
                }

                } else if ($_GET['status'] == 'quality') {
                    $sqlinsert = "UPDATE orders SET status = 3  WHERE customers_orders_id = '".$customers_orders_id."'";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([]);

                $sql = "SELECT * FROM trackingstatus WHERE customers_orders_id = '".$customers_orders_id."' AND status = 3";
                $stmt = $this->conn()->query($sql);
                if ($stmt->rowcount() > 0) {

                } else {
                    $sqlinsert = "INSERT INTO trackingstatus (customers_orders_id,status) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$customers_orders_id,3]);

                    $description = "Your Orders Has Been Quality Check";

                    $sqlinsert = "INSERT INTO activitylogs (seller_id,description) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$users_id,$description]);
                }

                } else if ($_GET['status'] == 'dispatched') {
                    $sqlinsert = "UPDATE orders SET status = 4  WHERE customers_orders_id = '".$customers_orders_id."'";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([]);

                $sql = "SELECT * FROM trackingstatus WHERE customers_orders_id = '".$customers_orders_id."' AND status = 4";
                $stmt = $this->conn()->query($sql);
                if ($stmt->rowcount() > 0) {

                } else {
                    $sqlinsert = "INSERT INTO trackingstatus (customers_orders_id,status) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$customers_orders_id,4]);

                    $description = "Your Orders Has Been Dispatched";

                    $sqlinsert = "INSERT INTO activitylogs (seller_id,description) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$users_id,$description]);
                }

                } else if ($_GET['status'] == 'delivered') {
                    $sqlinsert = "UPDATE orders SET status = 5  WHERE customers_orders_id = '".$customers_orders_id."'";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([]);

                $sql = "SELECT * FROM trackingstatus WHERE customers_orders_id = '".$customers_orders_id."' AND status = 5";
                $stmt = $this->conn()->query($sql);
                if ($stmt->rowcount() > 0) {

                } else {
                    $sqlinsert = "INSERT INTO trackingstatus (customers_orders_id,status) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$customers_orders_id,5]);

                    $description = "Your Orders Has Been Delivered";

                    $sqlinsert = "INSERT INTO activitylogs (seller_id,description) VALUES (?,?)";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$users_id,$description]);
                }

                }
            }


    

                echo "<script type='text/javascript'>alert('Successfully Change Status');</script>";
                echo "<script>window.location.href='../admin/new_orders_show.php?&customers_code=".$customers_code."&label=".$label."&users_id=".$users_id."';</script>";
                
            }

        }

    }

    $productsrun = new products();
    $productsrun->manageproducts();

?>

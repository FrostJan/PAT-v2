<?php
    session_start();
    include '../config/config.php';

    class products extends Connection{

        public function manageproducts(){

            if (isset($_POST['add'])) {

                $users_id = $_SESSION['id'];
                $department = $_POST['department'];
                $activityorpurpose = $_POST['activityorpurpose'];
                $division = $_POST['division'];
                $numberofattendees = $_POST['numberofattendees'];
                $datefilled = $_POST['datefilled'];
                $timeneeded = $_POST['timeneeded1']." - ".$_POST['timeneeded2'];
                $dateneeded = $_POST['dateneeded'];
                $personincharge = $_POST['personincharge'];
                $contactnumber = $_POST['contactnumber'];
                $pat = isset($_POST['pat']) ? 'yes' : 'no';
                $emcroom = isset($_POST['emcroom']) ? 'yes' : 'no';
                $tvroom = isset($_POST['tvroom']) ? 'yes' : 'no';
                $institutional = isset($_POST['institutional']) ? 'yes' : 'no';
                $curricular = isset($_POST['curricular']) ? 'yes' : 'no';
                $outsidegroup = isset($_POST['outsidegroup']) ? 'yes' : 'no';
                $cocurricular = isset($_POST['cocurricular']) ? 'yes' : 'no';
                $extracurricular = isset($_POST['extracurricular']) ? 'yes' : 'no';



                $file = $_FILES['file']['name'];
                $tmp = $_FILES['file']['tmp_name'];
                move_uploaded_file($tmp, '../file/'.$file);
                
                $sqlinsert = "INSERT INTO request (users_id,department,activityorpurpose,division,numberofattendees,datefilled,timeneeded,dateneeded,personincharge,contactnumber,pat,emcroom,tvroom,institutional,curricular,outsidegroup,cocurricular,extracurricular,file) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $statementinsert = $this->conn()->prepare($sqlinsert);
                $statementinsert->execute([$users_id,$department,$activityorpurpose,$division,$numberofattendees,$datefilled,$timeneeded,$dateneeded,$personincharge,$contactnumber,$pat,$emcroom,$tvroom,$institutional,$curricular,$outsidegroup,$cocurricular,$extracurricular,$file]);

                echo "<script type='text/javascript'>alert('Successfully Submit Request');</script>";
                echo "<script>window.location.href='../admin/facility_form.php';</script>";
            }

            if (isset($_POST['edit'])) {
                try {
            
      
                $products_edit_products_id = $_POST['products_edit_products_id'];
                $products_edit_category_id = $_POST['products_edit_category_id'];
                $products_edit_products_name = $_POST['products_edit_products_name'];
                $products_edit_products_description = $_POST['products_edit_products_description'];
                $products_edit_products__quantity = $_POST['products_edit_products__quantity'];
                $products_edit_products_price = $_POST['products_edit_products_price'];
                $products_edit_products_discount = $_POST['products_edit_products_discount'];

                $products_edit_products_trivia = $_POST['products_edit_products_trivia'];
                $pickuplocation = $_POST['products_edit_products_pickuplocation'];

                $products_edit_products_label = $_POST['products_edit_products_label'];
                $products_edit_products_label2 = $_POST['products_edit_products_label2'];
                $products_edit_products_downpayment;
                $products_edit_products_date_harvest;


                


                if ($products_edit_products_label == 'Pre-Order') {

                    $products_edit_products_downpayment = $_POST['products_edit_products_downpayment'];
                    $products_edit_products_date_harvest = $_POST['products_edit_products_date_harvest'];

                } else {

                    $products_edit_products_downpayment = '';
                    $products_edit_products_date_harvest = '';

                }


                // Convert discount percentage to decimal
                $decimalDiscount = $products_edit_products_discount / 100;
                $discountAmount = $products_edit_products_price * $decimalDiscount;
                $products_discount_price = $products_edit_products_price - $discountAmount;
    

                $products_edit_products_img = $_FILES['products_edit_products_img']['name'];
                $tmp = $_FILES['products_edit_products_img']['tmp_name'];
                move_uploaded_file($tmp, '../images/'.$products_edit_products_img);

                if ($products_edit_products_img != '') {
                    
                    $sqlinsert = "UPDATE products SET 
                    category_id = ?, 
                    products_img = ?, 
                    products_name = ?, 
                    products_description = ?, 
                    products__quantity = ?, 
                    products_price = ?,
                    products_discount = ?,
                    products_discount_price = ?,
                    trivia = ?,
                    date_harvest = ?,
                    label = ?,
                    label2 = ?,
                    downpayment = ?,
                    pickuplocation = ?

                    WHERE products_id = '".$products_edit_products_id."'";

                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([
                        $products_edit_category_id,
                        $products_edit_products_img,
                        $products_edit_products_name,
                        $products_edit_products_description,
                        $products_edit_products__quantity,
                        $products_edit_products_price,
                        $products_edit_products_discount,
                        $products_discount_price,
                        $products_edit_products_trivia,
                        $products_edit_products_date_harvest,
                        $products_edit_products_label,
                        $products_edit_products_label2,
                        $products_edit_products_downpayment,
                        $pickuplocation
                        
                        ]);
                }else{
                    $sqlinsert = "UPDATE products SET 
                    category_id = ?, 
                    products_name = ?, 
                    products_description = ?, 
                    products__quantity = ?, 
                    products_price = ?,
                    products_discount = ?,
                    products_discount_price = ?,
                    trivia = ?,
                    date_harvest = ?,
                    label = ?,
                    label2 = ?,
                    downpayment = ?,
                    pickuplocation = ?

                    WHERE products_id = '".$products_edit_products_id."'";

                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([
                        $products_edit_category_id,
                        $products_edit_products_name,
                        $products_edit_products_description,
                        $products_edit_products__quantity,
                        $products_edit_products_price,
                        $products_edit_products_discount,
                        $products_discount_price,
                        $products_edit_products_trivia,
                        $products_edit_products_date_harvest,
                        $products_edit_products_label,
                        $products_edit_products_label2,
                        $products_edit_products_downpayment,
                        $pickuplocation
                    ]);

                }
           
                // echo "<script type='text/javascript'>alert('Successfully Edit Product');</script>";
                // echo "<script>window.location.href='../admin/products.php';</script>";


  } catch (Exception $e) {
            echo 'error'. $e->getmessage();
        }

                
            }

            if (isset($_POST['delete'])) {

                $products_delete_products_id = $_POST['products_delete_products_id'];

                    $sqlinsert = "DELETE FROM products WHERE products_id = '".$products_delete_products_id."'";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([]);
               
                    echo "<script type='text/javascript'>alert('Successfully Delete Product');</script>";
                    echo "<script>window.location.href='../admin/products.php';</script>";
                
            }

            

        }

    }

    $productsrun = new products();
    $productsrun->manageproducts();

?>

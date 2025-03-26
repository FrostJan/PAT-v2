<?php 
    include '../gmail.php';
    include '../config/config.php';
    class data extends Connection{
        public function managdata(){
            $user_email_address = $_SESSION['user_email_address'];
            $sql = "SELECT id FROM users WHERE user_email_address = '".$user_email_address."'";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();
            $users_id = $row['id'];

            $sql = "SELECT * FROM cart INNER JOIN products ON cart.products_id=products.products_id WHERE cart.users_id = '".$users_id."'";
            $stmtmycart = $this->conn()->query($sql); 
            while ($row = $stmtmycart->fetch()) { ?>
                <tr class="border">
                    <td class="p-2"><a href="cart.php" class="nav-link"><img src="../images/<?php echo $row['products_img'] ?>" width="50px"></a></td>
                    <td class="p-2"><?php echo $row['products_name'] ?></td>
                    <td class="p-2">
                        <div class="d-flex">
                            <button class="button btn border rounded-0 btn-dark" style="width: 40px" value="<?php echo $row['id'] ?>">-</button>
                        <input type="text" class="input btn border rounded-0 shadow-none" value="<?php echo $row['products_qty'] ?>" style="width: 50px;">
                            <button class="button btn border rounded-0 btn-dark" style="width: 40px" value="<?php echo $row['id'] ?>">+</button>
                        </div>
                    </td>
                    <td class="p-2"><?php echo $row['products_price'] ?></td>
                    <td class="p-2"><?php echo $row['products_qty'] * $row['products_price'] ?></td>
                </tr>
<?php      } 

        }
    }
    $datarun = new data();
    $datarun->managdata();
 ?>





<script type="text/javascript">
    $(function() {
 $(".button").on("click", function() {
   var $button = $(this);
   var $parent = $button.parent(); 
   var oldValue = $parent.find('.input').val();

   if ($button.text() == "+") {
      var newVal = parseFloat(oldValue) + 1;
    } else {
       // Don't allow decrementing below zero
      if (oldValue > 1) {
        var newVal = parseFloat(oldValue) - 1;
        } else {
        newVal = 1;
      }
      }
    $parent.find('a.add-to-cart').attr('data-quantity', newVal);
    $parent.find('.input').val(newVal);
 });
});

  
</script>
                                    











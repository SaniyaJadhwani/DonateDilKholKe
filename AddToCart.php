<?php

 $uid = $_GET['uid'];
 @include 'config.php';
if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE pid = '$update_id' AND uid ='$uid'");
   
};

if(isset($_POST['remove-btn'])){
   $remove_id = $_POST['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$remove_id' AND uid='$uid'");

};

if(isset($_POST['delete-btn'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE uid='$uid'");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> View Cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="Style.css">

</head>
<body>
<?php include 'header.php'; ?>
<div class="container">

<section class="shopping-cart">

   <h1 class="heading">shopping cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         @include 'config.php';
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE uid='$uid'");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="Images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>₹<?php echo $fetch_cart['price']; ?>.00 INR*</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value='<?php echo $fetch_cart['pid']; ?>' >
                  <input type="number" name="update_quantity" min="1"  value='<?php echo $fetch_cart['quantity']; ?>' >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td>₹<?php echo $sub_total = intval($fetch_cart['price']) * intval($fetch_cart['quantity']); ?>.00 INR*</td>
            <form action="" method="post">
            <input type="hidden" name="remove"  value='<?php echo $fetch_cart['pid']; ?>' >
            <td><input type="Submit" name="remove-btn" value="Remove"></td>
            </form>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="Home2.php?uid=<?php echo $uid?>" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
            <td colspan="3">grand total</td>
            <td>₹<?php echo $grand_total; ?>.00 INR*</td>
            <form action="" method="post">
            <td><input type="Submit" name="delete-btn" value="Delete all"></td>
      </form>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="Checkout.php?uid=<?php echo $uid?>" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
   </div>

</section>

</div>
<script src="script.js">
</script>

</body>
</html>
<?php
$uid = $_GET['uid'];
@include 'config.php';

if(isset($_POST['order_btn']))
{
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];
   
   $details=mysqli_query($conn,"SELECT * From `register` WHERE uid='$uid'");
   if(mysqli_num_rows($details) > 0)
   {
    while($row=mysqli_fetch_assoc($details))
    {
       $name=$row['Username'];
       $email=$row['Email'];
       $number=$row['MobileNo'];
    }
   }

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE uid='$uid'");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = intval($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
         $temp2=$product_item['pid'];
         $temp_query=mysqli_query($conn,"SELECT `quantity` FROM `products` WHERE `pid`='$temp2'");
         while($t = mysqli_fetch_assoc($temp_query))
         {
         $temp=intval($t['quantity'])-intval($product_item['quantity']);
         }
         $temp_query2=mysqli_query($conn,"UPDATE `products` set quantity='$temp' WHERE pid='$temp2'");
      };
   };

   $total_product =mysqli_num_rows($cart_query);
   $products_name = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$products_name','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$products_name."</span>
            <span class='total'> total : ₹".$price_total.".00 INR*  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
            <p>(*pay when product arrives*)</p>
            <p>(*Your order will arrive in 4 to 5 days*)</p>
         </div>
            <a href='Home2.php?uid=$uid' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }
   $delete_query = mysqli_query($conn, "DELETE FROM `cart` WHERE uid='$uid'");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="Style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE uid='$uid'");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = intval($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : ₹<?= $grand_total; ?>.00 INR* </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="Cash on delivery" selected>Cash on delivery</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 1</span>
            <input type="text" placeholder="e.g. flat no. & apartment name" name="flat" required>
         </div>
         <div class="inputBox">
            <span>address line 2</span>
            <input type="text" placeholder="e.g. street name" name="street" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="e.g. mumbai" name="city" required>
         </div>
         <div class="inputBox">
            <span>state</span>
            <input type="text" placeholder="e.g. maharashtra" name="state" required>
         </div>
         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="e.g. india" name="country" required>
         </div>
         <div class="inputBox">
            <span>pin code</span>
            <input type="text" placeholder="e.g. 123456" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<script src="script.js"></script>
   
</body>
</html>
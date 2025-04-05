<?php
$uid = $_GET['uid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="products.css">
</head>
<body>
    <section class="plants_all">
        <h1 id="jk">House Plants</h1>
        <div class="all-items">
            <?php
            @include 'config.php';
            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE type='plant'");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
            ?>
            <div class="item">
            <img src="Images/<?php echo $fetch_product['image'];?>" height="150" width="150">
            <div class="item-info">
            <h4 class="item-title"><?php echo $fetch_product['name']; ?></h4>
            <p class="item-price">₹<?php echo $fetch_product['price']; ?>.00 INR*</p>
            <a href="ProductPage.php?pid=<?php echo $fetch_product['pid'];?> &uid=<?php echo $uid?>" class="item-btn">View Product</a>
            </div>
        </div>
        <?php
         };
      };
      ?>
        </div>
       
    </section>
</body>
</html>
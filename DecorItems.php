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
    <section class="fun-items">
        <div class="class1">
        <h1 id="jk">Decor Items</h1>
    </div>
    <div class="tabs">
    <input type="radio" class="tabs__radio" id="tab1" name="tabs_group" value="SofaSets" checked>
    <label for="tab1" class="tabs__label">Show Piece</label>

    <div class="all-fun-items">
            <?php
            @include 'config.php';
            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE type='showpiece'");
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

        <input type="radio" class="tabs__radio" id="tab2" name="tabs_group" value="Tables" >
        <label for="tab2" class="tabs__label">Wall Paintings</label>
        <div class="all-fun-items">
            <?php
            @include 'config.php';
            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE type='wallpainting'");
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
        <input type="radio" class="tabs__radio" id="tab3" name="tabs_group" value="Closets" >
    <label for="tab3" class="tabs__label">Flower Vases</label>

    <div class="all-fun-items">
            <?php
            @include 'config.php';
            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE type='flowervase'");
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
        
        </div>
    </div>
    </section>
</body>
</html>
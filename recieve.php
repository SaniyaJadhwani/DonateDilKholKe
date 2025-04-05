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
        <h1 id="jk">Donated Items</h1>
    </div>
    <div class="tabs">
    <input type="radio" class="tabs__radio" id="tab1" name="tabs_group" value="SofaSets" checked>
    <label for="tab1" class="tabs__label">Show Piece</label>

    <div class="all-fun-items">
            <?php
            @include 'config.php';
            $select_products = mysqli_query($conn, "SELECT * FROM `donation_items`");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
            ?>
            <div class="item">
            <img src="images/<?php echo $fetch_product['Image'];?>" height="150" width="150">
            <div class="item-info">
            <h4 class="item-title"><?php echo $fetch_product['Item']; ?></h4>
            <p class="item-price"><?php echo $fetch_product['Description']; ?></p>
            <p class="item-price"><?php echo $fetch_product['ItemCondition']; ?></p>
            
            </div>
        </div>
        <?php
         };
      };
      ?>
        </div>

        
        
        </div>
    </section>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 
$select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE type='showpiece'");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
            ?>
            <div class="item">
            <img src="Images/<?php echo $fetch_product['image'];?>" height="150" width="150">
            </div>
</body>
</html>
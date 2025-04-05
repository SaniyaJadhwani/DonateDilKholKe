<?php

@include 'config.php';

if(isset($_POST['add_product'])){
   $p_type=$_POST['type'];
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'Images/'.$p_image;
   $temp=explode(".",$p_image);
   $p_id=$temp[0];
   $quantity=10;

   $insert_query = mysqli_query($conn, "INSERT INTO `products`(pid,name, price,image,type,quantity) VALUES('$p_id','$p_name', '$p_price', '$p_image','$p_type','$quantity')") or die('query failed');
   if($insert_query)
   {
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product added succesfully';
   }
   else
   {
      $message[] = 'could not add the product';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="Style.css">

</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add a new product</h3>
            <select name="type" class="box">
               <option>Choose Product</option>
               <option value="showpiece">Show Piece</option>
               <option value="wallpainting">Wall Painting</option>
               <option value="flowervase">Flower Vase</option>
               <option value="sofa">Sofa</option>
               <option value="table">Table</option>
               <option value="bed">Bed</option>
               <option value="plant">Plant</option>
               <option value="asianpaints">Asian Paints</option>
               <option value="nerolac">Nerolac Paints</option>
               <option value="dulux">Dulux Paints</option>
            </select>
   <input type="text" name="p_name" placeholder="enter the product name" class="box" required>
   <input type="number" name="p_price" min="0" placeholder="enter the product price" class="box" required>
   <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="add the product" name="add_product" class="btn">
</form>
</section>

</div>
<script src="script.js"></script>

</body>
</html>
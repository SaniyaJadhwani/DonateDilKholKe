<?php
      $pid = $_GET['pid'];
      $uid = $_GET['uid'];
    
      $con = new mysqli("localhost","Saniya","","idwebapp");
     if($con->connect_error)
     {
      die("Failed to connect");
    }
    else
    {
  $sql="SELECT name,price,image FROM products WHERE pid='$pid'";
  $result=$con->query($sql);
  while($row=$result->fetch_assoc())
  {
       
       $name=$row['name'];
       $price=$row['price'];
       $image=$row['image'];
  }
}
if(isset($_POST['add-to-cart']))
{
 $quan=1;
 $con = new mysqli("localhost","Saniya","","idwebapp");
 if($con->connect_error)
 {
    die("Failed to connect");
 }
 else
 {
   $select_cart = mysqli_query($con, "SELECT * FROM cart WHERE uid='$uid' AND pid='$pid'");

   if(mysqli_num_rows($select_cart) > 0)
   {
      echo "<script>alert('product already added to cart')</script>";
   }else
   {
      $sql="SELECT name,price,image,quantity FROM products WHERE pid='$pid'";
      $result=$con->query($sql);
      while($row=$result->fetch_assoc())
      {
           $quantity=$row['quantity'];
           $name=$row['name'];
           $price=$row['price'];
           $image=$row['image'];
      }
      if($quantity==0)
      {
        echo"<script>alert('This product is not available right now')</script>";
        echo"<script>window.history.back()</script>";
        return false;
      }
      else{
      $sql2="INSERT INTO cart(uid,pid,name,price,image,quantity)VALUES('$uid','$pid','$name','$price','$image','$quan')";
      $con->query($sql2);
      echo"<script>alert('product added to cart')</script>";
      }
   }
}}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="Style.css">
    <style>
        .container {
            text-align: center;
            background-color: pink;
            margin-top:100px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 600px;
        }

        .title {
            color: #333;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .detail {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .image {
            flex: 1;
        }

        img {
            max-width: 100%;
            border-radius: 8px;
        }

        .content {
            flex: 1;
            padding-left: 20px;
            text-align: left;
        }

        .name {
            color: #333;
            font-size: 20px;
            margin-bottom: 40px;
        }

        .price {
            color: #555;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .buttons {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .add-to-cart-btn {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #dc6a8b;
            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background-color: #555;
        }
        .view-cart-btn {
            margin-left:20px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #dc6a8b;
            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            width:120px;
        }

        .view-cart-btn:hover {
            background-color: #555;
        }
        .shopping-btn {
            margin-left:700px;
            margin-top:80px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #dc6a8b;
            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            width:200px;
        }

        .shopping-btn:hover {
            background-color: #555;
        }

        </style>
</head>
<body >
    <?php include 'header.php';?>
    <div class="container">
        <div class="title">PRODUCT DETAIL</div>
        <div class="detail">
            <div class="image">
                <img src="Images/<?php echo $image?>" id="pimg">
            </div>
            <div class="content">
                <h1 class="name" id="pname"><?php echo $name?></h1>
                <div class="price" id="pprice"><?php echo "₹".$price.".00 INR*"?></div>
                <div class="buttons">
                <form action="" method="post">
                <input type="Submit" name="add-to-cart" value="Add to cart" class="add-to-cart-btn">
                </form>
                <a class="view-cart-btn" href="AddToCart.php?uid=<?php echo $uid?>">View Cart</a>
                </div>

            </div>
        </div>
    </div>
    <input type="button" class="shopping-btn" value="Continue Shopping" onclick="history.back()">
</body> 
</html>
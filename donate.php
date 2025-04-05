<?php
session_start();
$uname=$_SESSION["username"];
$conn = mysqli_connect("localhost","Saniya","","donate_dilkholke") or die('connection failed');

if(isset($_POST['donate_item'])){
   $d_item=$_POST['type'];
   $d_image = $_FILES['d_image']['name'];
   $d_image_tmp_name = $_FILES['d_image']['tmp_name'];
   $d_image_folder = 'images/'.$d_image;
   $temp=explode(".",$d_image);
   $d_id=$temp[0];
   $d_condition=$_POST['condition'];
   $d_description=$_POST['condition_details'];
   

   $insert_query = mysqli_query($conn, "INSERT INTO `donation_items`(Username,Item,Image,ItemCondition,Description,DonationId) VALUES('$uname','$d_item','$d_image','$d_condition','$d_description','$d_id')") or die('query failed');
   if($insert_query)
   {
      move_uploaded_file($d_image_tmp_name, $d_image_folder);
      echo "<script>alert('Item added for donation Successfully')</script>";
   }
   else
   {
      echo "<script>alert('could not add the item')</script>";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Dilkholke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            background: linear-gradient(to right, #D9EFFF, #A1C4FD);
            color: #0F4C75;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background: #3282B8;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        }
        .navbar .brand {
            display: flex;
            align-items: center;
        }
        .navbar .logo img {
            height: 50px;
            margin-right: 15px;
        }
        .navbar .brand h1 {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        .navbar .menu a {
            margin: 0 15px;
            text-decoration: none;
            color: white;
            font-size: 18px;
            transition: 0.3s;
            font-weight: bold;
        }
        .navbar .menu a:hover {
            color: #FFD700;
        }
        .container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f8f9fa;
    background: url('images/donate.jpg') no-repeat center center/cover;
}

section {
    background: rgba(255, 255, 255, 0.5); /* 50% transparent white */
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    max-width: 500px;
    width: 100%;
}

h3 {
    text-align: center;
    color: #004080; /* Dark blue for better visibility */
    font-size: 28px;
    margin-bottom: 20px;
}

.box {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border: 1px solid #004080;
    border-radius: 8px;
    font-size: 18px;
}

.btn {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    background: #5dade2; /* Softer blue shade */
    color: white;
    font-size: 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn:hover {
    background: #3498db; /* Slightly darker blue for hover */
}

.radio-group {
    margin: 12px 0;
}

.radio-group label {
    display: block;
    margin: 6px 0;
    font-size: 18px;
    color: #004080;
}

textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #004080;
    border-radius: 8px;
    resize: vertical;
    font-size: 18px;
}

/* Additional HTML form elements */
.radio-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 12px;
}

.radio-group input[type="radio"] {
    margin-right: 10px;
}

textarea {
    width: 100%;
    height: 100px;
}

        </style>
        </head>
        <?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<body>
    <nav class="navbar">
        <div class="brand">
            <div class="logo"><img src="images/logo.jpeg" alt="Donate Dilkholke Logo"></div>
            <h1>Donate Dilkholke</h1>
        </div>
        <div class="menu">
            <a href="#">Home</a>
            <a href="recieve.php">Recieve</a>
            <a href="#">Donate</a>
            <a href="#">Contact</a>
        </div>
    </nav>
    <div class="container">
    <section>
        <form action="" method="post" class="donate-item-form" enctype="multipart/form-data">
            <h3>Donate Items</h3>

            <select name="type" class="box">
                <option>Select Item to Donate</option>
                <option value="clothes">Clothes</option>
                <option value="books">Books</option>
                <option value="electronic gadgets">Electronic Gadgets</option>
                <option value="utensils">Utensils</option>
            </select>

            <input type="file" name="d_image" accept="image/png, image/jpg, image/jpeg" class="box" required>

            <div class="radio-group">
                    <label>Condition of Item:</label>
                    <label><input type="radio" name="condition" value="good"> Good</label>
                    <label><input type="radio" name="condition" value="average"> Average</label>
                    <label><input type="radio" name="condition" value="worse"> Worse</label>
            </div>

            <label for="condition-details">Explain the condition:</label>
            <textarea id="condition-details" name="condition_details" placeholder="Describe the condition of the item..."></textarea>

            <input type="submit" value="Donate Item" name="donate_item" class="btn">
        </form>
    </section>
</div>
<script src="script.js"></script>
</body>
</html>
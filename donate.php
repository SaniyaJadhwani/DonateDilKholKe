<?php
session_start();
$uname = $_SESSION["username"];
$conn = mysqli_connect("localhost", "Saniya", "", "donate_dilkholke") or die('connection failed');

if (isset($_POST['donate_item'])) {
    $d_item = $_POST['type'];
    $d_image = $_FILES['d_image']['name'];
    $d_image_tmp_name = $_FILES['d_image']['tmp_name'];
    $d_image_folder = 'images/' . $d_image;
    $temp = explode(".", $d_image);
    $d_id = $temp[0];
    $d_condition = $_POST['condition'];
    $d_description = $_POST['condition_details'];

    $insert_query = mysqli_query($conn, "INSERT INTO `donation_items`(Username, Item, Image, ItemCondition, Description, DonationId) VALUES('$uname','$d_item','$d_image','$d_condition','$d_description','$d_id')") or die('query failed');
    if ($insert_query) {
        move_uploaded_file($d_image_tmp_name, $d_image_folder);
        echo "<script>alert('Item added for donation Successfully')</script>";
    } else {
        echo "<script>alert('Could not add the item')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Donate Dilkholke</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background: #f7f7f7;
      color: #333;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: calc(100vh - 80px);
      padding: 20px;
      background: #fff5f5;
    }

    section {
      background: #ffffff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
    }

    h3 {
      text-align: center;
      color: maroon;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .box, textarea, select {
      width: 100%;
      padding: 12px;
      margin: 12px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    .btn {
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      background: maroon;
      color: white;
      font-size: 18px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s;
    }

    .btn:hover {
      background: #a00000;
    }

    .radio-group {
      margin: 12px 0;
    }

    .radio-group label {
      display: block;
      margin: 6px 0;
      font-size: 16px;
    }

    .radio-group input[type="radio"] {
      margin-right: 10px;
    }

    label[for="condition-details"] {
      font-size: 16px;
      font-weight: 500;
      color: #444;
    }

    textarea {
      resize: vertical;
      height: 100px;
    }

    @media (max-width: 600px) {
      h3 {
        font-size: 22px;
      }
    }
  </style>
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="container">
    <section>
      <form action="" method="post" class="donate-item-form" enctype="multipart/form-data">
        <h3>Donate Items</h3>

        <select name="type" class="box" required>
          <option value="">Select Item to Donate</option>
          <option value="clothes">Clothes</option>
          <option value="books">Books</option>
          <option value="electronic gadgets">Electronic Gadgets</option>
          <option value="utensils">Utensils</option>
        </select>

        <input type="file" name="d_image" accept="image/png, image/jpg, image/jpeg" class="box" required>

        <div class="radio-group">
          <label>Condition of Item:</label>
          <label><input type="radio" name="condition" value="good" required> Good</label>
          <label><input type="radio" name="condition" value="average"> Average</label>
          <label><input type="radio" name="condition" value="worse"> Worse</label>
        </div>

        <label for="condition-details">Explain the condition:</label>
        <textarea id="condition-details" name="condition_details" placeholder="Describe the condition of the item..." required></textarea>

        <input type="submit" value="Donate Item" name="donate_item" class="btn">
      </form>
    </section>
  </div>
</body>
</html>

<?php
session_start();
$uname = $_SESSION["username"];
$_SESSION["username"] = $uname;
$DonationId = $_GET['pid'];

$con = new mysqli("localhost", "root", "", "donate_dilkholke");
if ($con->connect_error) {
    die("Failed to connect");
} else {
    $sql = "SELECT Item, Description, Username, Image FROM donation_items WHERE DonationId='$DonationId'";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $name = $row['Username'];
        $item = $row['Item'];
        $description = $row['Description'];
        $image = $row['Image'];
    }
}

if (isset($_POST['request'])) {
    $request_items = mysqli_query($con, "SELECT * FROM request WHERE RecieverName='$uname' AND DonationId='$DonationId'");

    if (mysqli_num_rows($request_items) > 0) {
        echo "<script>alert('Request already sent')</script>";
    } else {
        $sql = "SELECT Username, Item, Image FROM donation_items WHERE DonationId='$DonationId'";
        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
            $Donorname = $row['Username'];
            $Item = $row['Item'];
            $image = $row['Image'];
        }

        $sql2 = "INSERT INTO request(DonorName, RecieverName, DonationId, Status) VALUES('$Donorname', '$uname', '$DonationId', 'Pending')";
        $con->query($sql2);
        echo "<script>alert('Request Sent to Donor')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Item Details</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background-color: #ffffff;
      color: #0F4C75;
      overflow-x: hidden;
      padding: 40px 20px;
    }

    .container {
      max-width: 900px;
      margin: 120px auto 60px; /* adjusted for header */
      background: #f6f6f6;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
      padding: 40px;
    }

    .title {
      font-size: 30px;
      font-weight: bold;
      text-align: center;
      color: #800000;
      margin-bottom: 30px;
    }

    .detail {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      gap: 30px;
      align-items: flex-start;
      justify-content: center;
    }

    .image img {
      max-width: 100%;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      width: 300px;
      height: auto;
    }

    .content {
      flex: 1;
      min-width: 250px;
      text-align: left;
    }

    .name {
      font-size: 24px;
      font-weight: bold;
      color: #800000;
      margin-bottom: 10px;
    }

    .price {
      font-size: 16px;
      color: #444;
      margin-bottom: 20px;
    }

    .buttons {
      margin-top: 20px;
    }

    .request-btn {
      padding: 10px 25px;
      background: #800000;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .request-btn:hover {
      background: #a30000;
    }

    .shopping-btn {
      display: block;
      margin: 50px auto 0;
      padding: 12px 30px;
      font-size: 16px;
      background-color: #800000;
      color: white;
      border: none;
      border-radius: 30px;
      transition: 0.3s ease;
      cursor: pointer;
    }

    .shopping-btn:hover {
      background-color: #a30000;
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container">
    <div class="title">Item Detail</div>
    <div class="detail">
      <div class="image">
        <img src="Images/<?php echo $image; ?>" alt="Donated Item">
      </div>
      <div class="content">
        <h1 class="name"><?php echo $item; ?></h1>
        <h2 class="name">Donated By: <?php echo $name; ?></h2>
        <div class="price"><?php echo $description; ?></div>
        <div class="buttons">
          <form action="" method="post">
            <input type="submit" name="request" value="Request" class="request-btn">
          </form>
        </div>
      </div>
    </div>
  </div>

  <input type="button" class="shopping-btn" value="Back" onclick="history.back()">

</body>
</html>

<?php
session_start();
$uname = $_SESSION["username"];
$DonationId = $_GET['pid'];

$con = new mysqli("localhost", "Saniya", "", "donate_dilkholke");
if ($con->connect_error) {
    die("Failed to connect");
}

// Fetch item details
$sql = "SELECT Item, Description, Username, Image FROM donation_items WHERE DonationId='$DonationId'";
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
    $name = $row['Username'];
    $item = $row['Item'];
    $description = $row['Description'];
    $image = $row['Image'];
}

// Check if already requested
$alreadyRequested = false;
$check_request = mysqli_query($con, "SELECT * FROM request WHERE RecieverName='$uname' AND DonationId='$DonationId'");
if (mysqli_num_rows($check_request) > 0) {
    $alreadyRequested = true;
}

// Handle request submission
if (isset($_POST['request']) && !$alreadyRequested) {
    $sql2 = "INSERT INTO request(DonorName, RecieverName, DonationId, Status) VALUES('$name', '$uname', '$DonationId', 'Pending')";
    $con->query($sql2);
    echo "<script>alert('Request Sent to Donor'); window.location.href = window.location.href;</script>";
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
      margin: 120px auto 60px;
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

    .disabled-btn {
      background-color: gray !important;
      cursor: not-allowed;
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
            <?php if ($alreadyRequested): ?>
              <input type="button" value="Request Already Sent" class="request-btn disabled-btn" disabled>
            <?php else: ?>
              <input type="submit" name="request" value="Request" class="request-btn">
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>

  <input type="button" class="shopping-btn" value="Back" onclick="history.back()">

</body>
</html>

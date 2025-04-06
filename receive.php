<?php 
@include 'config.php';
include 'header.php';

session_start();
$username = $_SESSION['username'] ?? '';

// Handle filter
$filter = $_GET['filter'] ?? 'all';

$query = "SELECT * FROM donation_items";

if ($filter === 'available') {
    $query .= " WHERE DonationId NOT IN (SELECT DonationId FROM request WHERE RecieverName = '$username')";
} elseif ($filter === 'requested') {
    $query .= " WHERE DonationId IN (SELECT DonationId FROM request WHERE RecieverName = '$username')";
}

$select_products = mysqli_query($conn, $query);

// Get all request statuses for current user
$user_requests = [];
$req_query = mysqli_query($conn, "SELECT DonationId, Status FROM request WHERE RecieverName = '$username'");
while ($row = mysqli_fetch_assoc($req_query)) {
    $user_requests[$row['DonationId']] = $row['Status'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Donated Items</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #fff0f0;
      padding: 2rem 1rem;
      color: #333;
    }

    .header {
      text-align: center;
      margin: 1rem auto 2rem;
    }

    .header h1 {
      font-size: 2.5rem;
      color: white;
      background-color: #800000;
      padding: 1rem 2rem;
      border-radius: 15px;
      display: inline-block;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .filter-buttons {
      text-align: center;
      margin-bottom: 2rem;
    }

    .filter-buttons a {
      display: inline-block;
      margin: 0 10px;
      padding: 10px 20px;
      background: #800000;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 500;
    }

    .filter-buttons a.active {
      background-color: #a30000;
    }

    .items-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
    }

    .item-card {
      background: white;
      width: 270px;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-align: center;
      position: relative;
    }

    .item-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .item-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-bottom: 1px solid #eee;
    }

    .item-info {
      padding: 1rem;
    }

    .item-info h4 {
      font-size: 1.2rem;
      color: #800000;
      margin-bottom: 0.3rem;
    }

    .item-info p {
      font-size: 0.95rem;
      color: #555;
      margin-bottom: 0.8rem;
      min-height: 40px;
    }

    .item-btn {
      display: inline-block;
      padding: 8px 16px;
      background-color: #800000;
      color: white;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .item-btn:hover {
      background-color: #a50000;
    }

    .badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: gray;
      color: white;
      padding: 5px 12px;
      font-size: 12px;
      border-radius: 20px;
      font-weight: bold;
    }

    .badge.pending { background-color: orange; }
    .badge.accepted { background-color: green; }
    .badge.declined { background-color: red; }
    .badge.requested { background-color: #555; }
    .badge.donated { background-color: #6c757d; }

    @media (max-width: 768px) {
      .item-card {
        width: 90%;
      }
    }

    ::-webkit-scrollbar {
      width: 6px;
    }

    ::-webkit-scrollbar-thumb {
      background-color: #800000;
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <section class="fun-items">
    <div class="header">
      <h1>Donated Items</h1>
    </div>

    <div class="filter-buttons">
      <a href="receive.php?filter=all" class="<?= $filter == 'all' ? 'active' : '' ?>">Show All</a>
      <a href="receive.php?filter=available" class="<?= $filter == 'available' ? 'active' : '' ?>">Available</a>
      <a href="receive.php?filter=requested" class="<?= $filter == 'requested' ? 'active' : '' ?>">Requested</a>
    </div>

    <div class="items-container">
      <?php
      if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_product = mysqli_fetch_assoc($select_products)) {
          $donation_id = $fetch_product['DonationId'];
          $status = $user_requests[$donation_id] ?? null;
          $is_own_donation = $fetch_product['Username'] === $username;
      ?>
        <div class="item-card">
          <img src="images/<?php echo $fetch_product['Image']; ?>" alt="Item Image">
          <div class="item-info">
            <h4><?php echo $fetch_product['Item']; ?></h4>
            <p><?php echo $fetch_product['Description']; ?></p>
            <h4>By: <?php echo $is_own_donation ? 'You' : $fetch_product['Username']; ?></h4>

            <a href="ProductPage.php?pid=<?php echo $donation_id; ?>" class="item-btn">View Item</a>
          </div>

          <?php if ($is_own_donation): ?>
            <div class="badge donated">Donated by You</div>
          <?php elseif ($status): ?>
            <div class="badge 
              <?php 
                if ($status == 'Pending') echo 'pending'; 
                elseif ($status == 'Accepted') echo 'accepted'; 
                elseif ($status == 'Declined') echo 'declined';
              ?>">
              <?php echo $status; ?>
            </div>
          <?php elseif ($filter == 'requested'): ?>
            <div class="badge requested">Request Sent</div>
          <?php endif; ?>
        </div>
      <?php
        }
      } else {
        echo "<p style='text-align:center; color:#800000; font-size: 1.2rem;'>No donated items available.</p>";
      }
      ?>
    </div>
  </section>
</body>
</html>

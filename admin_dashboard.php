<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}
$con = new mysqli("localhost", "root", "", "donate_dilkholke");

// Get total stats
$totalUsers = $con->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$totalDonations = $con->query("SELECT COUNT(*) AS total FROM donation_items")->fetch_assoc()['total'];
$totalRequests = $con->query("SELECT COUNT(*) AS total FROM request")->fetch_assoc()['total'];

// Request status breakdown
$accepted = $con->query("SELECT COUNT(*) AS total FROM request WHERE status = 'Accepted'")->fetch_assoc()['total'];
$declined = $con->query("SELECT COUNT(*) AS total FROM request WHERE status = 'Declined'")->fetch_assoc()['total'];
$pending = $con->query("SELECT COUNT(*) AS total FROM request WHERE status = 'Pending'")->fetch_assoc()['total'];

// Recent activity
$recentActivity = $con->query("
    SELECT r.RecieverName, r.DonorName, d.Item, r.Status, r.RequestId
    FROM request r
    JOIN donation_items d ON r.DonationId = d.DonationId
    ORDER BY r.RequestId DESC LIMIT 5
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9f9f9;
            margin: 0;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            flex: 1;
            min-width: 220px;
            text-align: center;
        }

        .card h3 {
            margin: 0;
            font-size: 20px;
            color: #555;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            margin: 5px 0 0;
            color: #800000;
        }

        .charts {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        canvas {
            background: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.05);
        }

        .activity {
            margin-top: 40px;
        }

        .activity h3 {
            margin-bottom: 15px;
            color: #800000;
        }

        .activity ul {
            list-style: none;
            padding: 0;
        }

        .activity li {
            background: #fff;
            margin-bottom: 10px;
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }

        .activity li span {
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php include("admin_navbar.php"); ?>

<div class="main-content">
    <h2>Dashboard Overview</h2>

    <div class="cards">
        <div class="card">
            <h3>Total Users</h3>
            <p><?= $totalUsers ?></p>
        </div>
        <div class="card">
            <h3>Total Donations</h3>
            <p><?= $totalDonations ?></p>
        </div>
        <div class="card">
            <h3>Total Requests</h3>
            <p><?= $totalRequests ?></p>
        </div>
        <div class="card">
            <h3>Accepted / Declined / Pending</h3>
            <p><?= "$accepted / $declined / $pending" ?></p>
        </div>
    </div>

    <div class="charts">
        <div style="width: 250px; height: 250px;">
            <canvas id="statusChart" width="250" height="250"></canvas>
        </div>
        <div style="width: 250px; height: 250px;">
            <canvas id="requestBar" width="250" height="250"></canvas>
        </div>
    </div>

    <div class="activity">
        <h3>Recent Activity</h3>
        <ul>
            <?php while ($row = $recentActivity->fetch_assoc()): ?>
                <li>
                    <span><?= $row['RecieverName'] ?></span> requested <strong><?= $row['Item'] ?></strong> from <span><?= $row['DonorName'] ?></span>
                    - Status: <em><?= $row['Status'] ?></em>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>

<script>
    const ctx1 = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Accepted', 'Declined', 'Pending'],
            datasets: [{
                label: 'Request Status',
                data: [<?= $accepted ?>, <?= $declined ?>, <?= $pending ?>],
                backgroundColor: ['#28a745', '#dc3545', '#ffc107']
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false
        }
    });

    const ctx2 = document.getElementById('requestBar').getContext('2d');
    const requestBar = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Accepted', 'Declined', 'Pending'],
            datasets: [{
                label: 'Request Count',
                data: [<?= $accepted ?>, <?= $declined ?>, <?= $pending ?>],
                backgroundColor: ['#28a745', '#dc3545', '#ffc107']
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>

<?php
include 'config.php'; // DB connection
session_start();

// Fetch settings
$query = "SELECT * FROM settings LIMIT 1";
$result = mysqli_query($conn, $query);
$settings = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Website Settings - Admin</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background: #f7f7f7;
            padding: 40px;
        }
        .container {
            max-width: 600px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            margin: auto;
        }
        h2 {
            margin-bottom: 20px;
            color: #800000;
        }
        label {
            font-weight: 600;
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .toggle {
            margin-top: 10px;
        }
        button {
            background: #800000;
            color: white;
            border: none;
            padding: 12px 20px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #a00000;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Website Settings</h2>
    <form action="update_settings.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Site Title</label>
            <input type="text" name="site_title" value="<?= $settings['site_title'] ?>" required>
        </div>

        <div class="form-group">
            <label>Site Logo</label>
            <input type="file" name="site_logo">
            <p>Current Logo: <?= $settings['site_logo'] ?></p>
        </div>

        <div class="form-group">
            <label>Theme Gradient Color (Hex Code)</label>
            <input type="text" name="theme_color" value="<?= $settings['theme_color'] ?>" required>
        </div>

        <div class="form-group">
            <label>Admin Email</label>
            <input type="email" name="admin_email" value="<?= $settings['admin_email'] ?>" required>
        </div>

        <div class="form-group toggle">
            <label>Enable Chat</label>
            <select name="enable_chat">
                <option value="1" <?= $settings['enable_chat'] ? 'selected' : '' ?>>Enabled</option>
                <option value="0" <?= !$settings['enable_chat'] ? 'selected' : '' ?>>Disabled</option>
            </select>
        </div>

        <div class="form-group toggle">
            <label>Enable Feedback</label>
            <select name="enable_feedback">
                <option value="1" <?= $settings['enable_feedback'] ? 'selected' : '' ?>>Enabled</option>
                <option value="0" <?= !$settings['enable_feedback'] ? 'selected' : '' ?>>Disabled</option>
            </select>
        </div>

        <button type="submit" name="save_settings">Save Changes</button>
    </form>
</div>
</body>
</html>

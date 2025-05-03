<?php
include 'config.php';
session_start();

if (isset($_POST['save_settings'])) {
    $site_title = $_POST['site_title'];
    $theme_color = $_POST['theme_color'];
    $admin_email = $_POST['admin_email'];
    $enable_chat = $_POST['enable_chat'];
    $enable_feedback = $_POST['enable_feedback'];

    // Handle logo upload
    $site_logo = '';
    if (!empty($_FILES['site_logo']['name'])) {
        $target_dir = "uploads/";
        $site_logo = basename($_FILES["site_logo"]["name"]);
        $target_file = $target_dir . $site_logo;
        move_uploaded_file($_FILES["site_logo"]["tmp_name"], $target_file);
    } else {
        // Get existing logo
        $query = "SELECT site_logo FROM settings LIMIT 1";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $site_logo = $row['site_logo'];
    }

    // Update settings
    $sql = "UPDATE settings SET 
        site_title='$site_title', 
        site_logo='$site_logo', 
        theme_color='$theme_color',
        admin_email='$admin_email',
        enable_chat='$enable_chat',
        enable_feedback='$enable_feedback'
        WHERE id=1";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Settings updated successfully'); window.location.href='admin_settings.php';</script>";
    } else {
        echo "<script>alert('Failed to update settings'); window.location.href='admin_settings.php';</script>";
    }
}
?>

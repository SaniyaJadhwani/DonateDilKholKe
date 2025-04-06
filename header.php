<!-- header.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
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
  }

  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 16px;
    background: #800000;
    border-radius: 6px;
    flex-wrap: wrap;
  }

  .navbar .brand {
    display: flex;
    align-items: center;
  }

  .navbar .logo img {
    height: 35px;
    margin-right: 8px;
  }

  .navbar .brand h1 {
    color: white;
    font-size: 18px;
    font-weight: bold;
    white-space: nowrap;
  }

  .navbar .menu {
    display: flex;
    flex-wrap: wrap;
  }

  .navbar .menu a {
    margin: 0 10px;
    text-decoration: none;
    color: white;
    font-size: 15px;
    transition: 0.3s;
    font-weight: bold;
  }

  .navbar .menu a:hover {
    color: #FFD700;
  }
</style>

<nav class="navbar">
  <div class="brand">
    <div class="logo"><img src="images/logo.jpeg" alt="Donate Dilkholke Logo"></div>
    <h1>Donate Dilkholke</h1>
  </div>
  <div class="menu">
    <a href="Home2.php">Home</a>
    <a href="profile.php">Profile</a>
    <a href="donate.php">Donate</a>
    <a href="receive.php">Receive</a>
    <a href="#">Contact Us</a>
  </div>
</nav>

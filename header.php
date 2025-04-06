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
      padding: 15px 50px;
      background: maroon;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .navbar .brand {
      display: flex;
      align-items: center;
    }

    .navbar .logo img {
      height: 50px;
      margin-right: 15px;
      border-radius: 50%;
      border: 2px solid #fff;
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
      font-weight: bold;
      transition: 0.3s;
    }

    .navbar .menu a:hover {
      color: #ffcc70;
    }

    .hero {
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      height: 85vh;
      padding: 30px;
      background: linear-gradient(to right, #fff, #ffe5e5);
      position: relative;
    }
</style>

<nav class="navbar">
    <div class="brand">
      <div class="logo"><img src="images/logo.jpeg" alt="Donate Dilkholke Logo"></div>
      <h1>Donate Dilkholke</h1>
    </div>
    <div class="menu">
    <a href="Home2.php">Home</a>
    <a href="Profile.php">Profile</a>
    <a href="donate.php">Donate</a>
    <a href="receive.php">Receive</a>
    <a href="#">Contact Us</a>
    <a href="logout.php">Logout</a>
    </div>
  </nav>

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
      background: linear-gradient(to right, #f8f8f8, #f0f0f0);
      color: #4a4a4a;
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
  background: 
    linear-gradient(rgba(128, 0, 0, 0.3), rgba(128, 0, 0, 0.3)), 
    url('images/indexpage.png') no-repeat center center/cover;
  position: relative;
}

    .hero .content {
      max-width: 700px;
      z-index: 1;
    }

    .hero h1 {
      font-size: 40px;
      color: white;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 18px;
      color: white;
      margin-bottom: 30px;
    }

    .hero .btn {
      padding: 12px 30px;
      background: maroon;
      color: white;
      font-size: 18px;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      font-weight: bold;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      transition: 0.3s;
    }

    .hero .btn:hover {
      background: #b30000;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        padding: 15px 20px;
      }

      .navbar .menu {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: center;
      }

      .hero {
        padding: 40px 20px;
        height: auto;
      }

      .hero h1 {
        font-size: 28px;
      }

      .hero p {
        font-size: 16px;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="brand">
      <div class="logo"><img src="images/logo.jpeg" alt="Donate Dilkholke Logo"></div>
      <h1>Donate Dilkholke</h1>
    </div>
    <div class="menu">
      <a href="AdminLogin.php">Admin Login</a>
      <a href="login.php">User Login</a>
      <a href="register.php">User Registration</a>
    </div>
  </nav>

  <section class="hero">
    <div class="content">
      <h1>We Can Change It Together, Let's Do It Now!</h1>
      <p>Your small contribution can bring a big change. Join us in spreading kindness.</p>
      <a href="donate.php"><button class="btn">Donate Now</button></a>
    </div>
  </section>
</body>
</html>

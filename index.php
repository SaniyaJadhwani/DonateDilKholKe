<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Dilkholke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            background: linear-gradient(to right, #D9EFFF, #A1C4FD);
            color: #0F4C75;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background: #3282B8;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        }
        .navbar .brand {
            display: flex;
            align-items: center;
        }
        .navbar .logo img {
            height: 50px;
            margin-right: 15px;
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
            transition: 0.3s;
            font-weight: bold;
        }
        .navbar .menu a:hover {
            color: #FFD700;
        }
        .hero {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 100px 20px;
            background: url('images/indexpage.jpg') no-repeat center center/cover;
            height: 80vh;
            color: white;
            position: relative;
        }
        .hero .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(50, 130, 184, 0.5);
        }
        .hero .content {
            position: relative;
            max-width: 600px;
            z-index: 1;
        }
        .hero h1 {
            font-size: 40px;
            font-weight: bold;
        }
        .hero p {
            margin: 20px 0;
            font-size: 18px;
        }
        .hero .btn {
            padding: 12px 24px;
            background: white;
            color: #3282B8;
            font-size: 18px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .hero .btn:hover {
            background: white;
            color: #3282B8;
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
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </nav>
    <section class="hero">
        <div class="overlay"></div>
        <div class="content">
            <h1>We Can Change It Together, Let's Do It Now!</h1>
            <p>Your small contribution can bring a big change. Join us in spreading kindness.</p>
            <button class="btn">Donate Now</button>
        </div>
    </section>
</body>
</html>

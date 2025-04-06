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

    .hero {
      position: relative;
      width: 100%;
      height: 100vh;
      background: url('images/indexpage.png') no-repeat center center/cover;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
    }

    .hero .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(128, 0, 0, 0.2); /* Light maroon */
    }

    .hero .content {
      position: relative;
      max-width: 600px;
      z-index: 1;
      margin-top: 120px; /* Push content lower */
    }

    .hero h1 {
      font-size: 40px;
      font-weight: bold;
    }

    .hero .btn {
      margin-top: 30px;
      padding: 12px 24px;
      background: white;
      color: #800000;
      font-size: 18px;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .hero .btn:hover {
      background: #ffeaea;
      color: #800000;
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <section class="hero">
    <div class="overlay"></div>
    <div class="content">
      <h1>We Can Change It Together, Let's Do It Now!</h1>
      <button class="btn" onclick="window.location.href='donate.php'">Donate Now</button>
    </div>
  </section>

</body>
</html>

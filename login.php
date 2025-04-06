<?php
if (isset($_POST['login-btn'])) {
    $uname = filter_input(INPUT_POST, 'uname');
    $pass = filter_input(INPUT_POST, 'pass');
    $c = 0;

    $con = new mysqli("localhost", "Saniya", "", "donate_dilkholke");
    if ($con->connect_error) {
        die("Failed to connect");
    } else {
        $sql = "SELECT Username, Password FROM users";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["Username"] == $uname && $row["Password"] == $pass) {
                    echo "<script>alert('Login Successfully')</script>";
                    $c++;
                    session_start();
                    $_SESSION["username"] = $uname;
                    echo "<script>window.location.href='Home2.php';</script>";
                    exit();
                }
            }
            if ($c == 0)
                echo "<script>alert('Invalid Username or Password')</script>";
        } else {
            echo "Results Not found";
        }
        $con->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      height: 100vh;
      width: 100%;
      background: #800000;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      display: flex;
      width: 900px;
      height: 500px;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    .form-section {
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .form-section h1 {
      font-size: 32px;
      margin-bottom: 10px;
      color: #800000;
    }

    .form-section p {
      font-size: 14px;
      color: #777;
      margin-bottom: 30px;
    }

    .input-box {
      position: relative;
      margin-bottom: 25px;
    }

    .input-box input {
      width: 100%;
      padding: 14px 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    .input-box i {
      position: absolute;
      top: 50%;
      right: 15px;
      transform: translateY(-50%);
      font-size: 20px;
      color: #888;
    }

    .forgot {
      font-size: 12px;
      text-align: right;
      margin-top: -15px;
      margin-bottom: 20px;
    }

    .forgot a {
      color: #800000;
      text-decoration: none;
    }

    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      background-color: #800000;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn:hover {
      background-color: #b04c4c;
    }

    .register-link {
      text-align: center;
      font-size: 14px;
      margin-top: 25px;
    }

    .register-link a {
      color: #800000;
      text-decoration: none;
      font-weight: bold;
    }

    .image-section {
      flex: 1;
      background: linear-gradient(to top right, #800000, #b04c4c);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .image-section img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        height: auto;
      }

      .image-section {
        display: none;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-section">
      <form method="post">
        <h1>Log In</h1>
        <p>Welcome back! Please enter your details</p>
        <div class="input-box">
          <input type="text" placeholder="Username" name="uname" required>
          <i class='bx bx-user'></i>
        </div>
        <div class="input-box">
          <input type="password" placeholder="Password" name="pass" required>
          <i class='bx bxs-lock'></i>
        </div>
        <div class="forgot"><a href="#">Forgot password?</a></div>
        <button type="submit" class="btn" name="login-btn">Log in</button>
        <div class="register-link">
          <p>Don't have an account? <a href="Register.php">Sign up</a></p>
        </div>
      </form>
    </div>
    <div class="image-section">
      <img src="images/loginpage.jpg" alt="Login Visual">
    </div>
  </div>
</body>
</html>

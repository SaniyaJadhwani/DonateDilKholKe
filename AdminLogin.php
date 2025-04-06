<?php
session_start(); // ✅ Start the session at the top

if (isset($_POST['login-btn'])) {
    $uname = filter_input(INPUT_POST, 'uname');
    $pass = filter_input(INPUT_POST, 'pass');
    $c = 0;

    $con = new mysqli("localhost", "root", "", "donate_dilkholke");
    if ($con->connect_error) {
        die("Failed to connect");
    } else {
        $sql = "SELECT Username, Password FROM admin";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["Username"] == $uname && $row["Password"] == $pass) {
                    $_SESSION['admin_username'] = $uname; // ✅ Store admin login session
                    echo "<script>alert('Welcome Admin')</script>";
                    $c++;
                    echo "<script>window.location.href='admin_users.php';</script>";
                    exit();
                }
            }
            if ($c == 0) echo "<script>alert('Invalid Username or Password')</script>";
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
  <title>Admin Login</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: url('images/home2.png') no-repeat center center fixed;
      background-size: cover;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      overflow: hidden;
    }

    /* Maroon overlay */
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(128, 0, 0, 0.3);
      z-index: 0;
    }

    .wrapper {
      position: relative;
      z-index: 1;
      background: rgba(255, 255, 255, 0.9);
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
      backdrop-filter: blur(5px);
    }

    .wrapper h1 {
      color: #800000;
      font-size: 32px;
      margin-bottom: 25px;
    }

    .input-box {
      position: relative;
      margin-bottom: 25px;
    }

    .input-box input {
      width: 100%;
      padding: 14px 45px 14px 15px;
      border: 2px solid #80000050;
      border-radius: 8px;
      outline: none;
      font-size: 15px;
      color: #333;
      transition: 0.3s ease;
    }

    .input-box input:focus {
      border-color: #800000;
      box-shadow: 0 0 5px rgba(128, 0, 0, 0.3);
    }

    .input-box i {
      position: absolute;
      top: 50%;
      right: 15px;
      transform: translateY(-50%);
      font-size: 20px;
      color: #800000;
    }

    .btn {
      width: 100%;
      background-color: #800000;
      color: white;
      padding: 12px;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #a00000;
    }

    @media (max-width: 500px) {
      .wrapper {
        margin: 0 15px;
      }
    }
  </style>
</head>
<body>
  <!-- Maroon overlay div -->
  <div class="overlay"></div>

  <div class="wrapper">
    <form action="" method="post">
      <h1>Admin Login</h1>

      <div class="input-box">
        <input type="text" name="uname" placeholder="Username" required />
        <i class='bx bx-user'></i>
      </div>

      <div class="input-box">
        <input type="password" name="pass" placeholder="Password" required />
        <i class='bx bxs-lock'></i>
      </div>

      <button class="btn" type="submit" name="login-btn">Login</button>
    </form>
  </div>
</body>
</html>
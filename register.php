<?php
if(isset($_POST['register-btn']))
{
    $uname = filter_input(INPUT_POST, 'uname');
    $pass = filter_input(INPUT_POST, 'pass');
    $cpass = filter_input(INPUT_POST, 'cpass');
    $email = filter_input(INPUT_POST, 'email');
    $mobile = filter_input(INPUT_POST, 'mobile');
    $address = filter_input(INPUT_POST, 'add');

    if($pass !== $cpass) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        $con = new mysqli("localhost", "Saniya", "", "donate_dilkholke");
        
        if($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

       // $uid = "us" . substr($uname, 0, 1) . substr($mobile, -2) . substr($email, 2, 2) . substr($pass, -2) . "er";
        $sql = "INSERT INTO users(Username, Password, Email, MobileNo, Address) 
                VALUES('$uname', '$pass', '$email', '$mobile', '$address')";

        if($con->query($sql)) {
            echo "<script>alert('Registered Successfully');</script>";
            session_start();
            $_SESSION["username"] = $uname;
           echo "<script>window.location.href='donate.php';</script>";
        } else {
            echo "<script>alert('Registration not successful');</script>";
        }
        
        $con->close();
    }
}
?>*/

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Donate Dilkholke</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('images/register.jpg'); /* Add your image URL */
            background-size: cover; /* Ensures the image covers the full screen */
            background-position: center; /* Centers the image */
            background-repeat: no-repeat; /* Prevents tiling */
            background-attachment: fixed; /* Keeps the image fixed on scroll */
        }
        .container {
            max-width: 650px;
            padding: 30px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            color: white;
            text-align: center;
        }
        h1 {
            font-size: 28px;
            font-weight: bold;
            color: #fff;
            padding-bottom: 10px;
            border-bottom: 2px solid white;
            display: inline-block;
        }
        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }
        .input-box {
            width: 48%;
            margin-bottom: 15px;
        }
        .input-box label {
            display: block;
            text-align: left;
            font-weight: bold;
            color: white;
            margin-bottom: 5px;
        }
        .input-box input {
            width: 100%;
            height: 40px;
            padding: 8px;
            border: none;
            border-radius: 8px;
            outline: none;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.3);
            color: #fff;
        }
        .input-box input:focus {
            background: rgba(255, 255, 255, 0.5);
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }
        .alert {
            font-size: 14px;
            font-style: italic;
            color: #fff;
            margin: 10px 0;
        }
        .button-container {
            margin-top: 15px;
        }
        .button-container button {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            border: none;
            border-radius: 8px;
            background: linear-gradient(to right, #1E90FF, #00BFFF);
            transition: 0.3s;
            cursor: pointer;
        }
        .button-container button:hover {
            background: linear-gradient(to right, #00BFFF, #1E90FF);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        }
        @media (max-width: 600px) {
            .input-box {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h1>Register</h1>
            <div class="content">
                <div class="input-box">
                    <label for="uname">Username</label>
                    <input type="text" placeholder="Enter Username" name="uname" required>
                </div>
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" placeholder="Enter Email" name="email" required>
                </div>
                <div class="input-box">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" placeholder="Enter Mobile Number" name="mobile" required>
                </div>
                <div class="input-box">
                    <label for="add">Address</label>
                    <input type="text" placeholder="Enter Address" name="add" required>
                </div>
                <div class="input-box">
                    <label for="pass">Password</label>
                    <input type="password" placeholder="Enter Password" name="pass" required>
                </div>
                <div class="input-box">
                    <label for="cpass">Confirm Password</label>
                    <input type="password" placeholder="Confirm Password" name="cpass" required>
                </div>
            </div>
            <div class="alert">
                <p>By clicking Register, you agree to our Terms & Conditions.</p>
            </div>
            <div class="button-container">
                <button type="submit" name="register-btn">Register</button>
            </div>
        </form>
    </div>
</body>
</html>

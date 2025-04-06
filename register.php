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
            min-height: 100vh;
            background: linear-gradient(135deg, #800000 0%, #500000 100%);
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 500px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            padding: 40px 30px;
        }
        .container h1 {
            font-size: 24px;
            font-weight: 600;
            color: #800000;
            margin-bottom: 20px;
            text-align: center;
        }
        .container .subtitle {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-bottom: 30px;
        }
        .container .input-group {
            margin-bottom: 20px;
        }
        .container .input-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            font-weight: 600; /* Changed from 500 to 600 to make labels bold */
        }
        .container .input-group input {
            width: 100%;
            height: 45px;
            padding: 0 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s;
        }
        .container .input-group input:focus {
            border-color: #800000;
            outline: none;
            box-shadow: 0 0 0 2px rgba(128, 0, 0, 0.2);
        }
        .container .terms {
            font-size: 12px;
            color: #888;
            text-align: center;
            margin: 20px 0;
        }
        .container .terms a {
            color: #800000;
            text-decoration: none;
        }
        .container .btn {
            width: 100%;
            height: 45px;
            background: linear-gradient(135deg, #800000 0%, #500000 100%);
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }
        .container .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        .container .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        .container .login-link a {
            color: #800000;
            text-decoration: none;
            font-weight: 500;
        }
        .container .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        .container .divider::before,
        .container .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #ddd;
        }
        .container .divider span {
            padding: 0 10px;
            color: #888;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <p class="subtitle">Creating your account is free and easy</p>
        
        <form action="" method="post">
            <div class="input-group">
                <label for="uname">Username</label>
                <input type="text" placeholder="Enter Username" name="uname" required>
            </div>
            
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" placeholder="Enter Email" name="email" required>
            </div>
            
            <div class="input-group">
                <label for="mobile">Mobile Number</label>
                <input type="text" placeholder="Enter Mobile Number" name="mobile" required>
            </div>
            
            <div class="input-group">
                <label for="add">Address</label>
                <input type="text" placeholder="Enter Address" name="add" required>
            </div>
            
            <div class="input-group">
                <label for="pass">Password</label>
                <input type="password" placeholder="Enter Password" name="pass" required>
            </div>
            
            <div class="input-group">
                <label for="cpass">Confirm Password</label>
                <input type="password" placeholder="Confirm Password" name="cpass" required>
            </div>
            
            <p class="terms">By clicking Register, you agree to our <a href="#">Terms & Conditions</a></p>
            
            <button type="submit" name="register-btn" class="btn">REGISTER</button>
            
            <div class="divider">
                <span>or</span>
            </div>
            
            <p class="login-link">Already have an account? <a href="#">Sign In</a></p>
        </form>
    </div>
</body>
</html>
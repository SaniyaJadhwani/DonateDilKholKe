<?php
 if(isset($_POST['login-btn']))
 {
    $uname=filter_input(INPUT_POST,'uname');
    $pass=filter_input(INPUT_POST,'pass');
    $c=0;
   
    $con = new mysqli("localhost","Saniya","","idwebapp");
    if($con->connect_error)
    {
       die("Failed to connect");
    }
    else
    {
     $sql="SELECT Username,Password FROM admin";
     $result=$con->query($sql);
     if($result->num_rows>0)
     {
       while($row=$result->fetch_assoc())
       {
         if ($row["Username"] == $uname && $row["Password"] == $pass) {
           echo "<script>alert('Welcome Admin')</script>";
           $c++;
           $uid=$row["Uid"];
           echo "<script>window.location.href='AdminPanel.php';</script>";
           exit();
       }
       
       }
       if($c==0)
       echo "<script>alert('Invalid Username or Password')</script>";
     }
     else{
       echo "Results Not found";
     }
     $con->close();
    } 
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins",sans-serif; 
 }
 body{
     display:flex;
     justify-content: center;
     align-items:center;
     min-height: 100vh;
     background: url(Images/bg2.jpg)no-repeat;
     background-size: cover;
     background-position: center;
 }
 .wrapper{
     width: 420px;
     background: transparent;
     border: 2px solid rgba(255,255,255,.2);
     backdrop-filter: blur(10px);
     color: #fff;
     border-radius: 12px;
     padding: 30px 40px;
 }
 .wrapper h1{
     font-size: 36px;
     text-align: center;
 }
 .wrapper .input-box{
     width: 100%;
     height: 50px;
     position:relative;
     margin:30px 0;
 }
 .input-box input{
     width:100%;
     height:100%;
     background:transparent;
     border: none;
     outline: none;
     border: 2px solid rgba(255,255,255,.2);
     border-radius: 40px;
     font-size: 16px;
     color: #fff;
     padding: 20px 45px 20px 20px;
 }
 .input-box input::placeholder{
     color: #fff;
 }
 .input-box i{
     position: absolute;
     right: 20px;
     top:30%;
     transform: translate(-50%);
     font-size: 20px;
 }
 
 
 .wrapper .btn{
     width: 100%;
     height: 45px;
     background: #fff;
     border:none;
     outline:none;
     border-radius: 40px;
     box-shadow: 0 0 10px rgba(0,0,0,.1);
     cursor: pointer;
     font-size: 16px;
     color: #333;
     font-weight: 600;
 }

 </style>
</head>
<body>
   <div class="wrapper">
    <form action="" method="post">
        <h1>Admin Login</h1>
        <div class="input-box">
            <input type="text" placeholder="Username" name="uname" required>
            <i class='bx bx-user'></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Password" name="pass" required>
            <i class='bx bxs-lock'></i>
        </div>
        <button type="submit" class="btn" name="login-btn">Login</button>

    </form>
   </div>
</body>
<script>

</script>
</html>
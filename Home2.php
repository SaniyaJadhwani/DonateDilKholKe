<?php
$uid = $_GET['uid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        @import url("D:\Poppins-Regular.ttf");
*{
    margin:0;
    padding:0;
    
}
body{
    overflow-x: hidden;
    background-color: rgb(246, 234, 234);
}

.nav1{
    width:100%;
    height:60px;
    display: flex;
    flex-direction: row;
    color:rgb(0, 0, 0);
    padding:30px 50px 30px 30px;
    
}
.nav1 p{
    font-size: 40px;
    font-weight: bolder;
    word-spacing: 10px;
    font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    margin-right: 1050px;

}
.bu{
    margin: 20px 10px 0px 0px;
    width:100px;
    height:35px;
    background-color: rgb(172, 95, 95);
    border: 2px solid white;
    font-size: 20px;
    padding:10px 10px 5px 10px;
    text-align: center;
    border-radius:10px;
    text-decoration: none;
    color:rgb(255, 255, 255);
    
}
.bu:hover{
   transform: translateY(-5px);
   color:rgb(53, 6, 3);

}
.nav2{
    width:100%;
    background-color: rgb(236, 188, 188);
    height: 50px;
    padding: 40px 20px 20px 20px;
}
.n2{
    text-decoration: none;
    width:80px;
    height:40px;
    border-radius: 5px;
    background-color: rgb(172, 95, 95);
    border: 2px solid white;
    margin:0px 0px 130px 130px;
    padding:10px 10px 10px 10px;
    font-size: 20px;
    color:rgb(255, 255, 255);
}
.n2:hover{
    color:rgb(53, 6, 3);
}
#hdecors3{
    width:80%;
    height:75vh;
    padding: 30px 30px 30px 30px;
    margin:auto;
    background-image: url("Images/mainbg.jpg");
    background-size: cover;
}
 #hdecors3 #sp{
    font-size: 17px;
    color: rgb(2, 2, 33);
    position: relative;
    top:40%;
    left: 20%;
     
    font-family:Arial, Helvetica, sans-serif;
    text-decoration: solid;
    width:86% ;
    letter-spacing: 5px;
    white-space: nowrap;
   overflow: hidden;
    animation: typing 2s steps(59),cursor .4s infinite alternate;
     
      animation-iteration-count: infinite;
     
}
@keyframes cursor{
    
    50%{
        border-color: transparent;

    }
}
@keyframes typing {
    from{ 
        width: 0;
    }
    

}
#hdecors3 #sp1{
    position: relative;
    top:40%;
    color: rgb(32, 11, 108);
    left: 20%;
    font-size: 40px;
     padding:30px 30px 30px 30px;
    font-family:Arial, Helvetica, sans-serif;
    text-decoration: solid;
    width:86% ;
    letter-spacing: 5px;
    white-space: nowrap;
   overflow: hidden;
    animation: typing 2s steps(42),cursor .4s infinite alternate;
     
      animation-iteration-count: infinite;
     
}
@keyframes cursor{
    
    50%{
        border-color: transparent;

    }
}
@keyframes typing {
    from{ 
        width: 0;
    }
    
}

.deals{
    width:100%;
    height:220px;
    display: flex;
 

    flex-direction: row;
}
#deal1{
   background-image: url("Images/sale1.jpg");
  height:100%;
  width:100%;
  margin: 20px 20px 20px 20px;
   background-size: cover;
}
#deal2{
    background-image: url("Images/sale2.jpg");
    height:100%;
  width:100%;
  margin: 20px 20px 20px 20px;
    background-size: cover;

}

#hdecors{
    width:80%;
    height:75vh;
    padding: 30px 30px 30px 30px;
    margin:auto;
    background-image: url("Images/design5.jpg");
    background-size: cover;
}
#hdecors p{
    position: relative;
    top:40%;
    color: rgb(223, 207, 207);
    left: 10%;
    font-size: 40px;
     
    font-family:Arial, Helvetica, sans-serif;
    text-decoration: solid;
    width:86% ;
    white-space: nowrap;
   overflow: hidden;
    animation: typing 3s steps(55),cursor .4s infinite alternate;
     
      animation-iteration-count: infinite;
     
}
@keyframes cursor{
    
    50%{
        border-color: transparent;

    }
}
@keyframes typing {
    from{ 
        width: 0;
    }
    
}
#hdecors button{
    position: relative;
    top:50%;
    left:39%;
    padding:10px 0px 10px 10px;
    width:260px ;
    background-color: rgb(214, 94, 94);
    color:white;
    border-radius: 15px;
    font-size: 19px;
}
#hdecors1{
    width:80%;
    height:75vh;
    padding: 30px 30px 30px 30px;
    margin:auto;
    background-image: url("Images/design4.jpg");
    background-size: cover;
}
#hdecors1 p{
    position: relative;
    top:40%;
    color: rgb(3, 44, 133);
    left: 25%;
    font-size: 40px;
    font-family:Arial, Helvetica, sans-serif;
    text-decoration: solid;
    width:86% ;
    white-space: nowrap;
   overflow: hidden;
    animation: typing 3s steps(29),cursor .4s infinite alternate;
     
      animation-iteration-count: infinite;
     
}
@keyframes cursor{
    
    50%{
        border-color: transparent;

    }
}
@keyframes typing {
    from{ 
        width: 0;
    }
    
}  
  
#hdecors1 button{
    position: relative;
    top:50%;
    left:40%;
    padding:10px 0px 10px 10px;
    width:260px ;
    background-color: rgb(20, 20, 72);
    color:rgb(255, 255, 255);
    border-radius: 15px;
    font-size: 19px;
}
#hdecors2{
    width:80%;
    height:75vh;
    padding: 30px 30px 30px 30px;
    margin:auto;
    background-image: url("Images/paint.jpg");
    background-size:80%;
}
#hdecors2 p{
    position: relative;
    top:30%;
    color: rgb(144, 27, 120);
    left:8%;
    font-size: 40px;
    font-family:Arial, Helvetica, sans-serif;
    text-decoration: solid;
    width:90% ;
    white-space: nowrap;
   overflow: hidden;
    animation: typing 3s steps(56),cursor .4s infinite alternate;
     
      animation-iteration-count: infinite;
     
}
@keyframes cursor{
    
    50%{
        border-color: transparent;

    }
}
@keyframes typing {
    from{ 
        width: 0;
    }
    
}
   
#hdecors2 button{
    position: relative;
    top:40%;
    left:35%;
    padding:10px 0px 10px 10px;
    width:360px ;
    background-color: rgb(81, 6, 61);
    color:rgb(255, 255, 255);
    border-radius: 15px;
    font-size: 19px;
}
#hdecors4{
    width:80%;
    height:75vh;
    padding: 30px 30px 30px 30px;
    margin:auto;
    background-image: url("Images/fur.jpg");
    background-size: cover;
}
#hdecors4 p{
    position: relative;
    top:40%;
    color: rgb(255, 255, 255);
    left: 25%;
    font-size: 40px;
    font-family:Arial, Helvetica, sans-serif;
    text-decoration: solid;
    width:86% ;
    white-space: nowrap;
   overflow: hidden;
    animation: typing 3s steps(40),cursor .4s infinite alternate;
     
      animation-iteration-count: infinite;
     
}
@keyframes cursor{
    
    50%{
        border-color: transparent;

    }
}
@keyframes typing {
    from{ 
        width: 0;
    }
    
}  
  
#hdecors4 button{
    position: relative;
    top:50%;
    left:40%;
    padding:10px 0px 10px 10px;
    width:260px ;
    background-color: rgb(191, 7, 7);
    color:rgb(255, 255, 255);
    border-radius: 15px;
    font-size: 19px;
}
.t1{
    padding:70px 70px 70px 70px;
    position: relative;
    width:87%;
    height:316.8px;
    margin:auto;
    background-color: rgb(190, 190, 190);
}
.ul1{
    list-style: none;
}
#gee{
    width:200px;
}
.ul1 li a{
    text-decoration: none;
    font-size: 18px;
    line-height: 30px;
    color:#070707;
}
.ul1 li a:hover{
    text-decoration: underline;
}
</style>
</head>
<body>
    <div class="home">
    <div class="nav1">
        <p>STYLING SPACE</p>
        <a class="bu" href="Index.php">Logout</a>
    </div>
    <hr>
   
    <div class="nav2">
        <a class="n2" href="Furniture.php?uid=<?php echo $uid?>">Furniture</a>
        <a class="n2" href="DecorItems.php?uid=<?php echo $uid?>">Home Decor</a>
        <a class="n2" href="plants.php?uid=<?php echo $uid?>">House Plants</a> 
        <a class="n2" href="paints.php?uid=<?php echo $uid?>">Paint</a> 
        <a class="n2" href="Inspiration.php">Inspiration</a>
        <a class="n2" href="AddToCart.php?uid=<?php echo $uid?>">View Cart</a>    
      </div>
     
      <br>
      
</div>
<div id="hdecors3">
    <b><p id="sp1">WELCOME TO STYLING SPACE!</p></b>
    <p id="sp">Now decorating your own space becomes creative and innovative!</p>
 </div><br>
 <br>
<div class="deals">
    <a id="deal1" href="#"></a>
    <a id="deal2" href="#"></a>
</div>
<br>
<br>
<br>
 <div id="hdecors">
    <b><p>Designing your Comfort place with Affordable products .</p></b>
    <a href="DecorItems.php?uid=<?php echo $uid?>"><button id="ditem">Visit The Decor Items</button></a>a
 </div><br>
 <br>
 <div id="hdecors1">
    <b><p>Want Help from Professionals? </p></b>
    <button id="ditem1">Click to Get a Consellor</button>
 </div>
 <br> 
 <br>
 <div id="hdecors2">
    <b><p>Pick Cozy Colors to Enhance your Dream House ! </p></b>
    <a href="paints.php?uid=<?php echo $uid?>"><button id="ditem2">Click here to Select Paints and Colors</button></a>
 </div>
 <br>
 <br>
 <div id="hdecors4">
    <b><p>Get Elegant and classy Furniture ! </p></b>
    <a href="Furniture.php?uid=<?php echo $uid?>"><button id="ditem4">Click here to view Furniture</button></a>
 </div>
 <br>
 <br>
 <table class="t1">
    <tbody><tr align="left">
    <th>SHOP</th>
    <th>CORPORATE INFO</th>
    <th>HELP</th>
</tr>
<tr>
    <td><ul class="ul1">
        <li><a href="#">Furnitures</a></li>
        <li><a href="#">Home decor</a></li>
        <li><a href="#">Frames</a></li>
        <li><a href="#">Paint</a></li>
        <li><a href="#">Exterior</a></li>
        <li><a href="#">Plants</a></li>
    </ul></td>
    <td>
        <ul class="ul1">
            <li><a href="#">Career at Home Decor</a></li>
            <li><a href="#">About Home Decor Group</a></li>
            <li><a href="#">About Creators of Home Decor</a></li>
            <li><a href="#">Investor Relations</a></li>
        </ul></td>
    <td>
        <ul class="ul1">
          
            <li><a href="#">Customer Service</a></li>
            <li><a href="#">My Home Decor</a></li>
            <li><a href="#">Find a Store</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#"> Report a Scam</a></li>
            <li><a href="#">Cookie Notice</a></li>
            <li><a href="#">Cookies Setting</a></li>
        </ul>
    </td>
    <td><ul class="ul1">
        
        <li><div id="gee">Sign up now and be the first to know about exclusive offers and latest Home styling tips!</div></li>
        
    </ul></td>
</tr>

</tbody></table>
  </body>
  </html>  
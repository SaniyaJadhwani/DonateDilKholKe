<?php
$uid = $_GET['uid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="paints.css">
    <title>Document</title>
</head>
<body>
    <div id="gt">P A I N T S</div>
    <div class="main">
        <table>
            <div class="com">
            <tr>
                <td rowspan="2" id="tr1td1"><h2>Choose A company To view Their Variety of Colors </h2>
                <td id="tr1td2"><h2><a href="berger.php?uid=<?php echo $uid?>"><div class="com1"><img src="Images/berger.png"></div></a></h2></td>
                <td id="tr1td3"><h2><a href="asianpaints.php?uid=<?php echo $uid?>"><div class="com1"><img src="Images/asianpaints.png"></div></a></h2></td>
            </tr>
            <tr>
                <td id="tr2td1"><h2><a href="dulux.php?uid=<?php echo $uid?>"> <div class="com1"><img src="Images/dulux.png"></div></a></h2></td>
                <td id="tr2td2"><h2></h2></td>
            </tr>
        </table>
    </div>
</div>    
</body>
</html>
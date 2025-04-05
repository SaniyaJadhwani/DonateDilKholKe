<?php
 $mysqli=new mysqli("localhost","Saniya","","idwebapp");
 
 if($mysqli->connect_error!=0)
 {
    echo $mysqli->connect_error;
 }

 $json_data=file_get_contents("Products.json");
 $products=json_decode($json_data,JSON_OBJECT_AS_ARRAY);

 $stmt=$mysqli->prepare("INSERT INTO products(pid,name,price,image,type,quantity)VALUES(?,?,?,?,?,?)");
 $stmt->bind_param("ssssss",$id,$name,$price,$image,$type,$quantity);
 $quantity=10;
 $inserted_rows=0;
 foreach($products as $product)
 {
    $id=$product["id"];
    $name=$product["name"];
    $price=$product["price"];
    $image=$product["image"];
    $type=$product["type"];

    $stmt->execute();
    $inserted_rows++;
 }
 if(count($products)==$inserted_rows)
  echo"success";
 else
  echo"error";
?>
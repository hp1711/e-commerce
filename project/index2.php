<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

// $servername = "harsh.sedani";
// $username = "root";
// $password = "Harsh@1230";
// $dbname ="ecom";

// try { 
//   $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
//   // set the PDO error mode to exception
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully";
// } catch(PDOException $e) {
//   echo "Connection failed: " . $e->getMessage();
// }
$url="http://harsh.api/";

$data_json=file_get_contents($url);
$p1=json_decode($data_json,true);

print_r($p1);

// foreach ( $products as $v){
//   $sq = 'INSERT INTO product_table (id,title,description,price,discountPercentage,rating,stock,brand,category,thumbnail) 
// VALUES (:id,:title,:description,:price,:discountPercentage,:rating,:stock,:brand,:category,:thumbnail)';

// $sql=$conn->prepare($sq);

// $sql->bindParam("id",$v['id']);
// $sql->bindParam("title",$v['title']);
// $sql->bindParam("description",$v['description']);
// $sql->bindParam("price",$v['price']);
// $sql->bindParam("discountPercentage",$v['discountPercentage']);
// $sql->bindParam("rating",$v['rating']);
// $sql->bindParam("stock",$v['stock']);
// $sql->bindParam("brand",$v['brand']);
// $sql->bindParam("category",$v['category']);
// $sql->bindParam("thumbnail",$v['thumbnail']);


// $sql->execute();  
//   foreach($v['images'] as $p){

  

// $img='INSERT INTO images (id,image) VALUES (:id,:image)';

// $sql1=$conn->prepare($img);

// $sql1->bindParam('id',$v['id']);
// $sql1->bindParam('image',$p);

// $sql1->execute();

//}
//}

//   echo "done";



// $conn = null;


?>
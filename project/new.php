<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname ="ecom";

try { 
  $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}





$data_json=file_get_contents('https://dummyjson.com/products?limit=100');
$p1=json_decode($data_json,true);
$products=$p1['products'];


foreach ( $products as $v){

  $brand = isset($v['brand']) ? $v['brand'] : 'Unknown';

  $sq = 'INSERT INTO product_table (id,title,description,price,discountPercentage,rating,stock,brand,category,thumbnail,returnPolicy,warrantyInformation) 
VALUES (:id,:title,:description,:price,:discountPercentage,:rating,:stock,:brand,:category,:thumbnail,:returnPolicy,:warrantyInformation)';

$sql=$conn->prepare($sq);

$sql->bindParam("id",$v['id']);
$sql->bindParam("title",$v['title']);
$sql->bindParam("description",$v['description']);
$sql->bindParam("price",$v['price']);
$sql->bindParam("discountPercentage",$v['discountPercentage']);
$sql->bindParam("rating",$v['rating']);
$sql->bindParam("stock",$v['stock']);
$sql->bindParam("brand",$brand);  
$sql->bindParam("category",$v['category']);
$sql->bindParam("thumbnail",$v['thumbnail']);
$sql->bindParam("returnPolicy",$v['returnPolicy']);
$sql->bindParam("warrantyInformation",$v['warrantyInformation']);


$sql->execute();  


  }

  echo "done";



$conn = null;






?> 


<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "harsh.sedani";
$username = "root";
$password = "Harsh@1230";
$dbname ="ecom";

try { 
  $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}



$sql = $conn->prepare('SELECT * FROM product_table');
    $sql->execute();


    $pro_data = $sql->fetchAll(PDO::FETCH_ASSOC);


    // print_r($pro_data);
    foreach($pro_data as $h){
      echo json_encode($h)."<br>";
    }

    

?>
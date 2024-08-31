<?php
// include 'index.php';

// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
// print_r($_GET);
$x=$_GET['path'];
$get=explode("/",$x);
session_start();
// print_r($_GET);
// echo $get[1];






$servername = "harsh.sedani";
$username = "root";
$password = "Harsh@1230";
$dbname ="ecom";

try { 
  $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
}
catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}





//=========================data selection from database=======================================//
$sql = " select h.id , h.title, h.description, h.price, h.discountPercentage, h.rating, h.stock,  h.brand  ,h.category,h.thumbnail, GROUP_CONCAT(i.image) as images
from 
product_table as h
left join 
images as i on h.id = i.id
group by 
h.id , h.title, h.description, h.price, h.discountPercentage, h.rating, h.stock,  h.brand  ,h.category, h.thumbnail";

$sql1 = $conn->prepare($sql);
$sql1->execute();

$result = $sql1->fetchAll(PDO::FETCH_ASSOC);


// $final_data = array();

foreach ($result as $h) {
  
  $images = explode(',', $h['images']);
  
   unset($h['images']);

    $h['images'] = $images;
    $final_data[] = $h;
    $final_data1['products']=$final_data;
}

// $new_arr=json_encode($final_data1,JSON_PRETTY_PRINT);
// print_r(json_encode($final_data1,JSON_PRETTY_PRINT));





if(!empty($_POST['u_name'])){
  try { 
    $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  $pass=password_hash($_POST['u_pass'],PASSWORD_BCRYPT);

  $sq = 'INSERT INTO credentials (name,address,pincode,email,password,role) 
  VALUES (:name,:address,:pincode,:email,:password,:role)';
  
  $sql=$conn->prepare($sq);
  
  $sql->bindParam("name",$_POST['u_name']);
  $sql->bindParam("address",$_POST['u_address']);
  $sql->bindParam("pincode",$_POST['u_pincode']);
  $sql->bindParam("email",$_POST['u_email']);
  $sql->bindParam("password",$pass);
  $sql->bindParam("role",$_POST['role']);

  
  
  $sql->execute();  
  
// echo 'done';

}

elseif(!empty($_POST['s_name'])){
  try { 
    $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  $pass=password_hash($_POST['s_pass'],PASSWORD_BCRYPT);

  $sq = 'INSERT INTO credentials (name,address,pincode,email,password,role) 
  VALUES (:name,:address,:pincode,:email,:password,:role)';
  
  $sql=$conn->prepare($sq);
  
  $sql->bindParam("name",$_POST['s_name']);
  $sql->bindParam("address",$_POST['s_address']);
  $sql->bindParam("pincode",$_POST['s_pincode']);
  $sql->bindParam("email",$_POST['s_email']);
  $sql->bindParam("password",$pass);
  $sql->bindParam("role",$_POST['role']);

  
  
  $sql->execute();  
  
// echo 'done';

}

elseif(!empty($_POST['d_name'])){
  try { 
    $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  $pass=password_hash($_POST['s_pass'],PASSWORD_BCRYPT);

  $sq = 'INSERT INTO credentials (name,address,pincode,email,password,role) 
  VALUES (:name,:address,:pincode,:email,:password,:role)';
  
  $sql=$conn->prepare($sq);
  
  $sql->bindParam("name",$_POST['d_name']);
  $sql->bindParam("address",$_POST['d_address']);
  $sql->bindParam("pincode",$_POST['d_pincode']);
  $sql->bindParam("email",$_POST['d_email']);
  $sql->bindParam("password",$pass);
  $sql->bindParam("role",$_POST['role']);

  
  
  $sql->execute();  
  
// echo 'done';

}

elseif(!empty($_POST['l_email'])){
  try { 
    $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
        $sq='SELECT * FROM credentials';
        $sql=$conn->prepare($sq);
        $sql->execute(); 
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $i=0;
        $j=0;
        
        
      foreach($result as $v){
       
       if($v['email']==$_POST['l_email'] && password_verify($_POST['l_pass'],$v['password'])){
              // $name=$v['name'];
           $i++;
       }
       else{
           $j++;
       }
      }
      // echo $j;
  

      if($i==1){
        $found=1;
      
      }
      else{
        $found=0;
      }
   echo $found."";
   echo session_id()."<hr>";
   
    }

else{
  //===============================for category=======================================//
  if($get[1]=='products' && $get[2]=='category' && empty($get[3])){
    foreach($final_data1['products'] as $h){
      $ans[]=$h['category'];
    }
  
    print_r(json_encode(array_values(array_unique($ans)),JSON_PRETTY_PRINT));
    // echo "harsh";
    
  }

//=============================for spicific category================================//

elseif($get[1]=='products' && $get[2]=='category' && !empty($get[3])){
    foreach($final_data1['products'] as $h){
      if($h['category']==$get[3]){
        $ans[]=$h;
      }
    }
  
    print_r(json_encode(array_values($ans),JSON_PRETTY_PRINT));
  }

//=============================for spicific product================================//


elseif($get[1]=='products' && !empty($get[2])){
    foreach ($final_data1['products'] as $h) {
        if($h['id']==$get[2]){
          $ans[]=$h;
          $ans1['products']=$ans;
        }
      }
      print_r(json_encode($ans1,JSON_PRETTY_PRINT));
      
}
//======================for limit and only===============================//
elseif($get[1]=='products' && !empty($_GET['limit']) && empty($_GET['skip'])){
    $limit=explode('/',$_GET['limit']);
    foreach($final_data1['products'] as $h){
      if($h['id'] <= $limit[0]){
        $ans[]=$h;
        $ans1['products']=$ans;
      }
    }
    echo(json_encode($ans1,JSON_PRETTY_PRINT));
    
}


//======================for limit and skip both===============================//
elseif($get[1]=='products' && !empty($_GET['limit']) && !empty($_GET['skip'])){
    $skip=explode('/',$_GET['skip']);

    foreach($final_data1['products'] as $h){
        if($h['id']>$skip[0] && $h['id']<=$_GET['limit']+$skip[0]){
          $ans[]=$h;
          $ans1['products']=$ans;
        }
      }
      echo(json_encode($ans1,JSON_PRETTY_PRINT));
}

// elseif($get[1]=='prodcuts' && !empty($_GET['search']) ){
//     $search_s= 'SELECT * from product_table description like :search1 or title like :search2 or brand like :search3 or category like :search4';
//     $sq=$conn->prepare($search_s);
//     // $sq->execute([":search1"=>"%$search%",":search2"=>"%$search%",":search3"=>"%$search%",":search4"=>"%$search%"]);
//     $sq->bindValue(':search2','%$search2%',PDO::PARAM_STR);
//     $result_s = $sq->fetchAll(PDO::FETCH_ASSOC);
  
//     print_r(json_encode($result_s,JSON_PRETTY_PRINT));
    
//     // echo "harsh";
  
//   }



  else{
    print_r(json_encode($final_data1,JSON_PRETTY_PRINT));
  }


}

?>
<?php

// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// print_r($_GET);
session_start();

// print_r($_GET);
// echo $get[1];






$servername = "localhost";
$username = "root";
$password = "";
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
$sql = "select * from product_table";

$sql1 = $conn->prepare($sql);
$sql1->execute();

$result = $sql1->fetchAll(PDO::FETCH_ASSOC);


// $final_data = array();

foreach ($result as $h) {
  
 
    $final_data[] = $h;
    $final_data1['products']=$final_data;
}

$new_arr=json_encode($final_data1,JSON_PRETTY_PRINT);
// print_r(json_encode($final_data1,JSON_PRETTY_PRINT));





if(!empty($_POST['u_name'])){
  // try { 
  //   $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
  //   // set the PDO error mode to exception
  //   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //   // echo "Connected successfully";
  // } catch(PDOException $e) {
  //   echo "Connection failed: " . $e->getMessage();
  // }
  $pass=password_hash($_POST['u_pass'],PASSWORD_BCRYPT);

  $sq = 'INSERT INTO credentials (id,name,address,pincode,email,password,role) 
  VALUES (NULL,:name,:address,:pincode,:email,:password,:role)';
  
  $sql=$conn->prepare($sq);
  
  $sql->bindParam("name",$_POST['u_name']);
  $sql->bindParam("address",$_POST['u_address']);
  $sql->bindParam("pincode",$_POST['u_pincode']);
  $sql->bindParam("email",$_POST['u_email']);
  $sql->bindParam("password",$pass);
  $sql->bindParam("role",$_POST['role']);

  
  
  $sql->execute();  
  
// echo 'done';
// die();

}

elseif(!empty($_POST['s_name'])){
  // try { 
  //   $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
  //   // set the PDO error mode to exception
  //   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //   // echo "Connected successfully";
  // } catch(PDOException $e) {
  //   echo "Connection failed: " . $e->getMessage();
  // }
  $pass=password_hash($_POST['s_pass'],PASSWORD_BCRYPT);

  $sq = 'INSERT INTO credentials (id,name,address,pincode,email,password,role) 
  VALUES (NULL,:name,:address,:pincode,:email,:password,:role)';
  
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
  // try { 
  //   $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
  //   // set the PDO error mode to exception
  //   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //   // echo "Connected successfully";
  // } catch(PDOException $e) {
  //   echo "Connection failed: " . $e->getMessage();
  // }
  $pass=password_hash($_POST['d_pass'],PASSWORD_BCRYPT);

  $sq = 'INSERT INTO credentials (id,name,address,pincode,email,password,role) 
  VALUES (NULL,:name,:address,:pincode,:email,:password,:role)';
  
  $sql=$conn->prepare($sq);
  
  $sql->bindParam("name",$_POST['d_name']);
  $sql->bindParam("address",$_POST['d_address']);
  $sql->bindParam("pincode",$_POST['d_pincode']);
  $sql->bindParam("email",$_POST['d_email']);
  $sql->bindParam("password",$pass);
  $sql->bindParam("role",$_POST['role']);

  
  
  $sql->execute();  

  $mul_pincode=explode(',',$_POST['d_pincode']);

  $temp=$_POST['d_name'];


  $s= "SELECT id from credentials where name='$temp'";
  $sql1=$conn->prepare($s);
$sql1->execute(); 
$result1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
$deli_id=$result1[0]['id'];
// echo $deli_id;



  foreach($mul_pincode as $p){
    $new='INSERT INTO dp_detail (dp_id,pincode) VALUES (:d_id,:dpincode)';
    $new1=$conn->prepare($new);
    
    $new1->bindParam("d_id",$deli_id);
    $new1->bindParam("dpincode",$p);

    $new1->execute();




  }


}

elseif(!empty($_SESSION['signin_email'])){


  // try { 
  //   $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
  //   // set the PDO error mode to exception
  //   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //   // echo "Connected successfully";
  // } catch(PDOException $e) {
  //   echo "Connection failed: " . $e->getMessage();
  // }
        $sq='SELECT * FROM credentials';
        $sql=$conn->prepare($sq);
        $sql->execute(); 
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $i=0;
        $j=0;
        
        
      foreach($result as $v){
       
       if($v['email']==$_SESSION['signin_email'] && password_verify($_SESSION['signin_pass'],$v['password'])){
              $name=$v['name'];
              $role=$v['role'];
              $id=$v['id'];
            
           $i++;
       }
       else{
           $j++;
       }
      } 
      $_SESSION['data']=$i;
      $_SESSION['name']=$name;
      $_SESSION['role']=$role;
      $_SESSION['user_id']=$id;
      header('location: /html/index.php');

  //     if($i==1){
  //       $found=1;
      
  //     }
  //     else{
  //       $found=0;
  //     }
  //  echo $found."";
  //  echo session_id()."<hr>";
   
    }



//==========================================add to cart=========================//
elseif(isset($_POST['c_quan'])){
  $cart_usid=$_POST['us_id'];
  $pro_id=$_POST['c_proid'];

  // try { 
  //   $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
  //   // set the PDO error mode to exception
  //   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //   // echo "Connected successfully";
  // } catch(PDOException $e) {
  //   echo "Connection failed: " . $e->getMessage();
  // }


    // echo "hello";

    $sq1= "SELECT pincode from credentials where id= $cart_usid";
    $sql11=$conn->prepare($sq1);
$sql11->execute(); 
$result1 = $sql11->fetchAll(PDO::FETCH_ASSOC);
$user_pincode=$result1[0]['pincode'];
// ^^ user pincode //
// echo $user_pincode;


$sq2="SELECT seller_id from product_table where id=$pro_id ";
$sql22=$conn->prepare($sq2);
$sql22->execute(); 
$result2 = $sql22->fetchAll(PDO::FETCH_ASSOC);
$seller_id=$result2[0]['seller_id'];
//^^  seller id // //for adding in cart table



$sq3= "SELECT pincode FROM credentials where id= $seller_id ";
$sql33=$conn->prepare($sq3);
$sql33->execute(); 
$result3 = $sql33->fetchAll(PDO::FETCH_ASSOC);
$seller_pincode=$result3[0]['pincode'];
//^^ seller pin code //




$sq4= "SELECT * from dp_detail";
$sq44=$conn->prepare($sq4);
$sq44->execute();
$result4 = $sq44->fetchall(PDO::FETCH_ASSOC);
// print_r($result4);
$i=0;
foreach($result4 as $h){
  if($h['pincode']==$user_pincode){
    $i++;
    $ans[]=$h['dp_id'];
  }
}

$deli_final= $ans[0];

if($i>0){

$sq5= "SELECT pincode from dp_detail where dp_id = $deli_final";
$sq55=$conn->prepare($sq5);
$sq55->execute();
$result5 = $sq55->fetchall(PDO::FETCH_ASSOC);
$r=0;
foreach($result5 as $h){
  if($h['pincode']==$seller_pincode){
    $p=$deli_final;
    $r++;
  }
}
if($r>0){
  $f="delivery possible";
$charge=abs(10*($seller_pincode-$user_pincode));

}
else{
  $f="delivery not possible as of now";
}
}

else{
  $f="delivery not possible";
}

// echo $f;  






  $sq = 'INSERT INTO cart (user_id,products_id,quantity,seller_id_cart,status,dp_id_cart,charges) 
  VALUES (:userid,:proid,:quantity,:sellerid,:status,:dp_id,:charge)';
  
  $sql=$conn->prepare($sq);
  
  $sql->bindParam("userid",$_POST['us_id']);
  $sql->bindParam("proid",$_POST['c_proid']);
  $sql->bindParam("quantity",$_POST['c_quan']);
  $sql->bindParam("sellerid",$seller_id);
  $sql->bindParam("status",$f);
  $sql->bindParam("dp_id",$p);
  $sql->bindParam("charge",$charge);


  $sql->execute();  

  $proid=$_POST['c_proid'];

  $new= "SELECT stock from product_table where id=$proid";
  $new1=$conn->prepare($new);
$new1->execute();
$new11 = $new1->fetchall(PDO::FETCH_ASSOC);
$stock= $new11[0]['stock']-$_POST['c_quan'];


$st="UPDATE product_table set stock= $stock where id=$proid";
$stt=$conn->prepare($st);
$stt->execute();
  
die();


 
}
//view cart//

elseif(isset($_POST['view_cart_usid'])){
  try { 
    $conn = new PDO("mysql:host=$servername;dbname=ecom", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  $temp_usid=$_POST['view_cart_usid'];

  // $sq="SELECT products_id,quantity FROM cart where user_id=$temp_usid";

  $sq="SELECT product_table.*, cart.quantity,cart.status,cart.charges from product_table INNER JOIN cart on product_table.id=cart.products_id where cart.user_id = $temp_usid";
  $sql=$conn->prepare($sq);
  $sql->execute(); 
  $result = $sql->fetchAll(PDO::FETCH_ASSOC);




//------------------------------------------------
  // $result[]=$result[0]['id']; working 

  // foreach($result as $h){
  //   $ans[]=$h['id'];
  // }
  // $result['new']=$ans;

  // print_r(json_encode($result,JSON_PRETTY_PRINT));
//  echo json_encode($result);

//--------------------------------------------
echo (json_encode($result,JSON_PRETTY_PRINT));
die();
}


elseif(isset($_POST['add_title'])){
  $sq = 'INSERT INTO product_table (id,title,description,price,discountPercentage,rating,stock,brand,category,thumbnail,seller_id) 
  VALUES (NULL,:title,:description,:price,:discountPercentage,:rating,:stock,:brand,:category,:thumbnail,:seller_id)';
  
  $sql=$conn->prepare($sq);
  

  $sql->bindParam("title",$_POST['add_title']);
  $sql->bindParam("description",$_POST['add_desc']);
  $sql->bindParam("price",$_POST['add_price']);
  $sql->bindParam("discountPercentage",$_POST['add_discount']);
  $sql->bindParam("rating",$_POST['add_rating']);
  $sql->bindParam("stock",$_POST['add_stock']);
  $sql->bindParam("brand",$_POST['add_brand']);
  $sql->bindParam("category",$_POST['add_category']);
  $sql->bindParam("thumbnail",$_POST['add_image']);
  $sql->bindParam("seller_id",$_POST['seller_id']);

  $sql->execute(); 

  echo "done";
  
 
}

//seller my products
elseif(isset($_POST['view_product'])){
  $temp17=$_POST['view_product'];
 
$sq= "SELECT * FROM product_table where seller_id= $temp17";
$sql=$conn->prepare($sq);
$sql->execute(); 
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
echo (json_encode($result,JSON_PRETTY_PRINT));


die();

}

// when place the order //

elseif($_POST['total_charge']){
        
          $us_id=$_POST['us_id'];
          $sq1= "SELECT * from cart where user_id= $us_id and status='delivery possible'";
          $sql1=$conn->prepare($sq1);
          $sql1->execute(); 
          $result = $sql1->fetchAll(PDO::FETCH_ASSOC);

          foreach($result as $h){
            $result2[]=$h;
          }


          //for orders list table

          foreach($result2 as $h){
            $y+=$h['charges'];
          }


          $s="SELECT price,discountPercentage,cart.quantity from product_table inner join cart on cart.products_id=product_table.id where cart.user_id= $us_id";
          $s1=$conn->prepare($s);
          $s1->execute(); 
          $r = $s1->fetchAll(PDO::FETCH_ASSOC);

            foreach($r as $r1){
              $r_ans+=round(($r1['price']/100)*(100-$r1['discountPercentage']),2)*$r1['quantity'];
            }
            $f= $r_ans+$y;
            echo $f;



          $n="INSERT INTO order_main (total,us_id,p_method,f_status) values (:total,:u_id,'Paypal','pending')";
          $n1=$conn->prepare($n);
          $n1->bindParam("total",$f);
          $n1->bindParam("u_id",$us_id);
          $n1->bindParam("pm",$_POST['payment_method']);
          // $n1->bindParam("pm",$_POST['payment_method']);


          $n1->execute();
          $o=$conn->lastInsertId();
        





          
          foreach($result2 as $h1){
            if($us_id=$h1['user_id']){
              $total=$h1['charges'];
            }
          }


          foreach($result2 as $h){

            $sq= "INSERT INTO orders (id,product_id_or,seller_id_or,dp_id_or,quantity_or,charge_or,status_or,user_id_or,pay_method) 
            values (:t_id,:pro_id,:s_id,:d_id,:qn,:charge,'pending',:us_id,'Paypal')";

            $sql=$conn->prepare($sq);
            $sql->bindParam("t_id",$o);

            $sql->bindParam("pro_id",$h['products_id']);
            $sql->bindParam("s_id",$h['seller_id_cart']);
            $sql->bindParam("d_id",$h['dp_id_cart']);
            $sql->bindParam("qn",$h['quantity']);
            $sql->bindParam("charge",$f);
            $sql->bindParam("us_id",$us_id);
            // $sql->bindParam("pay",$_POST['payment_method']);




            $sql->execute();

          }

          $sq2="DELETE FROM cart where user_id = $us_id";
          $sql2=$conn->prepare($sq2);
          $sql2->execute();
          die();

}
//end of place

elseif(isset($_POST['my_order'])){
  $us_id=$_POST['user_i'];


        $sq= "SELECT product_table.*,orders.status_or,orders.quantity_or,orders.charge_or,orders.pay_method from product_table INNER JOIN orders on product_table.id= orders.product_id_or where orders.user_id_or=$us_id";
        // $sq= "SELECT * from order_main where us_id=$us_id";
        // $sq="SELECT * FROM order_main inner join orders on orders.id=order_main.order_id where order_main.us_id=$us_id";
        $sql=$conn->prepare($sq);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo (json_encode($result,JSON_PRETTY_PRINT));
        die();
}


elseif($_POST['seller_own_pro']){
  $us_id=$_POST['seller_own_pro'];

  $sq= "SELECT product_table.*,orders.quantity_or,orders.status_or,orders.seller_id_or from product_table INNER JOIN orders on product_table.id= orders.product_id_or where orders.seller_id_or=$us_id";
  
$sql=$conn->prepare($sq);
$sql->execute(); 
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
echo (json_encode($result,JSON_PRETTY_PRINT)); 
die();

}
            
elseif($_POST['ship_order_id']){
  $us_id=$_POST['ship_order_id'];
      $sq="UPDATE orders set status_or='order has been shipped,Delivery on the way, thanks for your patience' where seller_id_or=$us_id and status_or='pending'";
      $sql=$conn->prepare($sq);
      $sql->execute();
      die();

}


elseif(isset($_POST['dp_own_pro'])){
  $us_id=$_POST['dp_own_pro'];

  $sq= "SELECT credentials.*,orders.charge_or,orders.status_or,orders.product_id_or from credentials inner join orders on orders.user_id_or= credentials.id where dp_id_or=$us_id";
  
$sql=$conn->prepare($sq);
$sql->execute(); 
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
echo (json_encode($result,JSON_PRETTY_PRINT)); 

die();  
}

elseif(isset($_POST['my_all'])){
  $d=$_POST['my_all'];
  $us_id=$_POST['user_id_view'];


  $sq= "SELECT product_table.*, orders.status_or, orders.quantity_or, orders.d_date 
  FROM product_table 
  INNER JOIN orders ON product_table.id = orders.product_id_or 
  WHERE orders.user_id_or = $us_id";
  $sql=$conn->prepare($sq);
$sql->execute(); 
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
echo (json_encode($result,JSON_PRETTY_PRINT)); 
// echo "hello";
die();
}

if(isset($_POST['dp_pro']) ){
  

  $r=$_POST['dp_pro'];
          $n="UPDATE orders set status_or='delivered' where product_id_or=$r"; 
          $n1=$conn->prepare($n);
          $n1->execute();

          $r1="UPDATE orders set d_date=CURRENT_DATE() where product_id_or=$r";
          $r11=$conn->prepare($r1);
          $r11->execute();
          
         
      
          



          
}








else{
  $x=$_GET['path'];
$get=explode("/",$x);
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

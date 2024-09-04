<?php
// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1);
// error_reporting(-1);
session_start();
// var_dump($_POST);


// echo "Hello World from test.php";
require_once 'vendor/autoload.php';
$data=$_GET;

//payment done


if($_GET['PayerID']!=null){
     

    echo $twig->render('success.html', array('roles' => $_SESSION['name'], 'payment' => $_GET['PayerID']));
    die();
    // echo $twig -> render('seller.html',array('roles'=>$_SESSION['name'],"products"=>$ans,'earn'=>$earn,'previous'=>$pre_order));

}



// echo $data;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader =new FilesystemLoader('.');
$twig = new Environment($loader);




if(isset($_POST['user_name'])){
    
    $name_user= $_POST['user_name'];
    $address_user=$_POST['user_address'];
    $pincode_user=$_POST['user_pincode'];
    $email_user=$_POST['user_email'];
    $pass_user=$_POST['user_pass'];

    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/html/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('u_name'=>$name_user,'u_address'=>$address_user,'u_pincode'=>$pincode_user,
      'u_email'=>$email_user,'u_pass'=>$pass_user,'role'=>'user'
      
      )
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    

}

elseif(isset($_POST['seller_name'])){
    $name_seller= $_POST['seller_name'];
    $address_seller=$_POST['seller_address'];
    $pincode_seller=$_POST['seller_pincode'];
    $email_seller=$_POST['seller_email'];
    $pass_seller=$_POST['seller_pass'];

    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/html/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('s_name'=>$name_seller,'s_address'=>$address_seller,'s_pincode'=>$pincode_seller,
      's_email'=>$email_seller,'s_pass'=>$pass_seller,'role'=>'seller'
      
      )
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    // echo "hwllo";
}

elseif(isset($_POST['deli_name'])){
    $name_deli= $_POST['deli_name'];
    $address_deli=$_POST['deli_address'];
    $pincode_deli=$_POST['deli_pincode'];
    $email_deli=$_POST['deli_email'];
    $pass_deli=$_POST['deli_pass'];

    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/html/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('d_name'=>$name_deli,'d_address'=>$address_deli,'d_pincode'=>$pincode_deli,
      'd_email'=>$email_deli,'d_pass'=>$pass_deli,'role'=>'delivery partner'
      
      )
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
}


elseif(isset($_POST['signin_email'])){
    $email_signin= $_POST['signin_email'];
    $pass_signin=$_POST['signin_pass'];

    $_SESSION['signin_email']=$email_signin;
    $_SESSION['signin_pass']=$pass_signin;

    header('location: /html/index3.php');

//    var_dump($_SESSION['data']);  
  
    
    // $curl = curl_init();

    // curl_setopt_array($curl, array(
    //   CURLOPT_URL => 'harsh.sedani/index3.php',
    //   CURLOPT_RETURNTRANSFER => true,
    //   CURLOPT_ENCODING => '',
    //   CURLOPT_MAXREDIRS => 10,
    //   CURLOPT_TIMEOUT => 0,
    //   CURLOPT_FOLLOWLOCATION => true,
    //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //   CURLOPT_CUSTOMREQUEST => 'POST',
    //   CURLOPT_POSTFIELDS => array('l_email'=>$email_signin,'l_pass'=>$pass_signin
      
    //   )
    // ));
    
    // $response = curl_exec($curl);
    
    // curl_close($curl);
    // echo $response;
    
    // if($response==0){
    //     $found="password or username is wrong, please try again";
    //     echo $twig -> render('login.html',array('check'=>$found));
    //     // echo "hello";
    //     die();
    // }
    // else{
    //         // session_start();
    //         echo session_id();
    // }

}
//add products by seller//

elseif(isset($_POST['s_title'])){
    $s_id= $_SESSION['user_id'];
    $s_title= $_POST['s_title'];
    $s_desc=$_POST['s_desc'];
    $s_price=$_POST['s_price'];
    $s_discount=$_POST['s_discount'];
    $s_rating=$_POST['s_rating'];
    $s_stock=$_POST['s_stock'];
    $s_brand=$_POST['s_brand'];
    $s_category=$_POST['s_category'];
    $s_image=$_POST['s_image'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/html/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('seller_id'=>$s_id,'add_title'=>$s_title,'add_desc'=>$s_desc,'add_price'=>$s_price,'add_discount'=>$s_discount,
      'add_rating'=>$s_rating,'add_stock'=>$s_stock,'add_brand'=>$s_brand,'add_category'=>$s_category,'add_image'=>$s_image
      
      )
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
  

   
}




//view my product////

elseif(isset($_POST['my_pro_new'])){
    $seller_mypro_id=$_SESSION['user_id'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/html/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('view_product'=>$seller_mypro_id
      
      )
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    $temp=(json_decode($response,true));

    // print_r($temp);
    foreach($temp as $v1){
        $ans[]=$v1;
    }
    
    
    
    echo $twig -> render('view_pro.html',array( 'roles'=>$_SESSION['name'],'my_pro'=>$ans));
 
    die();




}



if(isset($_SESSION['data'])){
    if($_SESSION['data']!=1){
        $found="password or username is wrong, please try again";
         echo $twig -> render('login.html',array('check'=>$found));
         die();
    }


    else{
        // var_dump($_SESSION['user_id']);
    }
}
//seller dash board

if($_SESSION['role']=='seller' && empty($_GET['logout'])){

       
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/html/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('seller_own_pro'=>$_SESSION['user_id']
      
      )
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    $temp=(json_decode($response,true)); 
    // print_r($temp); 
    // var_dump($_SESSION);

    // echo $response;

    foreach($temp as $h){
        if($h['status_or']=='pending'){
            $ans[]=$h;
        }
    }

    foreach($temp as $h){
        if($h['status_or']!='pending'){
            $pre_order[]=$h;
        }
    }
    // print_r($ans);
    foreach($temp as $c){
   
        if(
            $c['seller_id_or'] == $_SESSION['user_id'] &&
            (
                $c['status_or'] == 'order has been shipped,Delivery on the way, thanks' || 
                $c['status_or'] == 'delivered'
            )
        ){
           
            $earn += round(($c['price'] / 100) * (100 - $c['discountPercentage']), 2) * $c['quantity_or'];
        }
    }
    

    // echo $earn;
    // var_dump($_POST);
    if($_POST['preorder']){
        echo $twig-> render('previous.html',array('previous'=>$pre_order,'earn'=>$earn));
  
        die();
    }

    else{
        
    echo $twig -> render('seller.html',array('roles'=>$_SESSION['name'],"products"=>$ans,'earn'=>$earn,'previous'=>$pre_order));

        if(isset($_POST['ship_order'])){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'localhost/html/index3.php',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('ship_order_id'=>$_SESSION['user_id']
              
              )
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            echo $response;
        }

       
    
    die();
    }
}


// delivery dashboard

if($_SESSION['role']=='delivery partner' && empty($_GET['logout'])){
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/html/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('dp_own_pro'=>$_SESSION['user_id'],'dp_pro'=>$_POST['dp_pro_id']
      
      ) 
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    $t=json_decode($response,true); 
    // echo $response;
    

    // echo $response;
    // print_r($t);
    
    foreach($t as $c){
        
                $ans[]=$c;
        
    }

    
    


    echo $twig->render('dp.html',array('roles'=>$_SESSION['name'],'dp_pro'=>$ans));
    die();
}



//==============================For Cart==================================//

if(isset($_POST['quan'])){
    $cart_quan= $_POST['quan'];
    $cart_proid=$_POST['pro_id'];
    $u_id=$_SESSION['user_id'];
 
 

    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/html/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('c_quan'=>$cart_quan,'c_proid'=>$cart_proid,'us_id'=>$u_id
      
      )
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    // header('location: /index.php');

    echo "hello";
  
}
//===============================visit cart===================================//
elseif(!empty($_POST['visit']) && $_SESSION['role']=='user'){

        $view_cart_userid=$_SESSION['user_id'];
 
 

    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/html/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('view_cart_usid'=>$view_cart_userid
      
      )
    ));
    
    $response = curl_exec($curl);
       
    curl_close($curl);
    $temp=(json_decode($response,true));
    // echo $response;

// echo $response;

// echo count($response);

foreach($temp as $v1){
    $ans[]=$v1;
}
foreach($ans as $c){
    if($c['status']=='delivery possible'){
    $ans2+=round(($c['price']/100)*(100-$c['discountPercentage']),2)*$c['quantity'];
    }
}

foreach($ans as $h){
    $charge=$charge+$h['charges'];
}

$total=$charge+$ans2;





    echo $twig -> render('cart.html',array( 'roles'=>$_SESSION['name'],'cart_pro'=>$ans,'cart_price'=>$ans2,'charge'=>$charge,
'total'=>$total
));
 
    die();
   

}
//palce order 
elseif(isset($_POST['place_order'])){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/html/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('total_charge'=>$_POST['place_order'],'us_id'=>$_SESSION['user_id'],'payment_method'=>$_POST['payment']
      
      )
    ));
    
    $response = curl_exec($curl);
       
    curl_close($curl);
    echo $response;
}

//view order 
elseif(isset($_POST['myorder'])){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/html/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('my_order'=>$_POST['myorder'],'user_i'=>$_SESSION['user_id']
      
      )
    ));
    
    $response = curl_exec($curl);
       
    curl_close($curl);
    $temp=(json_decode($response,true));
    // print_r($temp);
    // echo $response;

        // print_r($temp);

    // foreach($temp as $c){

    //     $ans2+=round(($c['price']/100)*(100-$c['discountPercentage']),2)*$c['quantity_or'];

    // }
    
    // foreach($temp as $h){
    //     $charge+=$h['charge_or'];
    // }
    // // echo $charge;
    // $total=$charge+$ans2;

   
    // print_r($ans);


    echo $twig-> render('my_order.html',array('my_order'=>$temp));
    die();
   
}

//view full product//
elseif(isset($_POST['view_all'])){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/html/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('my_all'=>$_POST['view_all'],'user_id_view'=>$_SESSION['user_id']
      
      )
    ));
    
    $response = curl_exec($curl);
       
    curl_close($curl);
    $r=(json_decode($response,true));
//    print_r($temp);

// var_dump($response);
// echo "hello";
// echo $response;

echo $twig-> render('order_details.html',array('orders'=>$r));
die();
}








$sort= $_GET['sort_v'];
$data1=$_GET['pagination'];
$data2[]=$_GET['pagination'];
$next[]=$_GET['pagination']+1;
$pre[]=$_GET['pagination']-1;
$cat=$_GET['category_i'];
$id_single=$_GET['id'];

// echo ($sort);

// echo $data1;

if(empty($data1)){
    $page=0;
}
else{
        $page=($data1*10)-10;
}
// echo $page;
// echo $page;


// $url = 'https://dummyjson.com/products?limit=100&skip='.$page; main
// $url='http://harsh.sedani/products?limit=10&skip='.$page."/";
$url='http://localhost/html/index3.php/';

// $url='http://harsh.api/?limit=20/';

$data_json_first = ($url);
$data_json_second = file_get_contents($data_json_first);

$p= json_decode($data_json_second,true);
// print_r($p);

$products=$p['products'];





if($sort=='price'){

    foreach ($products as $key=>$val){
        $price[$key]=strtolower($val['price']);
    }

    array_multisort($price,SORT_ASC,$products);
}

elseif($sort == 'title'){
    foreach ($products as $key=>$val){
        $title[$key]=strtolower($val['title']);
    }

    array_multisort($title,SORT_ASC,$products);
}

elseif($sort == 'discount'){
    foreach ($products as $key=>$val){
        $discount[$key]=$val['discountPercentage'];
    }

    array_multisort($discount,SORT_DESC,$products);
}


elseif($sort == 'ratings'){
    foreach ($products as $key=>$val){
        $ratings[$key]=$val['rating'];
    }

    array_multisort($ratings,SORT_DESC,$products);
}


$url_p='https://dummyjson.com/products?limit=100&skip=0';
$data_json_again=file_get_contents($url_p);
$p1=json_decode($data_json_again,true);
$products1=$p1['products'];

$pagination_count= ceil(count($products1)/10);
// echo $pagination_count;

// foreach ($products as $h){
//     $ans[]=$h;
// }

foreach($products1 as $v){
    $ans1[]=$v['category'];
}
// print_r($ans1);

//for--sorting

// print_r (array_keys($ans));

if(!empty($cat)){
    
$url_l='https://dummyjson.com/products/';
$data_json_again=file_get_contents($url_p);
$p1=json_decode($data_json_again,true);
$products1=$p1['products'];

foreach($products1 as $h){
    if($h['category']==$cat){
        $ans[]=$h;
    }   
}

$cat_f[]=$cat;

echo $twig -> render('category.html',array("cat_data"=>$ans,"title_cat"=>$cat_f));
}

elseif(!empty($id_single)){
   
        $url='https://dummyjson.com/products/';
        $data_json_first = ($url);
        $data_json_second = file_get_contents($data_json_first);
        
        $p= json_decode($data_json_second,true);
        $products_s=$p['products'];
        // print_r($products);
     
        foreach($products as $h){
            if($h['id']==$id_single){
            $ans[]=$h;
            }
        }
         $ans_temp=$ans[0];
        //  print_r($ans_temp);

         foreach($ans_temp['images'] as $h){
            $ans1[]=$h;
         }

        

        


    echo $twig -> render('single-product.html',array("product"=> $ans,'multipic'=>$ans1,'dimen'=>$ans2));
}

// elseif(!empty($_GET['logout'])){
//     echo $twig -> render('./newtemp/index.html',array("product"=> $products,"cate"=>array_unique($ans1),
// "page_count"=>range(1,$pagination_count),"dis_btn"=>$data2,"next_arr"=>$next,"pre_arr"=>$pre));

// }


elseif(!empty($_GET['logout'])){
    session_destroy();
    
//     echo $twig -> render('./newtemp/index.html',array("product"=> $products,"cate"=>array_unique($ans1),
// "page_count"=>range(1,$pagination_count),"dis_btn"=>$data2,"next_arr"=>$next,"pre_arr"=>$pre ,'roles'=> $_SESSION['name']));
header('location: /html/index.php');
}


else{
 

    echo $twig -> render('./newtemp/index.html',array("product"=> $products,"cate"=>array_unique($ans1),
"page_count"=>range(1,$pagination_count),"dis_btn"=>$data2,"next_arr"=>$next,"pre_arr"=>$pre ,'roles'=> $_SESSION['name'],'d_price'=>$d_price));
}
// 

?>



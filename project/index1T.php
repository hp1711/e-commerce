<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
session_start();

// echo "Hello World from test.php";
require_once 'vendor/autoload.php';
$data=$_GET;
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
      CURLOPT_URL => 'harsh.sedani/index3.php',
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
      CURLOPT_URL => 'harsh.sedani/index3.php',
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
}

elseif(isset($_POST['deli_name'])){
    $name_deli= $_POST['deli_name'];
    $address_deli=$_POST['deli_address'];
    $pincode_deli=$_POST['deli_pincode'];
    $email_deli=$_POST['deli_email'];
    $pass_deli=$_POST['deli_pass'];

    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'harsh.sedani/index3.php',
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
  
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'harsh.sedani/index3.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('l_email'=>$email_signin,'l_pass'=>$pass_signin
      
      )
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    
    if($response==0){
        $found="password or username is wrong, please try again";
        echo $twig -> render('login.html',array('check'=>$found));
        // echo "hello";
        die();
    }
    else{
            // session_start();
            echo session_id();
    }
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


$url='http://harsh.sedani/products?limit=10&skip='.$page."/";
// $url='http://harsh.sedani/products/';

// $url='http://harsh.api/?limit=20/';

$data_json_first = ($url);
$data_json_second = file_get_contents($data_json_first);

$p= json_decode($data_json_second,true);
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

// else if ($sort=='title'){
//     function sorttitle($a,$b){
//         return strcmp($a['price'],$b['price']);
//     }
//     usort($products,'sorttitle');
// }


// foreach($products as $h1){
//     $products2[]=$h1;
// }


// foreach ($products2 as $sort1){
//     $sorted[]=$sort1[$sort];
// }

// if($sort=='ratings'){
//     rsort($sorted);
// }

// foreach($sorted as $value){
//    foreach($products as $value1){
//     if($value==$value1[$sort]){
//         $final=$value1['id'];
//     }
//    }
// }
// $price=array_unique($final);
// $final_arr=array_map(fn($x)=> $products[$x-1],$price);

// print_r($products);
$url_p='http://harsh.sedani/products/';
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

//for--sorting

// print_r (array_keys($ans));

if(!empty($cat)){
    
$url_l='http://harsh.sedani/products/category/'.$cat.'/';
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

        $url='http://harsh.sedani/products/'.$id_single;
        $data_json_first = ($url);
        $data_json_second = file_get_contents($data_json_first);
        
        $p= json_decode($data_json_second,true);
        $products_s=$p['products'];
     
        foreach($products_s as $h){
            $ans[]=$h;
        }
         $ans_temp=$ans[0];
        //  print_r($ans_temp);

         foreach($ans_temp['images'] as $h){
            $ans1[]=$h;
         }

         


    echo $twig -> render('single-product.html',array("product"=> $ans,'multipic'=>$ans1));
}

else{

    echo $twig -> render('./newtemp/index.html',array("product"=> $products,"cate"=>array_unique($ans1),
"page_count"=>range(1,$pagination_count),"dis_btn"=>$data2,"next_arr"=>$next,"pre_arr"=>$pre));
}
// 

?>



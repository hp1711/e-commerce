<?php
// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1);
// error_reporting(-1);

// echo "Hello World from test.php";
require_once 'vendor/autoload.php';
$data=$_GET;
// echo $data;

$sort= $_GET['sort_v'];
$data1=$_GET['pagination'];
$data2[]=$_GET['pagination'];
$next[]=$_GET['pagination']+1;
$pre[]=$_GET['pagination']-1;

// echo ($sort);

// echo $data1;

if(empty($data1)){
    $data1=0;
}
else{
        $page=$data1*10-10;
}
// echo $page;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader =new FilesystemLoader('.');
$twig = new Environment($loader);

$url='http://harsh.api/';
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

$data_json_again=file_get_contents('https://dummyjson.com/products?limit=100');
$p1=json_decode($data_json_again,true);
$products1=$p1['products'];

$pagination_count= ceil(count($products1)/10);

// foreach ($products as $h){
//     $ans[]=$h;
// }

foreach($products1 as $v){
    $ans1[]=$v['category'];
}

//for--sorting

// print_r (array_keys($ans));


echo $twig -> render('./newtemp/index.html',array("product"=> $products,"cate"=>array_unique($ans1),
"page_count"=>range(1,$pagination_count),"dis_btn"=>$data2,"next_arr"=>$next,"pre_arr"=>$pre ));
// 

?>



<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once 'vendor/autoload.php';
$h=$_GET;
// print_r ($h);

// echo $data;




// echo "Hello World from test.php";
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader =new FilesystemLoader('.');
$twig = new Environment($loader);

$data_json = file_get_contents('https://dummyjson.com/products?limit=100');
$p= json_decode($data_json,true);
$products=$p['products'];



foreach ($products as $k=>$v){
    if($k+1==$h['id']){
        $ans[]=$v;
    }
}

foreach($ans as $v1){
    $ans1=$v1['images'];
}




// foreach($ans as $v){
//     $ans1[]=$v['category'];
// }

// print_r(array_unique($ans1));
// print_r (array_keys($ans));
// print_r ($ans);


echo $twig -> render('single-product.html',array("product"=> $ans,'multipic'=>$ans1));
?>



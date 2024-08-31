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

$data_json = file_get_contents('http://harsh.api/');
$p= json_decode($data_json,true);
$products=$p['products'];



foreach ($products as $k=>$v){
    if($v['category']==$h['category']){
        $ans[]=$v;
    }
}

echo $twig -> render('category.html',array("cat_data"=>$ans,"title_cat"=>$h));
?>



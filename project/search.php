<?php
// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1);
// error_reporting(-1);

require_once 'vendor/autoload.php';
$h=$_GET;
$searched=$h['search_data'];
// print_r ($h);

// echo $data;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader =new FilesystemLoader('.');
$twig = new Environment($loader);

$data_json = file_get_contents('https://dummyjson.com/products/search?q='.$searched);
$p= json_decode($data_json,true);
$p1= $p['products'];


foreach ($p1 as $value) {
   $ans[]=$value;
}

// print_r($ans);

echo $twig -> render('search.html',array("search_pro"=>$ans,"title_search"=>$h));

?>



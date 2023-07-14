
<?php 

require '../Core/Router.php';
// require './Router2.php';

$router = new Router(); 

// $router->add("", ['controller'=>'Home', 'action'=>'index']); 
// $router->add('posts', ['controller'=>'Posts', 'action'=>'index']);

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
//$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');
$router->add('{controller}/{id:\d+}/{action}');

$url = $_SERVER['QUERY_STRING']; 

// echo $url. ' url from index.php'; 
// echo '<pre>'; 
   
// // var_dump($router->getRoutes()); 
// echo '</pre>';

// echo $url; 

echo '<pre>';

if($router->match($url)) {
    echo var_dump($router->getParams()); 
}

echo '</pre>';

// if($router->match($url)) {
//     echo '<pre>'; 
//     // var_dump($router->getParams()); 
//     echo '</pre>';

// }
// else {
//     echo 'No match found'; 
// }

echo '<pre>'; 

echo '</pre>';

?>
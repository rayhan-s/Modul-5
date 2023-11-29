<?php

header("Content-Type: application/json; charset=UTF-8");

include "app/routes/product_routes.php";

use app\routes\product_routes;

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$product_route = new product_routes();
$product_route->handle($method, $path);

?>
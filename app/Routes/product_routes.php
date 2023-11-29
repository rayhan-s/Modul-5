<?php

namespace app\routes;

include "app/controller/product_controller.php";

use app\controller\product_controller;

class product_routes {
    public function handle($method, $path) {
        if ($method === 'GET' && $path === '/api/product') {
            $controller = new product_controller();
            echo $controller->index();
        }

        if ($method === 'GET' && strpos($path, '/api/product/') === 0) {
            $path_parts = explode('/', $path);
            $id = $path_parts[count($path_parts)-1];
            
            $controller = new product_controller();
            echo $controller->getById($id);
        }

        if ($method === 'POST' && $path === '/api/product') {
            $controller = new product_controller();
            echo $controller->insert();
        }

        if ($method === 'PUT' && strpos($path, '/api/product/') === 0) {
            $path_parts = explode('/', $path);
            $id = $path_parts[count($path_parts)-1];
            
            $controller = new product_controller();
            echo $controller->update($id);
        }

        if ($method === 'DELETE' && strpos($path, '/api/product/') === 0) {
            $path_parts = explode('/', $path);
            $id = $path_parts[count($path_parts)-1];
            
            $controller = new product_controller();
            echo $controller->delete($id);
        }
    }
}

?>
<?php

namespace app\controller;

include "app/models/product.php";
include "app/traits/api_responses.php";

use app\models\product;
use app\traits\api_responses;

class product_controller {
    use api_responses;

    public function index() {
        $product_model = new product();
        $response = $product_model->findAll();
        return $this->get_api(200, "success", $response);
    }

    public function getById($id) {
        $product_model = new product();
        $response = $product_model->findById($id);
        return $this->get_api(200, "success", $response);
    }

    public function insert() {
        $json_input = file_get_contents('php://input');
        $input_data = json_decode($json_input, true);
        if (json_last_error()) {
            return $this->get_api(400, "error occured", null);
        }

        $product_model = new product();
        $response = $product_model->create([
            "product_name" => $input_data['product_name']
        ]);

        return $this->get_api(200, "success", $response);
    }

    public function update($id) {
        $json_input = file_get_contents('php://input');
        $input_data = json_decode($json_input, true);
        if (json_last_error()) {
            return $this->get_api(400, "error occured", null);
        }

        $product_model = new product();
        $response = $product_model->update([
            "product_name" => $input_data['product_name']
        ], $id);

        return $this->get_api(200, "success", $response);
    }

    public function delete($id) {
        $product_model = new product();
        $response = $product_model->destroy($id);
        return $this->get_api(200, "success", $response);
    }
}

?>
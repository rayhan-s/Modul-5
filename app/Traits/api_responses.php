<?php

namespace app\traits;

trait api_responses {
    public function get_api($code=200, $msg="success", $data=[]) {
        return json_encode([
            "code" => $code,
            "message" => $msg,
            "data" => $data
        ]); 
    }
}

?>
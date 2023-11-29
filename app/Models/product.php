<?php

namespace app\models;

include "app/config/db_config.php";

use app\config\db_config;
use mysqli;

class product extends db_config {
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->passwd, $this->db_name, $this->port);
        if ($this->conn->connect_error) {
            die("Connection fialed: " . $this->conn->connect_error);
        }
    }

    public function findAll() {
        $sql = "SELECT * FROM products";
        $res = $this->conn->query($sql);
        $this->conn->close();
        $data = [];

        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function findById($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $this->conn->close();
        $data = [];

        while ($row = $res->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }

    public function create($data) {
        $productName = $data['product_name'];
        $query = "INSERT INTO products (product_name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $productName);
        $stmt->execute();
        $this->conn->close();
    }

    public function update($data, $id) {
        $productName = $data['product_name'];
        $query = "UPDATE products SET product_name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $productName, $id);
        $stmt->execute();
        $this->conn->close();
    }

    public function destroy($id) {
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }

}

?>
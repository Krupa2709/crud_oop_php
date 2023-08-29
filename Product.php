<?php
require_once 'db.php';

class Product extends Database {
    public function getAllProducts() {
        $sql = "SELECT * FROM products where deleted is null";
        $result = $this->conn->query($sql);

        $products = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        return $products;
    }

    // CRUD methods like create, update, delete

    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function createProduct($addProd) {

        $sql = "INSERT INTO products (name, description, category, price, status, image) VALUES ('".$addProd["name"]."', '".$addProd["description"]."', '".$addProd["category"]."', '".$addProd["price"]."', '".$addProd["status"]."', '".$addProd["image_path"]."')";

        if ($this->conn->query($sql) === TRUE) {
            header("Location: product_listing.php");
            exit;
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }

    }

    public function updateProduct($updateProd) {

        $sql = "UPDATE products SET name = '".$updateProd["name"]."', description = '".$updateProd["description"]."', category = '".$updateProd["category"]."', price = '".$updateProd["price"]."', status = '".$updateProd["status"]."', image = '".$updateProd["image_path"]."' WHERE id = '".$updateProd["product_id"]."'";

        if ($this->conn->query($sql) === TRUE) {
            header("Location: product_listing.php");
            exit;
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function deleteProduct($id) {
        $sql = "UPDATE products SET deleted = 1 WHERE id = $id";
        // return $this->conn->query($sql);

        if ($this->conn->query($sql) === TRUE) {
            header("Location: product_listing.php");
            exit;
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
}
?>

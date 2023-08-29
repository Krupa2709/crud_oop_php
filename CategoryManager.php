<?php
require_once 'db.php';

class CategoryManager extends Database {

    public function getAllCategories() {
        $sql =  "SELECT * FROM categories where deleted is null";
        $result = $this->conn->query($sql);

        $categories = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }

        return $categories;
    }

    public function getActiveCategories() {
        $sql = "SELECT * FROM categories WHERE status = 'Active' and deleted is null";
        $result = $this->conn->query($sql);

        $categories = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }

        return $categories;
    }

    public function getProductCategorie($id) {
        $sql = "SELECT * FROM categories where id = '$id'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    // Implement other CRUD methods like create, update, delete...

    public function createCategory($addCat) {

        $sql = "INSERT INTO categories (name, status) VALUES ('".$addCat["name"]."', '".$addCat["status"]."')";

        if ($this->conn->query($sql) === TRUE) {
            header("Location: category_manager.php");
            exit;
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }

    }

    public function updateCategory($updateCat) {

        $sql = "UPDATE categories SET name = '".$updateCat["name"]."', status = '".$updateCat["status"]."' WHERE id = '".$updateCat["category_id"]."'";

        if ($this->conn->query($sql) === TRUE) {
            header("Location: category_manager.php");
            exit;
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function deleteCategory($id) {
        $sql = "UPDATE categories SET deleted = 1 WHERE id = $id";
        // return $this->conn->query($sql);

        if ($this->conn->query($sql) === TRUE) {
            header("Location: category_manager.php");
            exit;
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
}
?>


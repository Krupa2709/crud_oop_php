<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once 'Product.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {

    $product_id = $_GET["id"];
    //soft delete
    $productObj = new Product();
    $product = $productObj->deleteProduct($product_id);
}

?>

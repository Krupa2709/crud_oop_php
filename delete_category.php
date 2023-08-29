<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once 'CategoryManager.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $category_id = $_GET["id"];
    //soft delete
    $catObj = new CategoryManager();
    $cat = $catObj->deleteCategory($category_id);
}

?>

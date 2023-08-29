<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once 'Product.php';
require_once 'CategoryManager.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {

    $product_id = $_GET["id"];

    $productObj = new Product();
    $product = $productObj->getProductById($product_id);

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $updateProd = array();
    $updateProd['product_id'] = $_POST["id"];
    $updateProd['name'] = $_POST["name"];
    $updateProd['description'] = $_POST["description"];
    $updateProd['category'] = $_POST["category"];
    $updateProd['price'] = $_POST["price"];
    $updateProd['status'] = $_POST["status"];

    // Image Upload
    $image_dir = "uploads/";
    $image_name = $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];
    $image_path = $image_dir . $image_name;

    if($image_name == ' ' || $image_name == null){
        $updateProd['image_path'] = '';
    }else{
        move_uploaded_file($image_tmp, $image_path);
    }

    $productObj = new Product();
    $products = $productObj->updateProduct($updateProd);

}

// Get catagory
$catObj = new CategoryManager();
$categories = $catObj->getActiveCategories();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-3" style="text-align: center;">Edit Product</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value="<?php echo $product_id; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"><?php echo $product['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category" class="form-control form-select" id="category">
                    <?php
                    foreach ($categories as $cat) { 
                        $selected = ($product['category'] == $cat['id']) ? 'selected' : '';
                        echo "<option value='" . $cat["id"] . "' $selected>" . $cat["name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price"name="price" step="0.01" value="<?php echo $product['price']; ?>">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control form-select" id="status">
                    <option value="Active" <?php if ($product['status'] == 'Active') echo 'selected'; ?>>Active</option>
                    <option value="Inactive" <?php if ($product['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                </select>
            </div>
            <div style="text-align:center;">
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="product_listing.php" class="btn btn-primary mb-3" style="float: right">Back</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once 'Product.php';
require_once 'CategoryManager.php';

$productObj = new Product();
$products = $productObj->getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
</head>
<body>
	<div class="container mt-5">
	    <h2 class="mb-3" style="text-align: center;">Product Management</h2>

	    <!-- Add Product -->
	    <a href="add_product.php" target='_blank' class="btn btn-primary mb-3" style="float: right">Add Product</a>
	    <a href="logout.php" class="btn btn-danger mb-3" style="float: left">Logout</a>

	    <!-- Product Listing -->
	    <table border="1" class="table table-striped">
	        <tr>
	            <th>Name</th>
	            <th>Description</th>
	            <th>Category</th>
	            <th>Price</th>
	            <th>Status</th>
	            <th>Actions</th>
	        </tr>
	        <!-- Get rows from the database -->
	       <?php 

        	foreach ($products as $product) { 
            
        			echo "<tr>";
				    echo "<td>" . $product["name"] . "</td>";
				    echo "<td>" . $product["description"] . "</td>";

					$catObj = new CategoryManager();
					$cat = $catObj->getProductCategorie($product['category']);

				    echo "<td>" . $cat["name"] . "</td>";
				    echo "<td>" . $product["price"] . "</td>";
				    echo "<td>" . $product["status"] . "</td>";
				    echo "<td><a class='btn btn-success mb-3' href='edit_product.php?id=" . $product["id"] . "'>Edit</a>  <a class='btn btn-danger mb-3' href='delete_product.php?id=" . $product["id"] . "'>Delete</a></td>";
				    echo "</tr>";

         	} 
        ?>

	    </table>
	    <a href="category_manager.php" target="_blank" class="btn btn-success mb-3" style="float: left">Category Manager</a>
	</div>
</body>
</html>


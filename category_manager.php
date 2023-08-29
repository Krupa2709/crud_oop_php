<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once 'CategoryManager.php';

$catObj = new CategoryManager();
$categories = $catObj->getAllCategories($product['category']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Category Manager</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-3" style="text-align: center;">Category Manager</h2>

        <!-- Add Category -->
        <a href="add_category.php" target='_blank' class="btn btn-primary mb-3" style="float: right">Add Category</a>
        <a href="logout.php" class="btn btn-danger mb-3" style="float: left">Logout</a>

        <!-- Category Listing -->
        <table border="1" class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <!-- Get rows from the database -->
            <?php 

    			foreach ($categories as $cat) { 
    			    echo "<tr>";
    			    echo "<td>" . $cat["name"] . "</td>";
    			    echo "<td>" . $cat["status"] . "</td>";
    			    echo "<td><a class='btn btn-success mb-3' href='edit_category.php?id=" . $cat["id"] . "'>Edit</a>  <a class='btn btn-danger mb-3' href='delete_category.php?id=" . $cat["id"] . "'>Delete</a></td>";
    			    echo "</tr>";
    			}
    		?>
        </table>

        <a href="product_listing.php" target="_blank" class="btn btn-success mb-3" style="float: left">Product Listing</a>
        
    </div>
</body>
</html>

<?php
define('ROOT_PATH', dirname(__DIR__));
require(ROOT_PATH . '/includes/db.php');
require(ROOT_PATH . '/includes/header.php');

$result = $conn->query("SELECT * FROM products");
echo "<h2>Product List</h2><a href= 'pages\create.php' class='btn btn-primary mb-3'>Add New Product</a><div class='row'>";
while ($row = $result->fetch_assoc()) {
    echo "<div class='col-md-4 mb-4'>
        <div class='card h-100'>
            <img src='images/{$row['image']}' class='card-img-top' style='height: 200px; object-fit: cover;'>
            <div class='card-body'>
                <h5 class='card-title'>{$row['name']}</h5>
                <p class='card-text'>{$row['description']}</p>
                <p class='card-text'><strong>Price: $ {$row['price']}</strong></p>
                <a href='update.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?');\">Delete</a>
            </div>
        </div>
    </div>";
}
echo "</div>";
include '../assignment_PHP/includes/footer.php';
?>

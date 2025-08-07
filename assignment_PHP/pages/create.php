<?php
session_start();
include('../includes/db.php');
include('../includes/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    
    
    $targetDir = "../images/";
    $imageName = uniqid() . '_' . basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $imageName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Validating image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) die("<div class='alert alert-danger'>File is not an image.</div>");
    
    // Checking file size (2MB max)
    if ($_FILES["image"]["size"] > 2000000) die("<div class='alert alert-danger'>Image is too large (max 2MB).</div>");
    
    // Allow;ing certain file formats
    if (!in_array($imageFileType, ["jpg",'JPG', "png", "jpeg", "gif"])) {
        die("<div class='alert alert-danger'>Only JPG, PNG, JPEG, GIF allowed.</div>");
    }
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $name, $desc, $price, $imageName);
        $stmt->execute();
        echo "<div class='alert alert-success'>Product added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error uploading image.</div>";
    }
    
}
?>
<h2>Add Product</h2>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label>Price</label>
        <input type="number" step="0.01" name="price" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Product Image</label>
        <input type="file" name="image" class="form-control" required>
        <small class="text-muted">Max size 2MB. Allowed types: jpg, png, gif</small>
    </div>
    <button type="submit" class="btn btn-success">Add Product</button>
</form>
<?php include('../includes/footer.php'); ?>

<?php
include('../includes/db.php');
include('../includes/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    echo "<div class='alert alert-success'>User registered successfully!</div>";
}
?>
<h2>Register</h2>
<form method="POST">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-4 text-center">
    <p>Already have an account? <a href="login.php">Login here</a></p>
    <p><a href="../index.php">← Back to Home</a></p>
</div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
<?php include('../includes/footer.php'); ?>

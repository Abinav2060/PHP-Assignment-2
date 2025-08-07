<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require(__DIR__ . '/../includes/db.php');

$id = $_GET['id'];
$conn->query("DELETE FROM products WHERE id=$id");

header("Location: read.php");
exit;
?>

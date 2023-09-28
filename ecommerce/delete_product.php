<?php
include 'server/includes/connection.php';
session_start();

// Check if the user is logged in as the seller

if (!isset($_SESSION['id'])) {
    header("location: ../../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Delete the product from the database
    $sql = "DELETE FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Failed to delete product";
        exit();
    }

    header("location: view-blog.php");
    exit();
}
?>
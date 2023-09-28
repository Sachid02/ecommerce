<?php
include '../includes/connection.php';
session_start();
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_FILES['image'];
$seller_id = $_SESSION['id'];
$cat = $_POST['categories'];


$tempname = $image['tmp_name'];

$folder = "../../image/" . $image['name'];
move_uploaded_file($tempname, $folder);


$sql = sprintf("INSERT INTO products (name, description, price, seller_id, image,categories) VALUES ('%s', '%s', %d, %d, '%s','%d')", $name, $description, $price, $seller_id, $folder, $cat);

$res = $conn->query($sql);

if (!$res) {
    echo "failed adding products";
    exit();
}

header("location: ../../view-blog.php");
<?php
session_start();
include '../includes/connection.php';
$pid = $_GET['pid'];
$userID = $_SESSION['id'];

$sql = sprintf("DELETE FROM products WHERE id = %d AND seller_id = %d", $pid, $userID);

$conn->query($sql);

echo "deleted";

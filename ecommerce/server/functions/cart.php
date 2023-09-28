<?php
session_start();
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = 0;
}
$_SESSION["cart"] = $_SESSION["cart"] + 1;
echo $_SESSION["cart"];
header("location: /ecommerce/index.php");

?>
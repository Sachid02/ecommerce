<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli("localhost", "root", "", "sachid_ecommerce");
if ($conn->connect_errno) {
    echo "Connection to database failed" . $conn->connect_error;
    exit();
}

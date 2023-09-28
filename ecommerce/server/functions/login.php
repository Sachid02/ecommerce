<?php

// include("../includes/connection.php");
// session_start();
// $email = $_POST["email"];
// $password = $_POST["password"];

// $sql = sprintf("SELECT id,email,role,password FROM users WHERE email = '%s'", $email);

// $result = $conn->query($sql);
// $rows = $result->fetch_row();

// if ($result->num_rows <= 0) {
//     $_SESSION["message"] = "Invalid credentials";
//     header("location: ../../login_form.php");
// }

// $hashed_password = $rows[3];
// $verified_password = password_verify($password, $hashed_password);

// if (!$verified_password) {
//     $_SESSION["message"] = "Invalid credentials";
//     header("location: ../../login_form.php");
// }

// $_SESSION["message"] = "Logged in successfully";
// $_SESSION["email"] = $rows[1];
// $_SESSION['role'] = $rows[2];
// $_SESSION['id'] = $rows[0];

// header("Location: ../../dashboard.php");

// mysqli_close($conn);

include("../includes/connection.php");
session_start();
$email = $_POST["email"];
$password = $_POST["password"];

// Prepare the SQL statement with a placeholder for the email
$sql = "SELECT id, email, role, password FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);

// Bind the email parameter and execute the query
$stmt->bind_param("s", $email);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch the row as an associative array
$row = $result->fetch_assoc();

if (!$row) {
    $_SESSION["message"] = "Invalid credentials";
    header("location: ../../login_form.php");
} else {
    $hashed_password = $row["password"];

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        $_SESSION["message"] = "Logged in successfully";
        $_SESSION["email"] = $row["email"];
        $_SESSION['role'] = $row["role"];
        $_SESSION['id'] = $row["id"];
        header("Location: ../../dashboard.php");
    } else {
        $_SESSION["message"] = "Invalid credentials";
        header("location: ../../login_form.php");
    }
}

// Close the statement and the database connection
$stmt->close();
$conn->close();
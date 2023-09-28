<?php
include 'server/includes/connection.php';
session_start();

// Fetch products from the database for the current seller
$seller_id = $_SESSION['id'];
$sql = "SELECT * FROM products WHERE seller_id = $seller_id";
$result = $conn->query($sql);

if (!$result) {
    echo "Failed to fetch products";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>

<body>
    <h1>Your Products</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";


            echo '<td><img src=" image/' . basename($row['image']) . '" alt="Product Image" width="100"></td>';
            echo '<td><a href="edit_product.php?id=' . $row['id'] . '">Edit</a> | <button class=" delete" > <a href="delete_product.php?id=' . $row['id'] . '">Delete</a> </button></td>';
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>

<script>
    var deleteButtons = document.querySelectorAll(".delete");

    for (var i = 0; i < deleteButtons.length; i++) {
        var deleteButton = deleteButtons[i];

        deleteButton.addEventListener("click", function (event) {
            event.preventDefault();
            var flag = confirm("Are you sure you want to remove this product ?");
            if (flag == true) {
                window.location.href = this.querySelector("a").href;
            }
        });
    }
</script>
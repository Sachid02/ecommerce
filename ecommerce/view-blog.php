<?php session_start();
if (!isset($_SESSION['role'])) {
    header("location: ./login_form.php");
}
$role = $_SESSION['role'];
$seller_id = $_SESSION['id'];
$email = $_SESSION['email'];
?>
<?php
include 'server/includes/connection.php';


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
<html>

<head>
    <meta charset="utf-8" />
    <title>Admin Dashboard</title>

    <link rel="stylesheet" type="text/css" href="dashboard.css" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous" />

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</head>
<style>
    form {
        max-width: 400px;
        margin: 0 auto;
    }

    fieldset {
        border: none;
        padding: 0;
    }

    legend {
        font-size: 1.2em;
        font-weight: bold;
        margin-bottom: 10px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="file"] {
        margin-bottom: 10px;
    }

    input[type="submit"] {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>


<body>
    <header class="header">
        <?php
        if ($role == 1) {
            echo "<a href=''>Seller Dashboard</a>";
        } else if ($role == 2) {
            echo "<a href=''>Buyer Dashboard</a>";
        } else {
            echo "<a href=''>Admin Dashboard</a>";

        }
        ?>

        <div class="logout">
            <a href="./logout.php" class="btn btn-primary">Logout</a>
        </div>
    </header>

    <aside>
        <ul>
            <li>
                <a href="dashboard.php">Dashboard</a>
            </li>
            <?php
            if ($role == 2) {
                echo '
                    <li>
                        <a href="./add_product_form.php">Add Products</a>
                    </li>
                    
                    <li>
                        <a href="view-blog.php">View Products </a>
                    </li>

                    <li>
                       
                    </li>';
            }
            ?>
        </ul>
    </aside>

    <div class="content">
        <h1>Your Products</h1>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>categories</th>
                <th>Action</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";

                // option value="3">male</option>
                // <option value="2">women</option>
                // <option value="1">kid</option
                echo '<td><img src=" image/' . basename($row['image']) . '" alt="Product Image" width="100"></td>';
                if ($row['categories'] == 2) {

                    echo "<td> women</td>";
                } elseif ($row['categories'] == 1) {
                    echo "<td> kid</td>";

                } else {
                    echo "<td> Men</td>";
                }

                // echo "<td>" . $row['categories'] . "</td>";
                echo '<td><button class="edit"><a href="edit_product.php?id=' . $row['id'] . '">Edit</a> </button> | <button class=" delete" > <a href="delete_product.php?id=' . $row['id'] . '">Delete</a> </button></td>';
                echo "</tr>";
            }
            ?>
        </table>

    </div>
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

<style>
    /* Style for the table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    /* Style for table headers */
    th {
        background-color: #1d3557;
        color: #fff;
        font-weight: bold;
        padding: 10px;
        text-align: left;
    }

    /* Style for table rows */
    tr {
        background-color: #f2f2f2;
    }

    /* Style for alternating rows */
    tr:nth-child(even) {
        background-color: #e0e0e0;
    }

    /* Style for table data cells */
    td {
        padding: 10px;
    }

    /* Style for table images */
    td img {
        max-width: 100px;
        height: auto;
    }

    /* Style for the "Action" column */
    td:last-child {
        text-align: center;
    }

    /* Style for delete buttons */
    .delete {
        /* background-color: #e63946; */
        color: red;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }

    .edit {

        color: #fff;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }

    /* Hover effect for delete buttons */
    .delete:hover {
        background-color: #c62828;
    }

    .edit:hover {
        background-color: green;
    }
</style>
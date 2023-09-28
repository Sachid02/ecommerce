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

    // Fetch the product details for editing
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Failed to fetch product";
        exit();
    }

    $product = $result->fetch_assoc();
}

// Handle form submission for editing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Check if a new image was uploaded
    if ($_FILES['image']['name']) {
        $image = $_FILES['image'];
        $tempname = $image['tmp_name'];
        $folder = "image/" . $image['name'];

        // Move the new image to the folder
        move_uploaded_file($tempname, $folder);

        // Update the product with the new image
        $sql = "UPDATE products SET name = '$name', description = '$description', price = $price, image = '$folder' WHERE id = $product_id";
    } else {
        // No new image uploaded, update without changing the image path
        $sql = "UPDATE products SET name = '$name', description = '$description', price = $price WHERE id = $product_id";
    }

    $result = $conn->query($sql);

    if (!$result) {
        echo "Failed to update product";
        exit();
    }

    header("location: view-blog.php");
    exit();
}
?>




<?php
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
        <legend>Edit Product</legend>
        <form method="POST" action="" enctype="multipart/form-data">
            <fieldset>
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $product['name']; ?>"><br>
                <label for="description">Description:</label>
                <textarea name="description"><?php echo $product['description']; ?></textarea><br>
                <label for="price">Price:</label>
                <input type="number" name="price" value="<?php echo $product['price']; ?>"><br>
                <label for="image">Image:</label>
                <input type="file" name="image"><br>
                <?php
                if ($product['image']) {
                    echo '<img src="' . $product['image'] . '" alt="Product Image" width="100"><br>';
                }
                ?>
                <input type="submit" value="Update">
            </fieldset>
        </form>

    </div>
</body>

</html>
<?php session_start();
if (!isset($_SESSION['role'])) {
    header("location: ./login_form.php");
}
$role = $_SESSION['role'];
$seller_id = $_SESSION['id'];
$email = $_SESSION['email'];
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
        <form action="./server/functions/add_product.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Add Product</legend>
                <label for="">Name: </label>
                <input type="text" name="name" id=""> <br />
                <label for="">Price: </label>
                <input type="text" name="price" id=""> <br />

                <label for="">Image: </label>
                <input type="file" name="image" id=""> <br />
                <label for="">categories</label>
                <select name="categories" id="">
                    <option value="3">male</option>
                    <option value="2">women</option>
                    <option value="1">kid</option>
                </select>
                <label for="">Description: </label>
                <textarea name="description" id="" cols="20" rows="5"></textarea><br>


                <input type="submit" value="Add product">
            </fieldset>
        </form>
    </div>
</body>

</html>
<?php
$catagories = $_GET['items'];
// echo $catagories;
?>


<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_SESSION["message"])) {
        echo sprintf("<li class='alert'>%s</li>", $_SESSION["message"]);
        unset($_SESSION["message"]);
    }
    ?>
    <div class="container">
        <?php include('inc/navbar.php') ?>


        <!-- end -->
        <div class="recent">

            <?php if ($catagories == 2): ?>
                <h4 class="title">women</h4>
            <?php elseif ($catagories == 1): ?>
                <h4 class="title">Kid</h4>
            <?php else: ?>
                <h4 class="title">Male</h4>

            <?php endif ?>

            <div class="col">
                <?php
                include "./server/includes/connection.php";
                $sql = "SELECT * FROM products WHERE categories = '$catagories'";

                $res = $conn->query($sql);
                $prodcuts = mysqli_fetch_all($res, MYSQLI_ASSOC);


                // print_r($prodcuts);
                
                ?>

                <?php foreach ($prodcuts as $prodcut): ?>
                    <div class="row">
                        <div class="card">
                            <div class="card-img">


                                <img src="image/<?php echo basename($prodcut['image']); ?>" alt="" />
                            </div>
                            <div class="content">
                                <h3>
                                    <?php echo $prodcut['name']; ?>
                                </h3>
                                <p class="seller">
                                    <?php echo $prodcut['description']; ?>
                                </p>
                                <p class="price">Rs.
                                    <?php echo $prodcut['price']; ?>
                                </p>

                                <form action="" method="post">
                                    <input type="text" name="prodcutid" id="prodcutid"
                                        value="  <?php echo $prodcut['id']; ?>">
                                    <input type="text" name="sellerid" id="sellerid"
                                        value="  <?php echo $prodcut['seller_id']; ?>">
                                    <input type="submit" value="Add to cart" class="btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>
            <?php include('inc/footer.php') ?>
</body>

</html>
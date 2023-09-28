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

        <div class="hero">
            <img src="./img/shoe.jpg" alt="" />
            <div class="content">
                <h1 style="font-size: 3rem; color: #e63946">Buy Shoes</h1>
                <h1 style="font-size: 3rem">shaped to your foot</h1>
                <input type="text" name="" id="" placeholder="Search..." style="padding: 10px" />
                <input type="submit" value="Search" class="btn-primary" />
            </div>
        </div>
        <!-- end -->
        <div class="recent">
            <h4 class="title">Recently Added</h4>
            <div class="col">
                <?php
                include "./server/includes/connection.php";
                $sql = "SELECT * FROM products LIMIT 3";
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
                                <form action="./server/functions/cart.php" method="post">
                                    <input type="submit" value="Add to cart" class="btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
                <!-- <div class="row">
                    <div class="card">
                        <div class="card-img">
                            <img src="./img/shoe.jpg" alt="" />
                        </div>
                        <div class="content">
                            <h3>Crop Top</h3>
                            <p class="seller">Sachid paudel</p>
                            <p class="price">Rs. 200,000</p>
                            <form action="./server/functions/cart.php" method="post">
                                <input type="submit" value="Add to cart" class="btn-primary">
                            </form>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="row">
                    <div class="card">
                        <div class="card-img">
                            <img src="./img/shoe.jpg" alt="" />
                        </div>
                        <div class="content">
                            <h3>Body Spray</h3>
                            <p class="seller">Sachid paudel</p>
                            <p class="price">Rs. 200,000</p>
                            <form action="./server/functions/cart.php" method="post">
                                <input type="submit" value="Add to cart" class="btn-primary">
                            </form>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- end recent -->
        <?php include('inc/footer.php') ?>
    </div>
</body>

</html>
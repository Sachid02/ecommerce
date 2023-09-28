<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="form.css" />
</head>

<body>
    <div class="flex-form">
        <form action="server/functions/login.php" method="post">
            <?php
            session_start();
            if (isset($_SESSION["message"])) {
                echo sprintf("<li class='alert'>%s</li>", $_SESSION["message"]);
                unset($_SESSION["message"]);
            }
            ?>
            <fieldset>
                <legend>Login:</legend>
                <div class="form-set">
                    <label for="email">Email:</label><br />
                    <input type="email" name="email" id="" required /><br />
                </div>
                <div class="form-set">
                    <label for="password">Password:</label><br />
                    <input type="password" name="password" id="" required /><br />
                </div>
                <div class="form-set">
                    <input class="btn" type="submit" value="Login" />
                </div>
                <div class="form-set">
                    <p>
                        Don't have an account?
                        <a href="./register_form.html">Signup</a>
                    </p>
                </div>
            </fieldset>
        </form>
    </div>
</body>

</html>
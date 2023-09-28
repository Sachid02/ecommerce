<div class="navbar">
    <div class="logo">
        <a href="/">
            <h1 style="color: #1d3557">
                SHOE<span style="color: #e63946">STORE</span>
            </h1>
        </a>
    </div>
    <div class="navs">
        <ul>
            <li class="dropdown">
                <a href="#">Products</a>
                <div class="dropdown-content">
                    <ul>
                        <li><a href="products.php?items=3">Male</a></li>

                        <li><a href="products.php?items=2">Female</a></li>
                        <li><a href="products.php?items=1">Kid</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>

    </div>
    <div class="navs account">
        <ul>
            <li><a href="./register_form.html">Signup</a></li>
            <li><a href="./login_form.php">Login</a></li>
            <li><a href="./logout.php">Logout</a></li>
            <li>
                <a href="./dashboard.php">Dashboard</a>
            </li>
            <li>Cart: <span class="cart-items">
                    <?php
                    echo $_SESSION["cart"] ?? 0;
                    ?>
                </span></li>
        </ul>
    </div>
</div>


<style>
    /* CSS for the dropdown menu */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #fff;
        /* Background color for the dropdown */
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        left: 0;
        /* Position the dropdown on the left side of the parent */
        top: 100%;
        /* Position the dropdown below the parent */
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Style for the dropdown items */
    .dropdown-content ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .dropdown-content li {
        padding: 10px;
        text-align: center;
    }

    /* Style for the dropdown links */
    .dropdown-content a {
        color: #333;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: grey
            /* Background color on hover */
            color: #fff;
        /* Text color on hover */
    }
</style>
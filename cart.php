<?php
session_start();
error_reporting(0);
include("connection/connect.php");

// Add to Cart
if ($_GET['action'] == "add" && !empty($_POST)) {
    $dish_id = $_GET['id'];
    $res_id = $_GET['res_id'];

    $title = $_POST['title'];
    $price = $_POST['price'];
    $slogan = $_POST['slogan'];
    $img = $_POST['img'];
    $qty = $_POST['quantity'];

    $img_path = 'admin/Res_img/dishes/' . basename($img); // Avoid directory traversal issues

    if (isset($_SESSION['cart'][$dish_id])) {
        $_SESSION['cart'][$dish_id]['quantity'] += $qty;
    } else {
        $_SESSION['cart'][$dish_id] = array(
            'name' => $title,
            'price' => $price,
            'slogan' => $slogan,
            'image' => $img_path,
            'quantity' => $qty,
            'res_id' => $res_id
        );
    }
    header("Location: cart.php");
    exit();
}
// Delete from Cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $dishId = $_POST['dishId'];
    if (isset($_SESSION['cart'][$dishId])) {
        unset($_SESSION['cart'][$dishId]);
        echo "Deleted";
    } else {
        echo "Dish not found in cart.";
    }
    exit();
}

// Handle Purchase of Single Dish
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'purchase') {
    $dishId = $_POST['dishId'];
    if (isset($_SESSION['cart'][$dishId])) {
        $_SESSION['purchase_item'] = $_SESSION['cart'][$dishId];
        $_SESSION['purchase_item']['id'] = $dishId;
        header("Location: checkout.php");
        exit();
    } else {
        echo "<script>alert('Dish not found.');</script>";
    }
}

// Update Quantity in Cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_quantity') {
    $dishId = $_POST['dishId'];
    $qty = (int)$_POST['quantity'];

    if (isset($_SESSION['cart'][$dishId])) {
        $_SESSION['cart'][$dishId]['quantity'] = $qty;
        echo "Updated";
    } else {
        echo "Dish not found in cart.";
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>Food Ordering</title>
    <style>
        .bg_image {
            background-size: cover;
            background-position: center;
        }

        .footer-logo {
            width: 150px;
            height: auto;
        }

        .payment-icons img {
            width: 40px;
            height: auto;
            margin: 0 10px;
        }

        @media (max-width: 767px) {
            .navbar-nav {
                flex-direction: column;
                align-items: center;
            }

            .nav-item {
                margin: 10px 0;
            }
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40;
        }

        .navbar-brand img {
            width: 100px !important;
            height: 50px !important;
        }

        .navbar-collapse {
            display: flex;
            justify-content: center;
        }

        .navbar-nav {
            display: flex;
            justify-content: right;
            flex-grow: 1;
        }

        .nav-item {
            margin: 10 20px;
            padding: 10px 20px;
        }

        .nav-link {
            color: #fff;
            font-size: 16px;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #f8f9fa;
        }

        @media (max-width: 767px) {
            .navbar-nav {
                flex-direction: column;
                align-items: center;
            }

            .nav-item {
                margin: 10px 0;
                padding: 8px 15px;
            }
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: #000;
        }

        body {
            padding-top: 100px;
        }

/*
        .btn-qty {
            width: 36px;
            height: 36px;
            padding: 0;
            font-size: 18px;
        }

        .quantity-input {
            width: 90px;
            height: 36px;
            padding: 0 5px;
            font-size: 16px;
        }

        .input-group {
            max-width: 150px;
        }
*/
.quantity .input-group {
    display: flex;
    align-items: center;
}

.quantity input {
    width: 30px; 
    text-align: center;
    
        }
        
        .quantity .input-group input {
    width: 50px; /* Adjust the width to your liking */
    text-align: center; /* Center the text */
}


    </style>
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <!-- Header -->
    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark navbar-expand-lg">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php">
                    <img class="img-rounded" src="images/green1.png" alt="">
                </a>
                <div class="collapse navbar-collapse" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item"> 
                            <a class="nav-link active" href="index.php">Home</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link active" href="restaurants.php">Restaurants</a>
                        </li>
                        <?php
                        if(empty($_SESSION["user_id"])) {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a></li>';
                            echo '<li class="nav-item"><a href="registration.php" class="nav-link active">Sign Up</a></li>';
                        } else {
                            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Your Orders</a></li>';
                            echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
<!-- Main Content -->
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Your Shopping Cart</h2>
    <div class="cart-list">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Remove</th>
                    <th>Image</th>
                    <th>Dish Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $cart = $_SESSION['cart'] ?? [];
            $total_price = 0;

            if (!empty($cart)) {
                foreach ($cart as $dishId => $item) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $total_price += $subtotal;
                    ?>
                    <tr>
                        <td>
                            <a href="#" class="delete-dish" data-dishid="<?= htmlspecialchars($dishId) ?>"><i class="fa fa-trash"></i></a>
                        </td>
                        <td>
                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 60px; height: 60px;">
                        </td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
<td>
    <div class="d-flex align-items-center">

        <div class="quantity">
            <div class="input-group mb-3">
                <button class="quantity-minus px-2 border-0 btn-decrease" type="button" data-dishid="<?= htmlspecialchars($dishId) ?>">-</button>
                <input type="number" class="quantity form-control input-number" 
                       value="<?= $item['quantity'] ?>" min="1" max="100" 
                       data-dishid="<?= htmlspecialchars($dishId) ?>" 
                       oninput="updateQuantity(<?= htmlspecialchars($dishId) ?>, this.value)" 
                       style="width: 50px; text-align: center;">
                <button class="quantity-plus px-2 border-0 btn-increase" type="button" data-dishid="<?= htmlspecialchars($dishId) ?>">+</button>
            </div>
        </div>
    </div>
</td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                        <td>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="dishId" value="<?= htmlspecialchars($dishId) ?>">
                                <input type="hidden" name="action" value="purchase">
                                <button type="submit" class="btn btn-success btn-sm">Purchase</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
            } else {
                echo '<tr><td colspan="7">Your cart is empty!</td></tr>';
            }
            ?>
            </tbody>
        </table>

        <?php if (!empty($cart)) { ?>
            <div class="cart-total text-center">
                <h4>Total: $<?= number_format($total_price, 2); ?></h4>
            </div>
        <?php } ?>
    </div>
</div>
<br>
    <br>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row top-footer">
                <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                    <a href="#"> 
                        <img src="images/green1.png" alt="Footer logo" class="footer-logo"> 
                    </a>
                    <span>Order Delivery &amp; Take-Out</span>
                </div>
                <div class="col-xs-12 col-sm-2 pages color-gray">
                    <h5>Pages</h5>
                    <ul>
                        <li><a href="#">Search results page</a></li>
                        <li><a href="#">User Sign Up Page</a></li>
                        <li><a href="#">Pricing page</a></li>
                        <li><a href="#">Make order</a></li>
                        <li><a href="#">Add to cart</a></li>
                    </ul>
                </div>
            </div>
            <div class="bottom-footer">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 address color-gray">
                        <h5>Address</h5>
                        <p>Nkshtra-5,Shadhu Wasvani Road,Rajkot-360005</p>
                        <h5>Phone: <a href="tel:+080000012222">9173633311</a></h5>
                    </div>
                    <div class="col-xs-12 col-sm-5 additional-info color-gray">
                        <h5>Additional Information</h5>
                        <p>Join the thousands of other restaurants who benefit from having their menus on TakeOff</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
$(document).ready(function () {
    function updateQuantity(dishId, newQty) {
        $.post("cart.php", {
            action: "update_quantity",
            dishId: dishId,
            quantity: newQty
        }, function (response) {
            if (response === "Updated") {
                location.reload();
            }
        });
    }

    $(".quantity-minus").click(function () {
        var dishId = $(this).data('dishid');
        var quantityInput = $("input[data-dishid='" + dishId + "']");
        var currentQty = parseInt(quantityInput.val());
        if (currentQty > 1) {
            updateQuantity(dishId, currentQty - 1);
        }
    });

    $(".quantity-plus").click(function () {
        var dishId = $(this).data('dishid');
        var quantityInput = $("input[data-dishid='" + dishId + "']");
        var currentQty = parseInt(quantityInput.val());
        updateQuantity(dishId, currentQty + 1);
    });
});

    </script>
</body>
</html>

<?php
session_start();
require 'products.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <ul>
        <?php
        $total = 0;
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product) {
                echo '<li>' . htmlspecialchars($product['name']) . ' - ' . htmlspecialchars($product['price']) . ' PHP</li>';
                $total += $product['price'];
            }
        } else {
            echo '<li>Your cart is empty.</li>';
        }
        ?>
    </ul>
    <p>Total Price: <?php echo htmlspecialchars($total); ?> PHP</p>
    <a href="reset-cart.php">Clear my cart</a>
    <a href="place_order.php">Place the order</a>
</body>
</html>
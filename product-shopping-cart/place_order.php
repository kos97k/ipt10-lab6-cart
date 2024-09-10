<?php
session_start();
require 'products.php';

//Generate random order code
$order_code = bin2hex(random_bytes(8));

//Get cart data
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total_price = 0;

//Prepare order details
$order_details = "Order Code: $order_code\n";
$order_details .= "Date and Time Ordered: " . date('Y-m-d H:i:s') . "\n\n";
$order_details .= "Order Items:\n";

foreach ($cart as $product) {
    $order_details .= "Product ID: " . $product['id'] . "\n";
    $order_details .= "Product Name: " . $product['name'] . "\n";
    $order_details .= "Price: " . $product['price'] . " PHP\n\n";
    $total_price += $product['price'];
}

$order_details .= "Total Price: " . $total_price . " PHP\n";

//Save order details to file
file_put_contents("orders-$order_code.txt", $order_details);

//Clear cart after placing the order
$_SESSION['cart'] = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>
    <p>Order Code: <?php echo htmlspecialchars($order_code); ?></p>
    <p>Date and Time Ordered: <?php echo date('Y-m-d H:i:s'); ?></p>
    <p>Total Price: <?php echo htmlspecialchars($total_price); ?> PHP</p>
</body>
</html>
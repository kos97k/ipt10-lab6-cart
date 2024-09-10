<?php
session_start();
require 'products.php';

// Check if product ID is set in POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    // Find the product in the products array
    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            // Add product to the cart session
            if (!isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = $product;
            }
            break;
        }
    }
}

// Redirect to the cart page
header('Location: cart.php');
exit();
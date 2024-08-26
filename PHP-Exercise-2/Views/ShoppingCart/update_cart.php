<?php
session_start();
require '../../Controllers/ShoppingCart.php';

$cart = new ShoppingCart();
$productId = $_POST['product_id'];
$quantity = $_POST['quantity'];
$cart->updateCart($productId, $quantity);

header('Location: cart.php');
exit;
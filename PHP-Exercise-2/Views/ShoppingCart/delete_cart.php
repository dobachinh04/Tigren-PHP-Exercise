<?php
session_start();
require '../../Controllers/ShoppingCart.php';

$cart = new ShoppingCart();
$productId = $_POST['product_id'];
$cart->deleteCart($productId);

header('Location: cart.php');
exit;
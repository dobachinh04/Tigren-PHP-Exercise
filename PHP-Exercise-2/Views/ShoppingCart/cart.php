<?php
session_start();
require '../../Models/Product.php';
require '../../Controllers/ShoppingCart.php';

// Kết nối cơ sở dữ liệu
$pdo = new PDO('mysql:host=localhost;dbname=tigren-week-1', 'root', '');

// Khởi tạo lớp Product và ShoppingCart
$product = new Product($pdo);
$cart = new ShoppingCart();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $cart->insertCart($productId, $quantity);
    header('Location: cart.php');
    exit;
}

$cartItems = $cart->contentCart();

$cart = new ShoppingCart();
$totalItems = $cart->totalCart();
?>

<?php include('layouts/header.php'); ?>

<h1 class="text-center">Shopping Cart</h1>
<a href="cart.php" class="btn btn-primary mb-3"><i class="fa-solid fa-cart-shopping"></i>
    (<?php echo $totalItems; ?>)</a>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $totalPrice = 0;
        foreach ($cartItems as $productId => $quantity):
            $productInfo = $product->getProductById($productId);
            $itemTotal = $productInfo['pro_price'] * $quantity;
            $totalPrice += $itemTotal;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($productInfo['pro_name']); ?></td>
                <td><?php echo number_format(($productInfo['pro_price']), 0, ".", "."); ?></td>
                <td>
                    <form method="POST" action="update_cart.php">
                        <div class="d-flex align-items-center">
                            <input type="hidden" class="form-control" name="product_id" value="<?php echo $productId; ?>">
                            <input type="number" class="form-control" name="quantity" value="<?php echo $quantity; ?>"
                                min="1">
                            <button type="submit" class="btn btn-primary text-nowrap p-2"
                                style="white-space: nowrap;">Update</button>
                    </form>
                </td>
                <td><?php echo number_format($itemTotal, 0, ".", "."); ?></td>
                <td>
                    <form method="POST" action="delete_cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">Total Price</td>
            <td><?php echo number_format($totalPrice, 0, ".", "."); ?></td>
            <td></td>
        </tr>

    </tfoot>
</table>
<a href="../Product/index.php" class="btn btn-secondary">Continue Shopping</a>

<?php include('layouts/footer.php'); ?>
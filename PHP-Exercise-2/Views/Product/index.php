<?php
session_start();
require '../../Models/Product.php';
require '../../Controllers/ShoppingCart.php';

// Kết nối cơ sở dữ liệu
$pdo = new PDO('mysql:host=localhost;dbname=tigren-week-1', 'root', '');

// Khởi tạo lớp Product và ShoppingCart
$product = new Product($pdo);
$cart = new ShoppingCart();

$products = $product->getAllProducts();

$cart = new ShoppingCart();
$totalItems = $cart->totalCart();
?>

<?php include('layouts/header.php'); ?>

<h1 class="text-center">Product List</h1>
<a href="../ShoppingCart/cart.php" class="btn btn-primary mb-3"><i class="fa-solid fa-cart-shopping"></i>
    (<?php echo $totalItems; ?>)</a>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?php echo htmlspecialchars($p['pro_name']); ?></td>
                <td><?php echo number_format(($p['pro_price']), 0, ".", "."); ?></td>
                <td>
                    <form method="POST" action="../ShoppingCart/add_to_cart.php">
                        <div class="d-flex align-items-center">
                            <input type="hidden" name="product_id" class="form-control" value="<?php echo $p['pro_id']; ?>">
                            <input type="number" name="quantity" class="form-control" min="1" value="1">
                            <button type="submit" class="btn btn-success text-nowrap p-2" style="white-space: nowrap;">Add
                                to Cart</button>
                        </div>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include('layouts/footer.php'); ?>
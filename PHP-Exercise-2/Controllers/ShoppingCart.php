<?php
class ShoppingCart
{
    private $cart = [];

    public function __construct()
    {
        if (isset($_SESSION['cart'])) {
            $this->cart = $_SESSION['cart'];
        }
    }

    // Thêm sản phẩm vào giỏ hàng
    public function insertCart($productId, $quantity)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId] += $quantity;
        } else {
            $this->cart[$productId] = $quantity;
        }
        $_SESSION['cart'] = $this->cart;
    }

    // Cập nhật thông tin sản phẩm trong giỏ hàng
    public function updateCart($productId, $quantity)
    {
        if ($quantity <= 0) {
            $this->deleteCart($productId);
        } else {
            $this->cart[$productId] = $quantity;
            $_SESSION['cart'] = $this->cart;
        }
    }

    // Xóa một sản phẩm khỏi giỏ hàng
    public function deleteCart($productId)
    {
        unset($this->cart[$productId]);
        $_SESSION['cart'] = $this->cart;
    }

    // Đếm tổng số sản phẩm trong giỏ hàng
    public function totalCart()
    {
        return array_sum($this->cart);
    }

    // Trả về danh sách các sản phẩm trong giỏ hàng
    public function contentCart()
    {
        return $this->cart;
    }
}
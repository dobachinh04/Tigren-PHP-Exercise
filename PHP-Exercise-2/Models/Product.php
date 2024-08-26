<?php
class Product
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Lấy danh sách sản phẩm
    public function getAllProducts()
    {
        $stmt = $this->pdo->query("SELECT * FROM product");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin sản phẩm theo ID
    public function getProductById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE pro_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
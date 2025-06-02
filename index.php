<?php
session_start();

$products = [
    1 => ['name' => 'Mobile Cover', 'price' => 300],
    2 => ['name' => 'Charger', 'price' => 800],
    3 => ['name' => 'Handfree', 'price' => 500],
    4 => ['name' => 'AirPods', 'price' => 2000],
    5 => ['name' => 'Power Bank', 'price' => 1500]
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['product_id'];
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $_SESSION['cart'][$id] = ['product' => $products[$id], 'quantity' => 1];
    }

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Usman's Shop - PHP Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .product-card {
            transition: transform 0.2s ease-in-out;
        }
        .product-card:hover {
            transform: scale(1.03);
        }
        .shop-header {
            background-color: #0d6efd;
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
        .btn-cart {
            background-color: #28a745;
            border: none;
        }
        .btn-cart:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="shop-header text-center mb-5">
        <h1>Welcome to Usman's Shop</h1>
        <p>Your one-stop shop for mobile accessories</p>
        <a href="cart.php" class="btn btn-light mt-3">View Cart </a>
    </div>

    <div class="row g-4">
        <?php foreach ($products as $id => $product): ?>
            <div class="col-md-4 col-sm-6">
                <div class="card product-card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                        <p class="card-text">Price: <strong>Rs. <?= $product['price'] ?></strong></p>
                        <form method="post">
                            <input type="hidden" name="product_id" value="<?= $id ?>">
                            <button type="submit" class="btn btn-cart">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

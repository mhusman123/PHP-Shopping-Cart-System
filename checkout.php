<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;

foreach ($cart as $item) {
    $total += $item['product']['price'] * $item['quantity'];
}

session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Usman's Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .thankyou-box {
            background-color: #d4edda;
            border-left: 5px solid #28a745;
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }
        .btn-shop-again {
            background-color: #007bff;
            border: none;
        }
        .btn-shop-again:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="thankyou-box shadow text-center">
        <h2>Thank you for your purchase!</h2>
        <p class="lead">Your total bill is <strong>Rs. <?= $total ?></strong>.</p>
        <p>We hope to see you again soon!</p>
        <a href="index.php" class="btn btn-shop-again mt-3">← Shop Again</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

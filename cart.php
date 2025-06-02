<?php
session_start();

// Remove item if requested
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_id'])) {
    $remove_id = $_POST['remove_id'];
    unset($_SESSION['cart'][$remove_id]);
}

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart - Naveed's Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .cart-header {
            background-color: #343a40;
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .btn-checkout {
            background-color: #ffc107;
            border: none;
        }
        .btn-checkout:hover {
            background-color: #e0a800;
        }
        .btn-remove {
            background-color: #dc3545;
            border: none;
            padding: 5px 10px;
        }
        .btn-remove:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="cart-header mb-5">
        <h1>Your Shopping Cart</h1>
    </div>

    <?php if (empty($cart)): ?>
        <div class="alert alert-info text-center">Your cart is currently empty.</div>
        <div class="text-center">
            <a href="index.php" class="btn btn-primary">← Back to Shop</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered bg-white shadow-sm align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Item</th>
                        <th>Price (Rs.)</th>
                        <th>Quantity</th>
                        <th>Subtotal (Rs.)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $id => $item): 
                        $lineTotal = $item['product']['price'] * $item['quantity'];
                        $total += $lineTotal;
                    ?>
                    <tr>
                        <td><?= $item['product']['name'] ?></td>
                        <td><?= $item['product']['price'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= $lineTotal ?></td>
                        <td>
                            <form method="post" onsubmit="return confirm('Remove this item?');">
                                <input type="hidden" name="remove_id" value="<?= $id ?>">
                                <button type="submit" class="btn btn-remove">Remove</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h4 class="text-end">Total Bill: <strong>Rs. <?= $total ?></strong></h4>

        <div class="d-flex justify-content-between mt-4">
            <a href="index.php" class="btn btn-secondary">← Continue Shopping</a>
            <a href="checkout.php" class="btn btn-checkout">Proceed to Checkout →</a>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

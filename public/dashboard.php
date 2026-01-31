<?php
session_start();
if (!isset($_SESSION['user'])) header('Location: login.php');
require '../config/db.php';
require '../templates/header.php';
?>

<h2>Dashboard</h2>
<div class="cards">
<div class="card">Products<br><?= $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn() ?></div>
<div class="card low">Low Stock<br><?= $pdo->query("SELECT COUNT(*) FROM products WHERE quantity < 5")->fetchColumn() ?></div>
</div>

<h3>Low Stock Alerts</h3>
<table>
<tr><th>Product</th><th>Qty</th></tr>
<?php foreach ($pdo->query("SELECT name,quantity FROM products WHERE quantity < 5") as $p): ?>
<tr><td><?= htmlspecialchars($p['name']) ?></td><td><?= $p['quantity'] ?></td></tr>
<?php endforeach; ?>
</table>

<a href="index.php">Manage Products</a>
<?php require '../templates/footer.php'; ?>
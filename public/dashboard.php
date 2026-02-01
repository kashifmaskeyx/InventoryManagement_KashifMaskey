<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: welcome.php');
    exit;
}

require '../config/db.php';
require '../templates/header.php';

// Stats
$totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalSuppliers = $pdo->query("SELECT COUNT(*) FROM suppliers")->fetchColumn();
$lowStock = $pdo->query("SELECT COUNT(*) FROM products WHERE quantity < 5")->fetchColumn();
$totalValue = $pdo->query("SELECT SUM(quantity * price) FROM products")->fetchColumn();
?>

<h1>Dashboard</h1>
<p class="subtitle">Welcome back, <?= htmlspecialchars($_SESSION['user']) ?> 👋</p>

<div class="stats">
    <div class="stat-card">
        <h3>Total Products</h3>
        <p><?= $totalProducts ?></p>
    </div>
    <div class="stat-card">
        <h3>Suppliers</h3>
        <p><?= $totalSuppliers ?></p>
    </div>
    <div class="stat-card warning">
        <h3>Low Stock</h3>
        <p><?= $lowStock ?></p>
    </div>
    <div class="stat-card">
        <h3>Total Stock Value</h3>
        <p>$<?= number_format($totalValue ?? 0, 2) ?></p>
    </div>
</div>

<div class="dashboard-grid">
    <div class="panel">
        <h3>⚠ Low Stock Alerts</h3>
        <table>
            <tr><th>Product</th><th>Qty</th></tr>
            <?php
            $stmt = $pdo->query("SELECT name, quantity FROM products WHERE quantity < 5");
            foreach ($stmt as $p):
            ?>
            <tr>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td class="danger"><?= $p['quantity'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="panel">
        <h3>🕒 Recently Added</h3>
        <table>
            <tr><th>Product</th><th>Qty</th></tr>
            <?php
            $stmt = $pdo->query("SELECT name, quantity FROM products ORDER BY id DESC LIMIT 5");
            foreach ($stmt as $p):
            ?>
            <tr>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td><?= $p['quantity'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php require '../templates/footer.php'; ?>

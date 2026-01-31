<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: welcome.php');
    exit;
}

require '../config/db.php';
require '../templates/header.php';

$totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$lowStock = $pdo->query("SELECT COUNT(*) FROM products WHERE quantity < 5")->fetchColumn();
$totalStock = $pdo->query("SELECT SUM(quantity) FROM products")->fetchColumn();
?>

<div class="dashboard-header">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['user']) ?> 👋</h1>
    <p>Here’s what’s happening in your inventory today</p>
</div>

<!-- KPI CARDS -->
<div class="dashboard-cards">
    <div class="dash-card">
        <h4>Total Products</h4>
        <span><?= $totalProducts ?></span>
    </div>

    <div class="dash-card">
        <h4>Total Stock Units</h4>
        <span><?= $totalStock ?? 0 ?></span>
    </div>

    <div class="dash-card alert">
        <h4>Low Stock Items</h4>
        <span><?= $lowStock ?></span>
    </div>
</div>

<!-- QUICK ACTIONS -->
<div class="section">
    <h2>Quick Actions</h2>
    <div class="quick-actions">
        <a class="btn" href="add.php">➕ Add Product</a>
        <a class="btn secondary" href="index.php">📦 Manage Inventory</a>
        <a class="btn secondary" href="logout.php">🚪 Logout</a>
    </div>
</div>

<!-- LOW STOCK TABLE -->
<div class="section">
    <h2>Low Stock Alerts</h2>

    <?php
    $stmt = $pdo->query("SELECT name, quantity FROM products WHERE quantity < 5");
    if ($stmt->rowCount() === 0):
    ?>
        <p class="success">✅ All products are sufficiently stocked.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($stmt as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><span class="badge danger">Low Stock</span></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require '../templates/footer.php'; ?>

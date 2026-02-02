<?php
session_start();

// Ensure user is logged in and has user_id
if (!isset($_SESSION['user']) || !isset($_SESSION['user_id'])) {
    header('Location: welcome.php');
    exit;
}

require '../config/db.php';
require '../templates/header.php';

// Stats filtered by current user
$user_id = $_SESSION['user_id'];

$totalProducts = $pdo->prepare("SELECT COUNT(*) FROM products WHERE user_id = ?");
$totalProducts->execute([$user_id]);
$totalProducts = $totalProducts->fetchColumn();

$lowStock = $pdo->prepare("SELECT COUNT(*) FROM products WHERE quantity < 5 AND user_id = ?");
$lowStock->execute([$user_id]);
$lowStock = $lowStock->fetchColumn();

$totalValue = $pdo->prepare("SELECT SUM(quantity * price) FROM products WHERE user_id = ?");
$totalValue->execute([$user_id]);
$totalValue = $totalValue->fetchColumn();
?>

<h1>Dashboard</h1>
<p class="subtitle">Welcome back, <?= htmlspecialchars($_SESSION['user']) ?> 👋</p>

<div class="stats">
    <div class="stat-card">
        <h3>Total Products</h3>
        <p><?= $totalProducts ?></p>
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
            $stmt = $pdo->prepare("SELECT name, quantity FROM products WHERE quantity < 5 AND user_id = ?");
            $stmt->execute([$user_id]);
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
            $stmt = $pdo->prepare("SELECT name, quantity FROM products WHERE user_id = ? ORDER BY id DESC LIMIT 5");
            $stmt->execute([$user_id]);
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

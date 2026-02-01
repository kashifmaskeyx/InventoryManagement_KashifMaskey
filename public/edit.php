<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: welcome.php');
    exit;
}
require '../config/db.php';
require '../templates/header.php';

$id = $_GET['id'];
$success = '';

// Fetch product for this user
$stmt = $pdo->prepare("SELECT * FROM products WHERE id=? AND user_id=?");
$stmt->execute([$id, $_SESSION['user_id']]);
$p = $stmt->fetch();

if (!$p) {
    echo "<div class='main'><p class='error'>Product not found.</p></div>";
    require '../templates/footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $category = trim($_POST['category']);
    $supplier = trim($_POST['supplier']);
    $qty      = (int)$_POST['quantity'];
    $price    = (float)$_POST['price'];

    // Check supplier
    $stmt = $pdo->prepare("SELECT id FROM suppliers WHERE name=?");
    $stmt->execute([$supplier]);
    $supplierRow = $stmt->fetch();

    if ($supplierRow) {
        $supplierId = $supplierRow['id'];
    } else {
        $stmt = $pdo->prepare("INSERT INTO suppliers (name) VALUES (?)");
        $stmt->execute([$supplier]);
        $supplierId = $pdo->lastInsertId();
    }

    // Update product
    $stmt = $pdo->prepare("UPDATE products SET name=?, category=?, quantity=?, price=?, supplier_id=? WHERE id=? AND user_id=?");
    $stmt->execute([$name, $category, $qty, $price, $supplierId, $id, $_SESSION['user_id']]);
    $success = "Product updated successfully!";
}
?>

<div class="main">
    <h2>Edit Product</h2>
    <?php if ($success): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Name</label>
        <input name="name" value="<?= htmlspecialchars($p['name']) ?>" required>
        <label>Category</label>
        <input name="category" value="<?= htmlspecialchars($p['category']) ?>">
        <label>Supplier</label>
        <input name="supplier" value="<?= htmlspecialchars($pdo->query("SELECT name FROM suppliers WHERE id={$p['supplier_id']}")->fetchColumn()) ?>" required>
        <label>Quantity</label>
        <input type="number" name="quantity" value="<?= $p['quantity'] ?>" min="0" required>
        <label>Price</label>
        <input type="number" step="0.01" name="price" value="<?= $p['price'] ?>" required>
        <button>Update</button>
    </form>
</div>

<?php require '../templates/footer.php'; ?>

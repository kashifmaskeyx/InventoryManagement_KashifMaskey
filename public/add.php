<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: welcome.php');
    exit;
}
require '../config/db.php';
require '../templates/header.php';

$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $category = trim($_POST['category']);
    $supplier = trim($_POST['supplier']);
    $qty      = (int)$_POST['quantity'];
    $price    = (float)$_POST['price'];

    // Check supplier
    $stmt = $pdo->prepare("SELECT id FROM suppliers WHERE name = ?");
    $stmt->execute([$supplier]);
    $supplierRow = $stmt->fetch();

    if ($supplierRow) {
        $supplierId = $supplierRow['id'];
    } else {
        $stmt = $pdo->prepare("INSERT INTO suppliers (name) VALUES (?)");
        $stmt->execute([$supplier]);
        $supplierId = $pdo->lastInsertId();
    }

    // Check product for current user
    $check = $pdo->prepare("SELECT id, quantity FROM products WHERE name=? AND supplier_id=? AND user_id=?");
    $check->execute([$name, $supplierId, $_SESSION['user_id']]);
    $product = $check->fetch();

    if ($product) {
        $update = $pdo->prepare("UPDATE products SET quantity = quantity + ? WHERE id = ?");
        $update->execute([$qty, $product['id']]);
        $success = "Product restocked successfully!";
    } else {
        $insert = $pdo->prepare("INSERT INTO products (name, supplier_id, category, quantity, price, user_id) VALUES (?, ?, ?, ?, ?, ?)");
        $insert->execute([$name, $supplierId, $category, $qty, $price, $_SESSION['user_id']]);
        $success = "Product added successfully!";
    }
}
?>

<div class="main">
    <h2>Add / Restock Product</h2>
    <?php if ($success): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Name</label>
        <input name="name" placeholder="Type product name" required>
        <label>Category</label>
        <input name="category" placeholder="Type category">
        <label>Supplier</label>
        <input name="supplier" placeholder="Type supplier name" required>
        <label>Quantity</label>
        <input type="number" name="quantity" placeholder="Enter quantity" min="1" required>
        <label>Price</label>
        <input type="number" step="0.01" name="price" placeholder="Enter price" required>
        <button>Add / Restock</button>
    </form>
</div>

<?php require '../templates/footer.php'; ?>

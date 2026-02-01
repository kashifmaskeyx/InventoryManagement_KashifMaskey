<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name     = trim($_POST['name']);
    $category = trim($_POST['category']);
    $supplier = (int)$_POST['supplier'];
    $qty      = (int)$_POST['quantity'];
    $price    = (float)$_POST['price'];

    // 1️⃣ Check if product already exists (same name + supplier)
    $check = $pdo->prepare("
        SELECT id, quantity 
        FROM products 
        WHERE name = ? AND supplier_id = ?
    ");
    $check->execute([$name, $supplier]);
    $product = $check->fetch();

    if ($product) {
        // 2️⃣ Product exists → RESTOCK
        $update = $pdo->prepare("
            UPDATE products
            SET quantity = quantity + ?
            WHERE id = ?
        ");
        $update->execute([$qty, $product['id']]);

    } else {
        // 3️⃣ Product does not exist → INSERT
        $insert = $pdo->prepare("
            INSERT INTO products (name, supplier_id, category, quantity, price)
            VALUES (?, ?, ?, ?, ?)
        ");
        $insert->execute([$name, $supplier, $category, $qty, $price]);
    }

    header("Location: index.php");
    exit;
}

// Load suppliers for dropdown
$suppliers = $pdo->query("SELECT * FROM suppliers");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<form method="post">
    <label>Name</label>
    <input name="name" required>

    <label>Category</label>
    <input name="category">

    <label>Supplier</label>
    <select name="supplier" required>
        <?php foreach ($suppliers as $s): ?>
            <option value="<?= $s['id'] ?>">
                <?= htmlspecialchars($s['name']) ?>
            </option>
        <?php endforeach; ?>
    </select> <br>

    <label>Quantity</label>
    <input type="number" name="quantity" min="1" required>

    <label>Price</label>
    <input type="number" step="0.01" name="price" required>

    <button>Add / Restock</button>
</form>

</body>
</html>

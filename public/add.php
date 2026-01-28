<?php require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $supplier = $_POST['supplier'];
    $qty = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO products (name, supplier_id, category, quantity, price)
        VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $supplier, $category, $qty, $price]);

    header("Location: index.php");
    exit;
}

$suppliers = $pdo->query("SELECT * FROM suppliers");
?>
<head><link rel="stylesheet" href="../assets/css/style.css">
</head>
<form method="post">
    Name: <input name="name" required><br>
    Category: <input name="category"><br>
    Supplier:
    <select name="supplier">
        <?php foreach ($suppliers as $s): ?>
            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option>
        <?php endforeach; ?>
    </select><br>
    Quantity: <input type="number" name="quantity" required><br>
    Price: <input type="number" step="0.01" name="price" required><br>
    <button>Add</button>
</form>
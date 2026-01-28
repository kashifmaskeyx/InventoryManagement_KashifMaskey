<?php require '../config/db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE products SET name=?, category=?, quantity=?, price=? WHERE id=?");
    $stmt->execute([
        $_POST['name'], $_POST['category'], $_POST['quantity'], $_POST['price'], $id
    ]);
    header("Location: index.php");
    exit;
}

$product = $pdo->prepare("SELECT * FROM products WHERE id=?");
$product->execute([$id]);
$p = $product->fetch();
?>
<head><link rel="stylesheet" href="../assets/css/style.css">
</head>
<form method="post">
    Name: <input name="name" value="<?= htmlspecialchars($p['name']) ?>"><br>
    Category: <input name="category" value="<?= htmlspecialchars($p['category']) ?>"><br>
    Quantity: <input name="quantity" value="<?= $p['quantity'] ?>"><br>
    Price: <input name="price" value="<?= $p['price'] ?>"><br>
    <button>Update</button>
</form>
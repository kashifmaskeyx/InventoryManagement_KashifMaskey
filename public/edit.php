<?php
require '../config/db.php';
$id = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$p = $stmt->fetch();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$stmt = $pdo->prepare("UPDATE products SET name=?, category=?, quantity=?, price=? WHERE id=?");
	$stmt->execute([
		$_POST['name'], $_POST['category'], $_POST['quantity'], $_POST['price'], $id
	]);
header("Location: index.php");
}
?>


<form method="post">
<input name="name" value="<?= htmlspecialchars($p['name']) ?>"><br>
<input name="category" value="<?= htmlspecialchars($p['category']) ?>"><br>
<input name="quantity" value="<?= $p['quantity'] ?>"><br>
<input name="price" value="<?= $p['price'] ?>"><br>
<button>Update</button>
</form>
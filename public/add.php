<?php
require '../config/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$stmt = $pdo->prepare("INSERT INTO products VALUES (NULL, ?, ?, ?, ?)");
	$stmt->execute([

		$_POST['name'],
		$_POST['category'],
		$_POST['quantity'],
		$_POST['price']
	]);
	header("Location: index.php");
}
?>
<form method="post">
<input name="name" required placeholder="Name"><br>
<input name="category" required placeholder="Category"><br>
<input type="number" name="quantity" required><br>
<input type="number" step="0.01" name="price" required><br>
<button>Add</button>
</form>

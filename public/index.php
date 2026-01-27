<?php
require '../config/db.php';
include '../templates/header.php';


$stmt = $con->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>


<table border="1">
<tr><th>Name</th><th>Category</th><th>Qty</th><th>Price</th></tr>
<?php foreach ($products as $p): ?>
<tr>
<td><?= htmlspecialchars($p['name']) ?></td>
<td><?= htmlspecialchars($p['category']) ?></td>
<td><?= $p['quantity'] ?></td>
<td><?= $p['price'] ?></td>
</tr>
<?php endforeach; ?>
</table>


<?php include '../templates/footer.php'; ?>
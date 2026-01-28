<?php require '../config/db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventory System</title>
    <script src="../assets/js/search.js" defer></script>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<h2>Inventory & Stock Tracking</h2>
<a href="add.php">Add Product</a><br><br>

<input type="text" id="search" placeholder="Search products...">

<table border="1" width="100%">
<tr>
    <th>Name</th>
    <th>Category</th>
    <th>Supplier</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Actions</th>
</tr>
<tbody id="results">
<?php
$stmt = $pdo->query("SELECT products.*, suppliers.name AS supplier
    FROM products JOIN suppliers ON products.supplier_id = suppliers.id");
foreach ($stmt as $row): ?>
<tr>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['category']) ?></td>
    <td><?= htmlspecialchars($row['supplier']) ?></td>
    <td><?= $row['quantity'] ?></td>
    <td><?= $row['price'] ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</body>
</html>
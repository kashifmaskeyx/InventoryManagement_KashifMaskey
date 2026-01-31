<?php
session_start();

/* If user is NOT logged in, send them to welcome page */
if (!isset($_SESSION['user'])) {
    header('Location: welcome.php');
    exit;
}

require '../config/db.php';
require '../templates/header.php';
?>

<h2>Products</h2>

<a class="btn" href="add.php">+ Add Product</a>

<input id="search" placeholder="Search...">

<table>
<thead>
<tr>
    <th>Name</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Actions</th>
</tr>
</thead>
<tbody id="results">
<?php foreach ($pdo->query("SELECT * FROM products") as $p): ?>
<tr>
    <td><?= htmlspecialchars($p['name']) ?></td>
    <td><?= $p['quantity'] ?></td>
    <td><?= $p['price'] ?></td>
    <td>
        <a href="edit.php?id=<?= $p['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Delete this product?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<script src="../assets/js/search.js"></script>

<?php require '../templates/footer.php'; ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Inventory System</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php if (isset($_SESSION['user'])): ?>
<nav class="navbar">
    <div class="nav-left">
        <span class="logo">InventorySys</span>
        <a href="dashboard.php">Dashboard</a>
        <a href="index.php">Products</a>
        <a href="add.php">Add Product</a>
    </div>
    <div class="nav-right">
        <span class="user">👤 <?= htmlspecialchars($_SESSION['user']) ?></span>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</nav>
<?php endif; ?>

<div class="container">

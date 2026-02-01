<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
require '../templates/header.php';
?>

<div class="welcome-container">
    <div class="welcome-content">
        <h1>Inventory & Stock Management</h1>
        <p>Track your products, manage stock levels, and get alerts on low inventory – all in one simple system.</p>

        <div class="welcome-buttons">
            <a href="login.php" class="btn">Login</a>
            <a href="register.php" class="btn btn-secondary">Register</a>
        </div>
    </div>
</div>

<?php require '../templates/footer.php'; ?>

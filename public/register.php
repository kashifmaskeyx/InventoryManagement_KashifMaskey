<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $user = trim($_POST['username']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username,password) VALUES (?,?)");
    try {
        $stmt->execute([$user,$pass]);
        header('Location: login.php'); exit;
    } catch(PDOException $e){ $error = 'Username already exists'; }
}
require '../templates/header.php';
?>
<h2>Create Account</h2>
<form method="post">
<input name="username" required placeholder="Username">
<input type="password" name="password" required placeholder="Password">
<button>Register</button>
<p class="error"><?= $error ?? '' ?></p>
</form>
<?php require '../templates/footer.php'; ?>
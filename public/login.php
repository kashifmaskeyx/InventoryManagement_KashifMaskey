<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $stmt=$pdo->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$_POST['username']]);
    $u=$stmt->fetch();
    if($u && password_verify($_POST['password'],$u['password'])){
        $_SESSION['user']=$u['username'];
        header('Location: dashboard.php'); exit;
    }
    $error='Invalid credentials';
}
require '../templates/header.php';
?>
<h2>Login</h2>
<form method="post">
<input name="username" required placeholder="Username">
<input type="password" name="password" required placeholder="Password">
<button>Login</button>
<p class="error"><?= $error ?? '' ?></p>
</form>
<?php require '../templates/footer.php'; ?>
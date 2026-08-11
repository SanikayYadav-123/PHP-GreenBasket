<?php
session_start(); require 'includes/header.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
  require 'config/database.php';
  $email=trim($_POST['email']); $password=$_POST['password'];
  $stmt=$conn->prepare("SELECT id,name,password FROM users WHERE email=?"); $stmt->bind_param("s",$email); $stmt->execute();
  $u=$stmt->get_result()->fetch_assoc();
  if($u && password_verify($password,$u['password'])){ $_SESSION['user']=$u['name']; header("Location: index.php"); exit; }
  $error="Invalid email or password.";
}
?>
<section class="section narrow"><h1>Welcome back</h1><?php if(isset($error)): ?><div class="error"><?= $error ?></div><?php endif; ?>
<form method="post" class="form"><input type="email" name="email" placeholder="Email" required><input type="password" name="password" placeholder="Password" required><button class="btn">Login</button></form>
<p>New here? <a href="register.php">Create an account</a></p></section>
<?php require 'includes/footer.php'; ?>
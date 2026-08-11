<?php
session_start(); require 'config/database.php';
$message='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $name=trim($_POST['name']); $email=trim($_POST['email']); $password=$_POST['password'];
 if($name && filter_var($email,FILTER_VALIDATE_EMAIL) && strlen($password)>=6){
  $hash=password_hash($password,PASSWORD_DEFAULT);
  $stmt=$conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)"); $stmt->bind_param("sss",$name,$email,$hash);
  if($stmt->execute()) { $_SESSION['user']=$name; header("Location: index.php"); exit; } else $message="Email may already be registered.";
 } else $message="Use a valid email and password of at least 6 characters.";
}
require 'includes/header.php'; ?>
<section class="section narrow"><h1>Create Account</h1><?php if($message): ?><div class="error"><?= htmlspecialchars($message) ?></div><?php endif; ?>
<form method="post" class="form"><input name="name" placeholder="Full name" required><input type="email" name="email" placeholder="Email" required><input type="password" name="password" placeholder="Password (6+ characters)" required><button class="btn">Register</button></form></section>
<?php require 'includes/footer.php'; ?>
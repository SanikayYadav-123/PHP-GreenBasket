<?php
session_start(); require '../config/database.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $name=trim($_POST['name']);$email=trim($_POST['email']);$password=$_POST['password'];
 $stmt=$conn->prepare("SELECT * FROM users WHERE email=?");$stmt->bind_param("s",$email);$stmt->execute();$u=$stmt->get_result()->fetch_assoc();
 if($u && password_verify($password,$u['password'])) $_SESSION['admin']=true;
}
if(empty($_SESSION['admin'])): ?>
<!doctype html><html><body style="font-family:Arial;max-width:420px;margin:80px auto"><h1>GreenBasket Admin</h1><form method="post"><input name="email" placeholder="Email" style="width:100%;padding:12px;margin:6px 0"><input type="password" name="password" placeholder="Password" style="width:100%;padding:12px;margin:6px 0"><button style="padding:12px">Login</button></form><p>Register a normal account first, then use those credentials for this demo admin panel.</p></body></html>
<?php exit; endif;
$count=$conn->query("SELECT COUNT(*) c FROM products")->fetch_assoc()['c'];$orders=$conn->query("SELECT COUNT(*) c FROM orders")->fetch_assoc()['c'];
?>
<!doctype html><html><body style="font-family:Arial;background:#f7faf7;padding:40px"><h1>GreenBasket Admin</h1><p>Products: <?= $count ?> &nbsp; Orders: <?= $orders ?></p><a href="../products.php">View Store</a></body></html>
<?php
session_start();
require 'config/database.php';
if(empty($_SESSION['cart'])) { header("Location: products.php"); exit; }
$message='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name=trim($_POST['name']); $email=trim($_POST['email']); $address=trim($_POST['address']);
  if($name && filter_var($email,FILTER_VALIDATE_EMAIL) && $address){
    $total=0; $ids=implode(',',array_map('intval',array_keys($_SESSION['cart'])));
    $res=$conn->query("SELECT * FROM products WHERE id IN ($ids)");
    while($p=$res->fetch_assoc()) $total += $p['price']*$_SESSION['cart'][$p['id']];
    $stmt=$conn->prepare("INSERT INTO orders(customer_name,email,address,total) VALUES(?,?,?,?)");
    $stmt->bind_param("sssd",$name,$email,$address,$total); $stmt->execute();
    $_SESSION['cart']=[]; $message="Order placed successfully! Order #".$stmt->insert_id;
  } else $message="Please enter valid details.";
}
require 'includes/header.php';
?>
<section class="section narrow"><h1>Checkout</h1>
<?php if($message): ?><div class="notice"><?= htmlspecialchars($message) ?></div><?php endif; ?>
<?php if(!str_contains($message,'successfully')): ?>
<form method="post" class="form">
<input name="name" placeholder="Full name" required>
<input type="email" name="email" placeholder="Email address" required>
<textarea name="address" placeholder="Delivery address" required></textarea>
<button class="btn">Place Order</button>
</form>
<?php endif; ?></section>
<?php require 'includes/footer.php'; ?>
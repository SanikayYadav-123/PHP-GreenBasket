<?php
session_start();
require 'config/database.php';
if (!isset($_SESSION['cart'])) $_SESSION['cart']=[];
if(isset($_GET['add'])){
  $id=(int)$_GET['add'];
  $_SESSION['cart'][$id]=($_SESSION['cart'][$id]??0)+1;
  header("Location: cart.php"); exit;
}
if(isset($_GET['remove'])) { unset($_SESSION['cart'][(int)$_GET['remove']]); header("Location: cart.php"); exit; }
$items=[]; $total=0;
if($_SESSION['cart']){
  $ids=implode(',',array_map('intval',array_keys($_SESSION['cart'])));
  $res=$conn->query("SELECT * FROM products WHERE id IN ($ids)");
  while($p=$res->fetch_assoc()){ $p['qty']=$_SESSION['cart'][$p['id']]; $p['subtotal']=$p['qty']*$p['price']; $total+=$p['subtotal']; $items[]=$p; }
}
require 'includes/header.php';
?>
<section class="section">
<h1>Your Cart</h1>
<?php if(!$items): ?><div class="empty">Your cart is empty. <a href="products.php">Start shopping</a>.</div>
<?php else: ?>
<div class="cart-list">
<?php foreach($items as $p): ?>
<div class="cart-item"><span class="emoji"><?= $p['emoji'] ?></span><div><h3><?= htmlspecialchars($p['name']) ?></h3><p>Qty: <?= $p['qty'] ?></p></div><strong>₹<?= number_format($p['subtotal'],2) ?></strong><a href="cart.php?remove=<?= $p['id'] ?>">Remove</a></div>
<?php endforeach; ?>
</div>
<div class="summary"><h2>Total: ₹<?= number_format($total,2) ?></h2><a class="btn" href="checkout.php">Checkout</a></div>
<?php endif; ?>
</section>
<?php require 'includes/footer.php'; ?>
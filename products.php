<?php
require 'config/database.php';
require 'includes/header.php';
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>
<section class="section">
  <div class="section-head"><h1>Our Products</h1><a href="cart.php">🛒 Cart</a></div>
  <div class="products">
  <?php while($p=$result->fetch_assoc()): ?>
    <article class="product">
      <div class="product-img"><?= htmlspecialchars($p['emoji']) ?></div>
      <div class="product-body">
        <small><?= htmlspecialchars($p['category']) ?></small>
        <h3><?= htmlspecialchars($p['name']) ?></h3>
        <p><?= htmlspecialchars($p['description']) ?></p>
        <div class="price-row"><strong>₹<?= number_format($p['price'],2) ?></strong>
        <a class="btn small" href="cart.php?add=<?= $p['id'] ?>">Add to Cart</a></div>
      </div>
    </article>
  <?php endwhile; ?>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
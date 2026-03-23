<?php
// dashboard.php – User dashboard
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

if (!isLoggedIn()) {
    setFlash('info', 'Please login to access your dashboard.');
    redirect('auth/login.php');
}

$db     = getDB();
$userId = currentUserId();

// Recent 5 orders
$stmt = $db->prepare('
    SELECT o.*,
           (SELECT COUNT(*) FROM order_items WHERE order_id = o.id) AS item_count
    FROM orders o
    WHERE o.user_id = ?
    ORDER BY o.order_date DESC
    LIMIT 5
');
$stmt->execute([$userId]);
$recentOrders = $stmt->fetchAll();

// Stats
$statsStmt = $db->prepare('
    SELECT
      COUNT(*)                                         AS total_orders,
      COALESCE(SUM(total_amount),0)                    AS total_spent,
      SUM(status = "Confirmed" OR status = "Processing") AS active_orders,
      SUM(status = "Delivered")                        AS delivered_orders
    FROM orders
    WHERE user_id = ?
');
$statsStmt->execute([$userId]);
$stats = $statsStmt->fetch();

$statusColor = [
    'Confirmed'  => 'success',
    'Processing' => 'primary',
    'Delivered'  => 'info',
    'Cancelled'  => 'danger',
];
?>
<!DOCTYPE html>
<html lang="en">
<head><?php renderHead('FreshMart – Dashboard'); ?></head>
<body>
<?php renderNav('dashboard'); ?>

<div class="page-hero">
  <div class="container">
    <h1><i class="bi bi-person-circle me-3"></i>My Dashboard</h1>
    <p class="opacity-75 mb-0">Welcome back, <strong><?= sanitize(currentUsername()) ?></strong>!</p>
  </div>
</div>

<section class="py-5" style="background:var(--body-bg)">
  <div class="container">

    <?= renderFlash() ?>

    <!-- Stats Row -->
    <div class="row g-3 mb-4">
      <?php
      $tiles = [
        ['icon'=>'bag-check-fill','color'=>'success','label'=>'Total Orders',   'val'=>(int)$stats['total_orders']],
        ['icon'=>'currency-exchange','color'=>'warning','label'=>'Total Spent', 'val'=>'Rs. '.number_format((float)$stats['total_spent'],0)],
        ['icon'=>'clock-history','color'=>'primary','label'=>'Active Orders',   'val'=>(int)$stats['active_orders']],
        ['icon'=>'truck','color'=>'info','label'=>'Delivered',                  'val'=>(int)$stats['delivered_orders']],
      ];
      foreach ($tiles as $t): ?>
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100">
          <div class="mb-2" style="font-size:2rem;color:var(--<?=$t['color']===''?'green':$t['color']?>)">
            <i class="bi bi-<?= $t['icon'] ?>"></i>
          </div>
          <div style="font-size:1.5rem;font-weight:700"><?= $t['val'] ?></div>
          <div class="text-muted" style="font-size:.82rem"><?= $t['label'] ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Recent Orders -->
    <div class="card border-0 shadow-sm rounded-4 p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0"><i class="bi bi-receipt text-success me-2"></i>Recent Orders</h5>
        <a href="orders.php" class="btn btn-sm btn-outline-success rounded-pill">View All</a>
      </div>

      <?php if (empty($recentOrders)): ?>
        <div class="text-center py-4 text-muted">
          <div style="font-size:3rem">📦</div>
          <p class="mt-2">No orders yet. <a href="products.php" class="text-success">Start shopping!</a></p>
        </div>
      <?php else: ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>Order Ref</th>
                <th>Date</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($recentOrders as $o):
              $sc = $statusColor[$o['status']] ?? 'secondary';
            ?>
              <tr>
                <td><strong><?= sanitize($o['order_ref']) ?></strong></td>
                <td style="font-size:.85rem"><?= date('d M Y H:i', strtotime($o['order_date'])) ?></td>
                <td><?= (int)$o['item_count'] ?> item<?= $o['item_count']!=1?'s':'' ?></td>
                <td>Rs. <?= number_format((float)$o['total_amount'], 0) ?></td>
                <td><span class="badge bg-<?= $sc ?> rounded-pill"><?= sanitize($o['status']) ?></span></td>
                <td><a href="orders.php" class="btn btn-sm btn-outline-secondary rounded-pill">Details</a></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>

<?php renderCartCanvas(); ?>
<?php renderFooter(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>
</body>
</html>

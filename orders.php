<?php
// orders.php – My Orders (DB-backed for logged-in users, localStorage fallback for guests)
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$loggedIn = isLoggedIn();
$dbOrders = [];

if ($loggedIn) {
    $db   = getDB();
    $stmt = $db->prepare('
        SELECT o.*
        FROM orders o
        WHERE o.user_id = ?
        ORDER BY o.order_date DESC
    ');
    $stmt->execute([currentUserId()]);
    $rawOrders = $stmt->fetchAll();

    foreach ($rawOrders as $row) {
        $iStmt = $db->prepare('SELECT * FROM order_items WHERE order_id = ?');
        $iStmt->execute([$row['id']]);
        $row['items'] = $iStmt->fetchAll();
        $dbOrders[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><?php renderHead('FreshMart – My Orders'); ?></head>
<body>
<?php renderNav('orders'); ?>

<div class="orders-hero">
  <div class="container">
    <h1><i class="bi bi-bag-check me-3"></i>My Orders</h1>
    <p class="opacity-75 mb-0">Track, manage and reorder your past purchases</p>
  </div>
</div>

<section class="py-5" style="background:var(--body-bg)">
  <div class="container">

    <?php if (!$loggedIn): ?>
      <!-- Guest notice -->
      <div class="alert alert-info rounded-3 mb-4">
        <i class="bi bi-info-circle-fill me-2"></i>
        <strong>You are browsing as a guest.</strong>
        Your orders are saved locally in this browser.
        <a href="auth/login.php" class="alert-link">Login</a> to see your orders from any device.
      </div>
    <?php endif; ?>

    <div class="orders-tabs">
      <button class="orders-tab active" data-filter="all"       onclick="filterOrdersTab('all',this)">All Orders</button>
      <button class="orders-tab"        data-filter="confirmed" onclick="filterOrdersTab('confirmed',this)">Confirmed</button>
      <button class="orders-tab"        data-filter="delivered" onclick="filterOrdersTab('delivered',this)">Delivered</button>
      <button class="orders-tab"        data-filter="cancelled" onclick="filterOrdersTab('cancelled',this)">Cancelled</button>
    </div>

    <div id="ordersContainer"></div>
  </div>
</section>

<?php renderCartCanvas(); ?>
<?php renderFooter(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>

<?php if ($loggedIn && !empty($dbOrders)): ?>
<script>
// Inject DB orders and override the localStorage render
var DB_ORDERS = <?= json_encode(array_map(function($o) {
    return [
        'id'          => $o['order_ref'],
        '_db_id'      => $o['id'],
        'date'        => date('d M Y, H:i', strtotime($o['order_date'])),
        'status'      => $o['status'],
        'subtotal'    => (float)$o['subtotal'],
        'deliveryFee' => (float)$o['delivery_fee'],
        'total'       => (float)$o['total_amount'],
        'items'       => array_map(function($it) {
            return [
                'name'  => $it['product_name'],
                'price' => (float)$it['product_price'],
                'qty'   => (int)$it['quantity'],
                'emoji' => $it['emoji'],
            ];
        }, $o['items']),
        'delivery'    => [
            'name'    => $o['delivery_name']    ?? '',
            'phone'   => $o['delivery_phone']   ?? '',
            'address' => $o['delivery_address'] ?? '',
            'city'    => $o['delivery_city']    ?? '',
            'postal'  => $o['postal_code']      ?? '',
            'type'    => $o['delivery_type']    ?? 'standard',
            'slot'    => $o['delivery_slot']    ?? '',
        ],
        'payment' => [
            'method' => $o['payment_method'] ?? 'cod',
            'label'  => $o['payment_label']  ?? 'Cash on Delivery',
        ],
    ];
}, $dbOrders), JSON_HEX_TAG) ?>;

// Override renderOrders to use DB data when logged in
function renderOrders(filter) {
  var container = document.getElementById('ordersContainer');
  if (!container) return;

  var orders = DB_ORDERS.slice();
  if (filter && filter !== 'all') {
    orders = orders.filter(function(o) {
      return o.status.toLowerCase() === filter.toLowerCase();
    });
  }

  if (orders.length === 0) {
    container.innerHTML = '<div class="orders-empty"><div style="font-size:4rem">📦</div>'
      + '<h5 class="mt-3">No Orders Yet</h5>'
      + '<p class="text-muted">No orders found.</p>'
      + '<a href="products.php" class="btn btn-success rounded-pill px-4 mt-2">Start Shopping</a></div>';
    return;
  }

  var html = '';
  var payLabels = {cod:'Cash on Delivery',card:'Card Payment',bank:'Bank Transfer',
                   koko:'Koko BNPL',frimi:'FriMi Wallet',payhere:'PayHere'};
  var scMap = {Confirmed:'success',Processing:'primary',Delivered:'info',Cancelled:'danger'};

  orders.forEach(function(o) {
    var sc = scMap[o.status] || 'secondary';
    var payLabel = payLabels[o.payment.method] || o.payment.label;
    var canCancel = (o.status === 'Confirmed' || o.status === 'Processing');
    var itemsHtml = '';
    o.items.forEach(function(it) {
      itemsHtml += '<div class="order-item-row"><span>' + it.emoji + ' ' + it.name + '</span>'
                 + '<span>x' + it.qty + '</span>'
                 + '<span>Rs. ' + (it.price * it.qty).toLocaleString() + '</span></div>';
    });

    html += '<div class="order-card">';
    html += '<div class="order-card-head"><div><div class="order-id">' + o.id + '</div>'
          + '<div class="order-date text-muted">' + o.date + '</div></div>'
          + '<span class="badge bg-' + sc + ' rounded-pill">' + o.status + '</span></div>';
    html += '<div class="order-card-body"><div class="order-items-list">' + itemsHtml + '</div>';
    html += '<div class="order-totals">';
    html += '<div class="order-total-row"><span>Subtotal</span><span>Rs. ' + o.subtotal.toLocaleString() + '</span></div>';
    html += '<div class="order-total-row"><span>Delivery</span><span>' + (o.deliveryFee === 0 ? 'FREE' : 'Rs. ' + o.deliveryFee.toLocaleString()) + '</span></div>';
    html += '<div class="order-total-row grand"><span>Total</span><span>Rs. ' + o.total.toLocaleString() + '</span></div></div>';
    html += '<div class="order-meta">';
    if (o.delivery.address) html += '<div><i class="bi bi-geo-alt-fill text-success me-1"></i>' + o.delivery.address + ', ' + o.delivery.city + '</div>';
    if (o.delivery.slot)    html += '<div><i class="bi bi-clock-fill text-success me-1"></i>' + o.delivery.slot + '</div>';
    html += '<div><i class="bi bi-credit-card-fill text-success me-1"></i>' + payLabel + '</div></div></div>';
    html += '<div class="order-card-foot">';
    if (canCancel) {
      html += '<button class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="cancelOrderDB(' + o._db_id + ',this)">'
            + '<i class="bi bi-x-circle me-1"></i>Cancel</button>';
    }
    html += '<button class="btn btn-outline-success btn-sm rounded-pill px-3" onclick="reorderDB(\'' + o.id + '\')">'
          + '<i class="bi bi-arrow-repeat me-1"></i>Reorder</button>';
    html += '</div></div>';
  });

  container.innerHTML = html;
}

function cancelOrderDB(dbId, btn) {
  if (!confirm('Cancel this order?')) return;
  if (btn) { btn.disabled = true; btn.textContent = 'Cancelling...'; }

  fetch('cancel_order.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ orderId: dbId })
  })
  .then(function(r) { return r.json(); })
  .then(function(res) {
    if (res.ok) {
      // Update local DB_ORDERS array
      DB_ORDERS.forEach(function(o) { if (o._db_id === dbId) o.status = 'Cancelled'; });
      var activeTab = document.querySelector('.orders-tab.active');
      renderOrders(activeTab ? activeTab.dataset.filter : 'all');
      showToast('Order cancelled successfully.');
    } else {
      alert(res.error || 'Could not cancel order.');
      if (btn) { btn.disabled = false; btn.innerHTML = '<i class="bi bi-x-circle me-1"></i>Cancel'; }
    }
  })
  .catch(function() {
    alert('Request failed. Please try again.');
    if (btn) { btn.disabled = false; }
  });
}

function reorderDB(orderRef) {
  var order = DB_ORDERS.find(function(o) { return o.id === orderRef; });
  if (!order) return;
  var cart = loadCart();
  order.items.forEach(function(it) {
    var found = false;
    for (var j = 0; j < cart.length; j++) {
      if (cart[j].name === it.name) { cart[j].qty += it.qty; found = true; break; }
    }
    if (!found) cart.push({ name: it.name, price: it.price, qty: it.qty, emoji: it.emoji });
  });
  saveCart(cart);
  updateCartBadge();
  showToast('Items added to cart!');
  setTimeout(function() { window.location.href = 'products.php'; }, 1000);
}

// Initial render
document.addEventListener('DOMContentLoaded', function() { renderOrders('all'); });
</script>
<?php endif; ?>

</body>
</html>

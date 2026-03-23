<?php
// order-success.php – Order confirmed page
require_once __DIR__ . '/includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head><?php renderHead('FreshMart – Order Confirmed!'); ?></head>
<body>

  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Fresh<span>Mart</span></a>
      <div class="ms-auto">
        <a href="orders.php" class="btn-cart-nav"><i class="bi bi-bag-check me-1"></i>My Orders</a>
      </div>
    </div>
  </nav>

  <div class="success-hero" id="successBody">
    <div class="container" style="position:relative;z-index:2">
      <div class="success-check-ring">✅</div>
      <h1>Order Confirmed!</h1>
      <p class="opacity-75 mt-2 mb-0" style="font-size:1.05rem">
        Thank you for shopping with FreshMart! Your fresh items are on their way.
      </p>
      <div class="success-order-chip mt-3" id="successOrderId">Loading...</div>
    </div>
  </div>

  <section class="py-5" style="background:var(--body-bg)">
    <div class="container">
      <div class="row g-4">
        <div class="col-12 col-lg-7">
          <div class="suc-card">
            <div id="successDetail">
              <div class="text-center text-muted py-4">Loading order details...</div>
            </div>
          </div>
          <div class="promo-banner p-4 d-flex flex-column flex-md-row align-items-center
                       justify-content-between gap-3 mt-3">
            <div>
              <h5 class="fw-bold mb-1" style="font-family:'Playfair Display',serif">
                Shop Again and Save!
              </h5>
              <p class="mb-0 opacity-75 small">
                Use <strong>THANKYOU10</strong> for 10% off your next order.
              </p>
            </div>
            <a href="products.php" class="btn-promo flex-shrink-0">Shop Now</a>
          </div>
        </div>
        <div class="col-12 col-lg-5">
          <div class="suc-card mb-3">
            <h6 class="fw-bold mb-3">
              <i class="bi bi-activity text-success me-2"></i>Delivery Timeline
            </h6>
            <div class="del-timeline">
              <div class="del-tl-item">
                <div class="del-tl-dot filled"><i class="bi bi-check-lg"></i></div>
                <div class="del-tl-label">Order Confirmed</div>
                <div class="del-tl-sub">Just now</div>
              </div>
              <div class="del-tl-item">
                <div class="del-tl-dot" style="background:#f9a825;border-color:#f9a825;color:#fff">2</div>
                <div class="del-tl-label">Packing Your Order</div>
                <div class="del-tl-sub">Within 15-20 minutes</div>
              </div>
              <div class="del-tl-item">
                <div class="del-tl-dot pending" style="border-color:#ddd;color:#ccc">3</div>
                <div class="del-tl-label">Out for Delivery</div>
                <div class="del-tl-sub">Your selected slot</div>
              </div>
              <div class="del-tl-item" style="margin-bottom:0">
                <div class="del-tl-dot pending" style="border-color:#ddd;color:#ccc">4</div>
                <div class="del-tl-label">Delivered!</div>
                <div class="del-tl-sub">At your doorstep</div>
              </div>
            </div>
          </div>
          <div class="suc-card">
            <h6 class="fw-bold mb-3">What's next?</h6>
            <div class="d-flex flex-column gap-2">
              <a href="orders.php" class="btn btn-success rounded-pill py-2 fw-semibold">
                <i class="bi bi-bag-check me-2"></i>Track My Order
              </a>
              <a href="products.php" class="btn btn-outline-success rounded-pill py-2 fw-semibold">
                <i class="bi bi-cart-plus me-2"></i>Continue Shopping
              </a>
              <a href="index.php" class="btn btn-outline-secondary rounded-pill py-2 fw-semibold">
                <i class="bi bi-house me-2"></i>Back to Home
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php renderCartCanvas(); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Confetti dots
      var hero = document.getElementById('successBody');
      if (hero) {
        var colors = ['#4caf50','#f9a825','#ffffff','#a5d6a7'];
        for (var i = 0; i < 20; i++) {
          var dot = document.createElement('div');
          dot.className = 'confetti-dot';
          dot.style.cssText = 'width:'+(5+Math.random()*12)+'px;height:'+(5+Math.random()*12)+'px;'
            + 'background:'+colors[Math.floor(Math.random()*colors.length)]+';'
            + 'left:'+(Math.random()*100)+'%;bottom:'+(Math.random()*30)+'px;'
            + 'animation-delay:'+(Math.random()*2)+'s;animation-duration:'+(2.5+Math.random()*2)+'s;';
          hero.appendChild(dot);
        }
      }
    });
  </script>
</body>
</html>

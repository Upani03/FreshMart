<?php
// checkout.php – Checkout page with PHP session awareness
require_once __DIR__ . '/includes/functions.php';
$loggedIn = isLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head><?php renderHead('FreshMart – Checkout'); ?></head>
<body>

  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Fresh<span>Mart</span></a>
      <div class="ms-auto d-flex gap-2 align-items-center">
        <?php if ($loggedIn): ?>
          <span class="text-muted" style="font-size:.85rem"><i class="bi bi-person-check-fill text-success me-1"></i><?= sanitize(currentUsername()) ?></span>
        <?php else: ?>
          <a href="auth/login.php" class="btn btn-sm btn-outline-success rounded-pill">
            <i class="bi bi-person me-1"></i>Login to save order
          </a>
        <?php endif; ?>
        <a href="products.php" class="btn btn-outline-secondary btn-sm rounded-pill">
          <i class="bi bi-arrow-left me-1"></i>Continue Shopping
        </a>
      </div>
    </div>
  </nav>

  <div class="bg-white border-bottom">
    <div class="container">
      <div class="checkout-steps">
        <div class="step-item done"><div class="step-circle"><i class="bi bi-check-lg"></i></div><span>Cart</span></div>
        <div class="step-connector done"></div>
        <div class="step-item active"><div class="step-circle">2</div><span>Checkout</span></div>
        <div class="step-connector"></div>
        <div class="step-item"><div class="step-circle">3</div><span>Confirmed</span></div>
      </div>
    </div>
  </div>

  <section class="py-4" style="background:var(--body-bg)">
    <div class="container">
      <?php if (!$loggedIn): ?>
      <div class="alert alert-info rounded-3 mb-3" style="font-size:.88rem">
        <i class="bi bi-info-circle-fill me-2"></i>
        <strong>Guest checkout:</strong> Your order will be saved locally.
        <a href="auth/login.php" class="alert-link">Login</a> to save it to your account.
      </div>
      <?php endif; ?>

      <form id="checkoutForm" novalidate>
        <div class="row g-4">

          <div class="col-12 col-lg-7">
            <!-- DELIVERY METHOD -->
            <div class="co-card">
              <div class="co-section-title"><i class="bi bi-truck"></i> Delivery Method</div>
              <div class="deliv-type-group">
                <label class="deliv-type-card selected" id="lbl-standard">
                  <input type="radio" name="delivType" value="standard" checked onchange="selectDelivType(this)"/>
                  <span style="font-size:1.4rem">🚚</span>
                  <div><div style="font-size:.9rem;font-weight:700">Standard Delivery</div><div style="font-size:.75rem;color:#888">2-4 hours - Rs. 350</div></div>
                </label>
                <label class="deliv-type-card" id="lbl-express">
                  <input type="radio" name="delivType" value="express" onchange="selectDelivType(this)"/>
                  <span style="font-size:1.4rem">⚡</span>
                  <div><div style="font-size:.9rem;font-weight:700">Express Delivery</div><div style="font-size:.75rem;color:#888">Under 90 min - Rs. 650</div></div>
                </label>
                <label class="deliv-type-card" id="lbl-pickup">
                  <input type="radio" name="delivType" value="pickup" onchange="selectDelivType(this)"/>
                  <span style="font-size:1.4rem">🏪</span>
                  <div><div style="font-size:.9rem;font-weight:700">Self Pickup</div><div style="font-size:.75rem;color:#888">Ready in 30 min - FREE</div></div>
                </label>
              </div>

              <div id="slotsSection">
                <div class="co-section-title mt-3" style="font-size:1rem"><i class="bi bi-calendar-event"></i> Choose Delivery Slot</div>
                <div id="deliverySlots"></div>
                <div id="slotError" style="color:#dc3545;font-size:.82rem;display:none"><i class="bi bi-exclamation-circle me-1"></i>Please select a delivery slot.</div>
              </div>

              <div id="pickupNotice" style="display:none" class="alert alert-success rounded-3 mt-3">
                <i class="bi bi-shop me-2"></i><strong>Pickup Location:</strong> 123 Market Street, Colombo 07<br/>
                <small>Your order will be ready within 30 minutes after confirmation.</small>
              </div>
            </div>

            <!-- DELIVERY ADDRESS -->
            <div class="co-card" id="addressSection">
              <div class="co-section-title"><i class="bi bi-geo-alt-fill"></i> Delivery Address</div>
              <div class="row g-3">
                <div class="col-12 col-sm-6">
                  <label class="form-label">Full Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="delivName" placeholder="John Silva" required/>
                  <div class="invalid-feedback">Please enter your name.</div>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                  <input type="tel" class="form-control" id="delivPhone" placeholder="+94 77 123 4567" required/>
                  <div class="invalid-feedback">Please enter your phone.</div>
                </div>
                <div class="col-12">
                  <label class="form-label">Delivery Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="delivAddress" placeholder="No. 45, Main Street" required/>
                  <div class="invalid-feedback">Please enter your address.</div>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label">City <span class="text-danger">*</span></label>
                  <select class="form-control form-select" id="delivCity" required>
                    <option value="">Select city...</option>
                    <option>Colombo</option><option>Gampaha</option><option>Negombo</option>
                  </select>
                  <div class="invalid-feedback">Please select your city.</div>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label">Postal Code <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="delivPostal" placeholder="00300" required/>
                  <div class="invalid-feedback">Enter a valid postal code.</div>
                </div>
                <div class="col-12">
                  <label class="form-label">Delivery Note <span class="text-muted fw-normal">(optional)</span></label>
                  <textarea class="form-control" id="delivNote" rows="2" placeholder="e.g. Leave at door, ring the bell..."></textarea>
                </div>
              </div>
            </div>

            <!-- PAYMENT -->
            <div class="co-card">
              <div class="co-section-title"><i class="bi bi-shield-lock-fill"></i> Payment Method</div>
              <label class="pay-card selected" id="pay-cod" onclick="selectPay('cod',this)">
                <input type="radio" name="payMethod" value="cod" data-label="Cash on Delivery" checked/>
                <div class="pay-logo">💵</div>
                <div class="flex-grow-1"><div class="pay-info-name">Cash on Delivery</div><div class="pay-info-desc">Pay when your order arrives</div></div>
                <span class="pay-badge bg-success text-white">Popular</span>
              </label>
              <label class="pay-card" id="pay-card" onclick="selectPay('card',this)">
                <input type="radio" name="payMethod" value="card" data-label="Credit / Debit Card"/>
                <div class="pay-logo">💳</div>
                <div class="flex-grow-1"><div class="pay-info-name">Credit / Debit Card</div><div class="pay-info-desc">Visa, Mastercard, Amex - secured by SSL</div></div>
              </label>
              <div id="cardFields">
                <div class="row g-3">
                  <div class="col-12"><label class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19"/></div>
                  <div class="col-12"><label class="form-label">Cardholder Name</label>
                    <input type="text" class="form-control" id="cardName" placeholder="JOHN SILVA"/></div>
                  <div class="col-6"><label class="form-label">Expiry (MM/YY)</label>
                    <input type="text" class="form-control" id="cardExpiry" placeholder="08/27" maxlength="5"/></div>
                  <div class="col-6"><label class="form-label">CVV</label>
                    <input type="password" class="form-control" id="cardCVV" placeholder="..." maxlength="4"/></div>
                </div>
              </div>
              <label class="pay-card" id="pay-payhere" onclick="selectPay('payhere',this)">
                <input type="radio" name="payMethod" value="payhere" data-label="PayHere Online Payment"/>
                <div class="pay-logo">🌐</div>
                <div class="flex-grow-1"><div class="pay-info-name">PayHere</div><div class="pay-info-desc">Sri Lanka's No.1 payment gateway</div></div>
                <span class="pay-badge" style="background:#ff6900;color:#fff">Local</span>
              </label>
              <label class="pay-card" id="pay-frimi" onclick="selectPay('frimi',this)">
                <input type="radio" name="payMethod" value="frimi" data-label="FriMi Digital Wallet"/>
                <div class="pay-logo">📱</div>
                <div class="flex-grow-1"><div class="pay-info-name">FriMi Digital Wallet</div><div class="pay-info-desc">Pay instantly using your FriMi balance</div></div>
                <span class="pay-badge" style="background:#0066cc;color:#fff">Wallet</span>
              </label>
              <label class="pay-card" id="pay-koko" onclick="selectPay('koko',this)">
                <input type="radio" name="payMethod" value="koko" data-label="Koko Buy Now Pay Later"/>
                <div class="pay-logo">🛒</div>
                <div class="flex-grow-1"><div class="pay-info-name">Koko - Buy Now, Pay Later</div><div class="pay-info-desc">Split into 3 easy instalments - 0% interest</div></div>
                <span class="pay-badge" style="background:#f5c000;color:#000">BNPL</span>
              </label>
              <label class="pay-card" id="pay-bank" onclick="selectPay('bank',this)">
                <input type="radio" name="payMethod" value="bank" data-label="Bank Transfer"/>
                <div class="pay-logo">🏦</div>
                <div class="flex-grow-1"><div class="pay-info-name">Bank Transfer</div><div class="pay-info-desc">Direct transfer - confirmation within 2 hrs</div></div>
              </label>
              <div id="bankFields">
                <div style="font-size:.85rem;line-height:2.2">
                  <div><strong>Bank:</strong> Commercial Bank of Ceylon</div>
                  <div><strong>Account Name:</strong> FreshMart (Pvt) Ltd</div>
                  <div><strong>Account No:</strong> 1234 5678 9012</div>
                  <div><strong>Branch:</strong> Colombo 07</div>
                </div>
                <div class="alert alert-warning rounded-3 mt-2 py-2" style="font-size:.82rem">
                  <i class="bi bi-info-circle-fill me-1"></i>Please transfer the exact amount and send your receipt.
                </div>
              </div>
            </div>
          </div>

          <!-- ORDER SUMMARY -->
          <div class="col-12 col-lg-5">
            <div class="co-summary-box">
              <div class="co-summary-title"><i class="bi bi-bag-check-fill text-success me-2"></i>Order Summary</div>
              <div id="coItems" style="max-height:240px;overflow-y:auto"></div>
              <hr class="co-divider"/>
              <div class="co-total-row"><span>Subtotal</span><span id="coSubtotal">Rs. 0</span></div>
              <div class="co-total-row"><span>Delivery Fee</span><span id="coDelivery">Rs. 350</span></div>
              <div class="co-total-row grand"><span>Total</span><span id="coTotal">Rs. 0</span></div>
              <button type="submit" id="placeOrderBtn"><i class="bi bi-lock-fill me-2"></i>Place Order Securely</button>
              <p class="secure-note"><i class="bi bi-shield-check-fill text-success me-1"></i>256-bit SSL encrypted - Your data is safe</p>
            </div>
          </div>

        </div>
      </form>
    </div>
  </section>

  <div class="toast-container position-fixed bottom-0 start-50 translate-middle-x mb-3" style="z-index:9999">
    <div id="addToast" class="toast align-items-center text-bg-dark border-0 rounded-pill px-2" role="alert">
      <div class="d-flex">
        <div class="toast-body" id="toastMsg"></div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
  <script>
  // Extend placeOrder to also POST to process_order.php when logged in
  var IS_LOGGED_IN = <?= $loggedIn ? 'true' : 'false' ?>;

  var _originalPlaceOrder = placeOrder;
  placeOrder = function() {
    // Run all original validation first (it writes to localStorage too)
    _originalPlaceOrder();

    // After a slight delay (original sets a 1400ms spinner), intercept and also POST to server
    if (!IS_LOGGED_IN) return; // guest: localStorage only

    // We need to re-read form values to build the payload
    var cart     = loadCart();
    var method   = document.querySelector('input[name="payMethod"]:checked');
    var slot     = document.querySelector('input[name="delivSlot"]:checked');
    var delivType= document.querySelector('input[name="delivType"]:checked');

    // Guard: only proceed if the form passed validation (cart not empty etc.)
    if (!cart.length) return;

    var nameEl  = document.getElementById('delivName');
    var phoneEl = document.getElementById('delivPhone');
    var addrEl  = document.getElementById('delivAddress');
    var cityEl  = document.getElementById('delivCity');
    var postEl  = document.getElementById('delivPostal');
    var noteEl  = document.getElementById('delivNote');

    if (delivType && delivType.value !== 'pickup') {
      if (!nameEl||!nameEl.value.trim()) return;
    }

    var sub = getSubtotal();
    var fee = getDeliveryFee();
    var orderRef = 'FM-' + Date.now().toString(36).toUpperCase();

    var payload = {
      items:        cart,
      subtotal:     sub,
      deliveryFee:  fee,
      total:        sub + fee,
      orderRef:     orderRef,
      delivName:    nameEl  ? nameEl.value.trim()  : '',
      delivPhone:   phoneEl ? phoneEl.value.trim() : '',
      delivAddress: addrEl  ? addrEl.value.trim()  : '',
      delivCity:    cityEl  ? cityEl.value         : '',
      delivPostal:  postEl  ? postEl.value.trim()  : '',
      delivNote:    noteEl  ? noteEl.value.trim()  : '',
      delivType:    delivType ? delivType.value     : 'standard',
      delivSlot:    slot    ? slot.value            : '',
      payMethod:    method  ? method.value          : 'cod',
      payLabel:     method  ? method.dataset.label  : 'Cash on Delivery',
    };

    fetch('process_order.php', {
      method:  'POST',
      headers: { 'Content-Type': 'application/json' },
      body:    JSON.stringify(payload)
    })
    .then(function(r) { return r.json(); })
    .then(function(res) {
      if (!res.ok) console.warn('DB save failed:', res.error);
      // Redirect is handled by the original placeOrder's setTimeout
    })
    .catch(function(err) { console.warn('Order DB save error:', err); });
  };
  </script>
</body>
</html>

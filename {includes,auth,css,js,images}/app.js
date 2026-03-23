/* FreshMart - app.js */
var CART_KEY = 'fm_cart';
var DELIVERY_FEE = 350;
var FREE_DELIVERY_MIN = 3000;
var cart = [];

function loadCart() {
  try { return JSON.parse(localStorage.getItem(CART_KEY)) || []; } catch(e) { return []; }
}
function saveCart(c) { localStorage.setItem(CART_KEY, JSON.stringify(c)); }
function loadOrders() { try { return JSON.parse(localStorage.getItem('fm_orders')) || []; } catch(e) { return []; } }
function saveOrders(o) { localStorage.setItem('fm_orders', JSON.stringify(o)); }
function getSubtotal() { var s=0; for(var i=0;i<cart.length;i++) s+=cart[i].price*cart[i].qty; return s; }
function getTotalQty() { var q=0; for(var i=0;i<cart.length;i++) q+=cart[i].qty; return q; }
function getDeliveryFee() { var s=getSubtotal(); return s===0?0:(s>=FREE_DELIVERY_MIN?0:DELIVERY_FEE); }

function updateCartBadge() {
  var q = getTotalQty();
  var badges = document.querySelectorAll('.cart-pill');
  for(var i=0;i<badges.length;i++) badges[i].textContent = q;
}

function addToCart(btn, name, price, emoji) {
  cart = loadCart();
  var found = false;
  for(var i=0;i<cart.length;i++) {
    if(cart[i].name === name) { cart[i].qty++; found=true; break; }
  }
  if(!found) cart.push({name:name, price:price, qty:1, emoji:emoji});
  saveCart(cart);
  updateCartBadge();
  renderCart();
  if(btn) {
    var orig = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-check-lg me-1"></i>Added!';
    btn.classList.add('added');
    setTimeout(function(){ btn.innerHTML=orig; btn.classList.remove('added'); }, 1200);
  }
  showToast(emoji + ' ' + name + ' added to cart!');
}

function changeQty(index, delta) {
  cart = loadCart();
  if(!cart[index]) return;
  cart[index].qty += delta;
  if(cart[index].qty <= 0) cart.splice(index,1);
  saveCart(cart);
  updateCartBadge();
  renderCart();
}

function removeFromCart(index) {
  cart = loadCart();
  cart.splice(index,1);
  saveCart(cart);
  updateCartBadge();
  renderCart();
}

function renderCart() {
  cart = loadCart();
  var el = document.getElementById('cartItems');
  if(!el) return;
  if(cart.length === 0) {
    el.innerHTML = '<div class="cart-empty-msg"><div class="cart-empty-icon">&#128722;</div>Your cart is empty.<br><small>Add some fresh items!</small></div>';
    renderCartSummary(0,0);
    return;
  }
  var html = '';
  for(var i=0;i<cart.length;i++) {
    var it = cart[i];
    html += '<div class="cart-item-row">';
    html += '<div class="ci-icon">' + it.emoji + '</div>';
    html += '<div style="flex:1">';
    html += '<div class="ci-name">' + it.name + '</div>';
    html += '<div class="ci-unit-price">Rs. ' + it.price.toLocaleString() + ' each</div>';
    html += '<div class="qty-controls">';
    html += '<button class="qty-btn" onclick="changeQty(' + i + ',-1)">&#8722;</button>';
    html += '<span class="qty-num">' + it.qty + '</span>';
    html += '<button class="qty-btn" onclick="changeQty(' + i + ',1)">&#43;</button>';
    html += '</div></div>';
    html += '<div style="display:flex;flex-direction:column;align-items:flex-end;gap:.3rem">';
    html += '<span class="ci-subtotal">Rs. ' + (it.price*it.qty).toLocaleString() + '</span>';
    html += '<button class="ci-remove" onclick="removeFromCart(' + i + ')">&#128465;</button>';
    html += '</div></div>';
  }
  el.innerHTML = html;
  renderCartSummary(getSubtotal(), getTotalQty());
}

function renderCartSummary(subtotal, totalQty) {
  var el = document.getElementById('cartSummary');
  if(!el) return;
  var fee = subtotal===0 ? 0 : (subtotal>=FREE_DELIVERY_MIN ? 0 : DELIVERY_FEE);
  var total = subtotal + fee;
  var rem = FREE_DELIVERY_MIN - subtotal;
  var pct = Math.min(100, Math.round((subtotal/FREE_DELIVERY_MIN)*100));
  var delivMsg = '';
  if(subtotal>0 && subtotal<FREE_DELIVERY_MIN) {
    delivMsg = '<div class="delivery-note">Add Rs. ' + rem.toLocaleString() + ' more for FREE delivery!' +
      '<div style="height:4px;background:#eee;border-radius:4px;margin-top:4px">' +
      '<div style="height:100%;width:' + pct + '%;background:var(--green);border-radius:4px;transition:width .4s"></div></div></div>';
  } else if(subtotal>=FREE_DELIVERY_MIN && subtotal>0) {
    delivMsg = '<div class="free-delivery">&#127881; You\'ve unlocked FREE delivery!</div>';
  }
  var feeLabel = (fee===0 && subtotal>0) ? '<span style="color:var(--green);font-weight:700">FREE</span>' : (subtotal===0 ? '&mdash;' : 'Rs. '+DELIVERY_FEE.toLocaleString());
  el.innerHTML =
    '<div class="cart-summary-row"><span>Subtotal ('+totalQty+' item'+(totalQty!==1?'s':'')+')</span><span>Rs. '+subtotal.toLocaleString()+'</span></div>' +
    '<div class="cart-summary-row"><span>Delivery Fee</span><span>'+feeLabel+'</span></div>' +
    delivMsg +
    '<div class="cart-summary-row total"><span>Total</span><span>Rs. '+total.toLocaleString()+'</span></div>' +
    '<button class="btn-checkout mt-3" onclick="goCheckout()">Checkout <i class="bi bi-arrow-right ms-1"></i></button>';
}

function showToast(msg) {
  var toastEl = document.getElementById('addToast');
  var msgEl = document.getElementById('toastMsg');
  if(!toastEl||!msgEl) return;
  msgEl.textContent = msg;
  var t = new bootstrap.Toast(toastEl, {delay:2000});
  t.show();
}

function setActiveNavLink() {
  var page = window.location.pathname.split('/').pop().replace('.html','') || 'index';
  var links = document.querySelectorAll('.nav-link[data-page]');
  for(var i=0;i<links.length;i++) {
    links[i].classList.remove('active-link');
    if(links[i].dataset.page === page) links[i].classList.add('active-link');
  }
}

function filterProducts(cat, btn) {
  var cards = document.querySelectorAll('.product-card-wrap');
  for(var i=0;i<cards.length;i++) {
    var c = cards[i];
    c.style.display = (cat==='all' || c.dataset.cat===cat) ? '' : 'none';
  }
  var btns = document.querySelectorAll('.btn-filter');
  for(var i=0;i<btns.length;i++) btns[i].classList.remove('active');
  if(btn) btn.classList.add('active');
}

function navigateTo(page) { window.location.href = page + '.html'; }

function navigateToProducts(cat) {
  localStorage.setItem('fm_filter_cat', cat);
  window.location.href = 'products.html';
}

function goCheckout() {
  cart = loadCart();
  if(cart.length===0) { showToast('Your cart is empty!'); return; }
  window.location.href = 'checkout.html';
}

/* Contact form */
function initContactForm() {
  var form = document.getElementById('contactForm');
  if(!form) return;
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    if(!form.checkValidity()) { form.classList.add('was-validated'); return; }
    var alertEl = document.getElementById('successAlert');
    var submitBtn = form.querySelector('button[type="submit"]');
    if(submitBtn) { submitBtn.innerHTML='<span class="spinner-border spinner-border-sm me-2"></span>Sending...'; submitBtn.disabled=true; }
    setTimeout(function() {
      if(alertEl) alertEl.classList.remove('d-none');
      if(submitBtn) { submitBtn.innerHTML='Send Message <i class="bi bi-send-fill ms-2"></i>'; submitBtn.disabled=false; }
      form.reset(); form.classList.remove('was-validated');
      setTimeout(function(){ if(alertEl) alertEl.classList.add('d-none'); },4000);
    },1200);
  });
}

/* Checkout page */
function initCheckoutPage() {
  if(!document.getElementById('checkoutForm')) return;
  renderCheckoutSummary();
  generateDeliverySlots();
  var radios = document.querySelectorAll('input[name="payMethod"]');
  for(var i=0;i<radios.length;i++) radios[i].addEventListener('change', togglePayFields);
  togglePayFields();
  var cardNum = document.getElementById('cardNumber');
  if(cardNum) cardNum.addEventListener('input', function() {
    var v=this.value.replace(/\D/g,'').substring(0,16);
    this.value=v.replace(/(.{4})/g,'$1 ').trim();
  });
  var expiry = document.getElementById('cardExpiry');
  if(expiry) expiry.addEventListener('input', function() {
    var v=this.value.replace(/\D/g,'').substring(0,4);
    if(v.length>=3) v=v.substring(0,2)+'/'+v.substring(2);
    this.value=v;
  });
  var form = document.getElementById('checkoutForm');
  if(form) form.addEventListener('submit', function(e) { e.preventDefault(); placeOrder(); });
}

function generateDeliverySlots() {
  var container = document.getElementById('deliverySlots');
  if(!container) return;
  var times = ['9:00 AM - 12:00 PM','12:00 PM - 3:00 PM','3:00 PM - 6:00 PM','6:00 PM - 9:00 PM'];
  var now = new Date();
  var html = '';
  for(var d=0;d<3;d++) {
    var date = new Date(now); date.setDate(now.getDate()+d);
    var label = d===0?'Today':d===1?'Tomorrow':date.toLocaleDateString('en-GB',{weekday:'short',day:'numeric',month:'short'});
    html += '<div class="delivery-day-group"><div class="delivery-day-label">'+label;
    if(d===0) html+=' <span class="slot-badge">Today</span>';
    html += '</div>';
    for(var t=0;t<times.length;t++) {
      if(d===0&&t<1) continue;
      var slotId='slot_'+d+'_'+t;
      var checked=(d===0&&t===1)||( d===1&&t===0&&false)?'checked':'';
      if(d===0&&t===1) checked='checked';
      html += '<label class="delivery-slot-card" id="lbl_'+slotId+'">';
      html += '<input type="radio" name="delivSlot" value="'+label+' '+times[t]+'" id="'+slotId+'" '+checked+' onchange="markSlot(this)"/>';
      html += '<i class="bi bi-clock me-1"></i><span class="slot-time">'+times[t]+'</span>';
      html += '<span class="slot-fee">'+(d===0?'Express':'Std')+'</span></label>';
    }
    html += '</div>';
  }
  container.innerHTML = html;
  /* mark first checked */
  var first = document.querySelector('input[name="delivSlot"]:checked');
  if(first) { var lbl=first.parentElement; if(lbl) lbl.classList.add('slot-selected'); }
}

function markSlot(radio) {
  var all = document.querySelectorAll('.delivery-slot-card');
  for(var i=0;i<all.length;i++) all[i].classList.remove('slot-selected');
  if(radio&&radio.parentElement) radio.parentElement.classList.add('slot-selected');
}

function togglePayFields() {
  var method = document.querySelector('input[name="payMethod"]:checked');
  var cardSection = document.getElementById('cardFields');
  var bankSection = document.getElementById('bankFields');
  if(cardSection) cardSection.style.display=(method&&method.value==='card')?'block':'none';
  if(bankSection) bankSection.style.display=(method&&method.value==='bank')?'block':'none';
}

function renderCheckoutSummary() {
  cart = loadCart();
  var el = document.getElementById('coItems');
  if(!el) return;
  if(cart.length===0) { el.innerHTML='<p class="text-muted text-center py-3">Cart empty. <a href="products.html">Shop now</a></p>'; return; }
  var html='';
  for(var i=0;i<cart.length;i++) {
    var it=cart[i];
    html+='<div class="co-item"><span class="co-item-emoji">'+it.emoji+'</span>';
    html+='<div class="co-item-info"><div class="co-item-name">'+it.name+'</div>';
    html+='<div class="co-item-qty">Qty '+it.qty+' x Rs. '+it.price.toLocaleString()+'</div></div>';
    html+='<div class="co-item-total">Rs. '+(it.price*it.qty).toLocaleString()+'</div></div>';
  }
  el.innerHTML=html;
  var sub=getSubtotal(); var fee=getDeliveryFee();
  var e2=document.getElementById('coSubtotal'); if(e2) e2.textContent='Rs. '+sub.toLocaleString();
  var e3=document.getElementById('coDelivery'); if(e3) e3.textContent=fee===0?'FREE':'Rs. '+fee.toLocaleString();
  var e4=document.getElementById('coTotal');    if(e4) e4.textContent='Rs. '+(sub+fee).toLocaleString();
}

function selectDelivType(radio) {
  var labels=document.querySelectorAll('.deliv-type-card');
  for(var i=0;i<labels.length;i++) labels[i].classList.remove('selected');
  if(radio&&radio.parentElement) radio.parentElement.classList.add('selected');
  var slots=document.getElementById('slotsSection');
  var addr=document.getElementById('addressSection');
  var pickup=document.getElementById('pickupNotice');
  if(radio&&radio.value==='pickup') {
    if(slots) slots.style.display='none';
    if(addr) addr.style.display='none';
    if(pickup) pickup.style.display='block';
  } else {
    if(slots) slots.style.display='block';
    if(addr) addr.style.display='block';
    if(pickup) pickup.style.display='none';
  }
}

function selectPay(method, clickedLabel) {
  var allCards=document.querySelectorAll('.pay-card');
  for(var i=0;i<allCards.length;i++) allCards[i].classList.remove('selected');
  if(clickedLabel) clickedLabel.classList.add('selected');
  var radio=clickedLabel?clickedLabel.querySelector('input[type="radio"]'):null;
  if(radio) { radio.checked=true; togglePayFields(); }
}

function placeOrder() {
  cart = loadCart();
  var method = document.querySelector('input[name="payMethod"]:checked');
  var slot   = document.querySelector('input[name="delivSlot"]:checked');
  var delivType = document.querySelector('input[name="delivType"]:checked');
  var nameEl = document.getElementById('delivName');
  var phoneEl= document.getElementById('delivPhone');
  var addrEl = document.getElementById('delivAddress');
  var cityEl = document.getElementById('delivCity');
  var postEl = document.getElementById('delivPostal');
  if(nameEl&&!nameEl.value.trim()){nameEl.classList.add('is-invalid');nameEl.focus();return;}
  if(phoneEl&&!phoneEl.value.trim()){phoneEl.classList.add('is-invalid');phoneEl.focus();return;}
  if(addrEl&&!addrEl.value.trim()){addrEl.classList.add('is-invalid');addrEl.focus();return;}
  if(cityEl&&!cityEl.value){cityEl.classList.add('is-invalid');cityEl.focus();return;}
  if(postEl&&!postEl.value.trim()){postEl.classList.add('is-invalid');postEl.focus();return;}
  var order = {
    id: 'FM-'+Date.now().toString(36).toUpperCase(),
    date: new Date().toLocaleString('en-GB',{dateStyle:'medium',timeStyle:'short'}),
    items: JSON.parse(JSON.stringify(cart)),
    subtotal: getSubtotal(), deliveryFee: getDeliveryFee(),
    total: getSubtotal()+getDeliveryFee(), status:'Confirmed',
    delivery: {
      name: nameEl?nameEl.value.trim():'', phone: phoneEl?phoneEl.value.trim():'',
      address: addrEl?addrEl.value.trim():'', city: cityEl?cityEl.value:'',
      postal: postEl?postEl.value.trim():'', type: delivType?delivType.value:'standard',
      slot: slot?slot.value:'Scheduled'
    },
    payment: { method: method?method.value:'cod', label: method?method.dataset.label:'Cash on Delivery' }
  };
  var orders=loadOrders(); orders.unshift(order); saveOrders(orders);
  localStorage.setItem('fm_last_order', order.id);
  cart=[]; saveCart(cart);
  var btn=document.getElementById('placeOrderBtn');
  if(btn){btn.innerHTML='<span class="spinner-border spinner-border-sm me-2"></span>Processing...';btn.disabled=true;}
  setTimeout(function(){ window.location.href='order-success.html'; },1400);
}

function initOrdersPage() {
  if(!document.getElementById('ordersContainer')) return;
  renderOrders('all');
}

function renderOrders(filter) {
  var container=document.getElementById('ordersContainer');
  if(!container) return;
  var orders=loadOrders();
  if(filter&&filter!=='all') orders=orders.filter(function(o){return o.status.toLowerCase()===filter.toLowerCase();});
  if(orders.length===0) {
    container.innerHTML='<div class="orders-empty"><div style="font-size:4rem">&#128230;</div><h5 class="mt-3">No Orders Yet</h5><p class="text-muted">You have not placed any orders yet.</p><a href="products.html" class="btn btn-success rounded-pill px-4 mt-2">Start Shopping</a></div>';
    return;
  }
  var html='';
  for(var i=0;i<orders.length;i++) {
    var o=orders[i];
    var sc={Confirmed:'success',Processing:'primary',Delivered:'info',Cancelled:'danger'}[o.status]||'secondary';
    var payLabel={cod:'Cash on Delivery',card:'Card Payment',bank:'Bank Transfer',koko:'Koko BNPL',frimi:'FriMi Wallet',payhere:'PayHere'}[o.payment.method]||o.payment.label;
    var canCancel=(o.status==='Confirmed'||o.status==='Processing');
    var itemsHtml='';
    for(var j=0;j<o.items.length;j++){var it=o.items[j];itemsHtml+='<div class="order-item-row"><span>'+it.emoji+' '+it.name+'</span><span>x'+it.qty+'</span><span>Rs. '+(it.price*it.qty).toLocaleString()+'</span></div>';}
    html+='<div class="order-card">';
    html+='<div class="order-card-head"><div><div class="order-id">'+o.id+'</div><div class="order-date text-muted">'+o.date+'</div></div><span class="badge bg-'+sc+' rounded-pill">'+o.status+'</span></div>';
    html+='<div class="order-card-body"><div class="order-items-list">'+itemsHtml+'</div>';
    html+='<div class="order-totals"><div class="order-total-row"><span>Subtotal</span><span>Rs. '+o.subtotal.toLocaleString()+'</span></div>';
    html+='<div class="order-total-row"><span>Delivery</span><span>'+(o.deliveryFee===0?'FREE':'Rs. '+o.deliveryFee.toLocaleString())+'</span></div>';
    html+='<div class="order-total-row grand"><span>Total</span><span>Rs. '+o.total.toLocaleString()+'</span></div></div>';
    html+='<div class="order-meta"><div><i class="bi bi-geo-alt-fill text-success me-1"></i>'+o.delivery.address+', '+o.delivery.city+'</div>';
    html+='<div><i class="bi bi-clock-fill text-success me-1"></i>'+o.delivery.slot+'</div>';
    html+='<div><i class="bi bi-credit-card-fill text-success me-1"></i>'+payLabel+'</div></div></div>';
    html+='<div class="order-card-foot">'+(canCancel?'<button class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="cancelOrder(\''+o.id+'\')"><i class="bi bi-x-circle me-1"></i>Cancel</button>':'');
    html+='<button class="btn btn-outline-success btn-sm rounded-pill px-3" onclick="reorder(\''+o.id+'\')"><i class="bi bi-arrow-repeat me-1"></i>Reorder</button></div></div>';
  }
  container.innerHTML=html;
}

function filterOrdersTab(status, btn) {
  var tabs=document.querySelectorAll('.orders-tab');
  for(var i=0;i<tabs.length;i++) tabs[i].classList.remove('active');
  if(btn) btn.classList.add('active');
  renderOrders(status);
}

function cancelOrder(orderId) {
  if(!confirm('Cancel this order?')) return;
  var orders=loadOrders();
  for(var i=0;i<orders.length;i++){if(orders[i].id===orderId){orders[i].status='Cancelled';break;}}
  saveOrders(orders);
  var activeTab=document.querySelector('.orders-tab.active');
  renderOrders(activeTab?activeTab.dataset.filter:'all');
  showToast('Order '+orderId+' cancelled.');
}

function reorder(orderId) {
  var orders=loadOrders(); var order=null;
  for(var i=0;i<orders.length;i++){if(orders[i].id===orderId){order=orders[i];break;}}
  if(!order) return;
  cart=loadCart();
  for(var i=0;i<order.items.length;i++){
    var it=order.items[i]; var found=false;
    for(var j=0;j<cart.length;j++){if(cart[j].name===it.name){cart[j].qty+=it.qty;found=true;break;}}
    if(!found) cart.push({name:it.name,price:it.price,qty:it.qty,emoji:it.emoji});
  }
  saveCart(cart); updateCartBadge(); showToast('Items added to cart!');
  setTimeout(function(){window.location.href='products.html';},1000);
}

function initSuccessPage() {
  if(!document.getElementById('successBody')) return;
  var orderId=localStorage.getItem('fm_last_order');
  if(!orderId) return;
  var orders=loadOrders(); var order=null;
  for(var i=0;i<orders.length;i++){if(orders[i].id===orderId){order=orders[i];break;}}
  if(!order) return;
  var idEl=document.getElementById('successOrderId');
  if(idEl) idEl.textContent=order.id;
  var payLabel={cod:'Cash on Delivery',card:'Card Payment',bank:'Bank Transfer',koko:'Koko BNPL',frimi:'FriMi Wallet',payhere:'PayHere'}[order.payment.method]||order.payment.label;
  var itemsHtml='';
  for(var i=0;i<order.items.length;i++){var it=order.items[i];itemsHtml+='<div class="suc-item"><span>'+it.emoji+' '+it.name+'</span><span>x'+it.qty+'</span><span>Rs. '+(it.price*it.qty).toLocaleString()+'</span></div>';}
  var detailEl=document.getElementById('successDetail');
  if(detailEl) detailEl.innerHTML='<div><h6><i class="bi bi-bag-check-fill text-success me-2"></i>Order Items</h6>'+itemsHtml+'<div class="suc-total"><span>Total Paid</span><strong>Rs. '+order.total.toLocaleString()+'</strong></div></div><hr/><div><h6><i class="bi bi-truck text-success me-2"></i>Delivery Details</h6><p><strong>'+order.delivery.name+'</strong><br/>'+order.delivery.address+', '+order.delivery.city+' '+order.delivery.postal+'<br/><i class="bi bi-telephone-fill text-muted me-1"></i>'+order.delivery.phone+'</p><p><i class="bi bi-clock-fill text-muted me-1"></i><strong>Slot:</strong> '+order.delivery.slot+'</p><p><i class="bi bi-credit-card-fill text-muted me-1"></i><strong>Payment:</strong> '+payLabel+'</p></div>';
}

/* Back button fix */
window.addEventListener('pageshow', function(e) {
  if(e.persisted) { cart=loadCart(); updateCartBadge(); renderCart(); }
});

/* INIT */
document.addEventListener('DOMContentLoaded', function() {
  cart = loadCart();
  updateCartBadge();
  renderCart();
  setActiveNavLink();
  initContactForm();
  initCheckoutPage();
  initOrdersPage();
  initSuccessPage();
  /* restore filter on products page */
  var savedCat = localStorage.getItem('fm_filter_cat');
  if(savedCat && document.getElementById('productsGrid')) {
    var btn = document.querySelector('.btn-filter[data-cat="'+savedCat+'"]');
    filterProducts(savedCat, btn);
    localStorage.removeItem('fm_filter_cat');
  }
  /* init first pay card selected */
  var firstPay=document.querySelector('.pay-card');
  if(firstPay) firstPay.classList.add('selected');
});

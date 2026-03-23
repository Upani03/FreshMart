<?php
// index.php – FreshMart home page
require_once __DIR__ . '/includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head><?php renderHead('FreshMart – Online Supermarket'); ?></head>
<body>

<?php renderNav('index'); ?>

  <!-- CAROUSEL -->
  <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="slide-inner slide-1">
          <div>
            <div class="badge-tag">Fresh Daily Arrivals</div>
            <h1>Fresh Fruits &amp;<br/>Vegetables</h1>
            <p>Farm-fresh produce delivered to your doorstep every day.</p>
            <a href="products.php" class="btn-slide">Shop Now &rarr;</a>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="slide-inner slide-2">
          <div>
            <div class="badge-tag">Weekend Special</div>
            <h1>Dairy &amp; Bakery<br/>Deals</h1>
            <p>Up to 30% off on selected dairy and bakery items this weekend.</p>
            <a href="products.php" class="btn-slide">View Deals &rarr;</a>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="slide-inner slide-3">
          <div>
            <div class="badge-tag">Free Delivery</div>
            <h1>Free Delivery<br/>Over Rs. 3000</h1>
            <p>Order above Rs. 3,000 and get FREE delivery anywhere in Colombo.</p>
            <a href="products.php" class="btn-slide">Start Shopping &rarr;</a>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <!-- FEATURED PRODUCTS -->
  <section class="py-5" style="background:var(--body-bg)">
    <div class="container">
      <div class="text-center mb-4">
        <h2 class="section-title">Featured Products</h2>
        <div class="title-line mx-auto"></div>
        <p class="text-muted mt-2">Handpicked fresh items just for you</p>
      </div>
      <?= renderFlash() ?>
      <div class="row g-3">

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1553279768-865429fa0078?w=400&q=80" alt="Alphonso Mangoes" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Alphonso Mangoes</div>
              <span class="price">Rs. 450</span><span class="old-price">Rs. 550</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Alphonso Mangoes',450,'&#129389;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1584270354949-c26b0d5b4a0c?w=400&q=80" alt="Organic Broccoli" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Organic Broccoli</div>
              <span class="price">Rs. 280</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Organic Broccoli',280,'&#129382;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=400&q=80" alt="Apple Juice" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">Apple Juice 1L</div>
              <span class="price">Rs. 390</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Apple Juice 1L',390,'&#129381;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="dairy">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1618164435735-413d3b066c9a?w=400&q=80" alt="Cheddar Cheese" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Dairy</div>
              <div class="card-title-text">Cheddar Cheese 200g</div>
              <span class="price">Rs. 720</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Cheddar Cheese 200g',720,'&#129472;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1537640538966-79f369143f8f?w=400&q=80" alt="Red Grapes" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Red Grapes 500g</div>
              <span class="price">Rs. 380</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Red Grapes 500g',380,'&#127815;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="snacks">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1734039036981-d53a216945d2?w=400&q=80" alt="Butter Popcorn" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Snacks</div>
              <div class="card-title-text">Butter Popcorn 150g</div>
              <span class="price">Rs. 175</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Butter Popcorn 150g',175,'&#127871;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400&q=80" alt="Organic Mixed Greens" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Organic Mixed Greens</div>
              <span class="price">Rs. 320</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Organic Mixed Greens',320,'&#127807;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="bakery">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=400&q=80" alt="Whole Wheat Loaf" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Bakery</div>
              <div class="card-title-text">Whole Wheat Loaf</div>
              <span class="price">Rs. 195</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Whole Wheat Loaf',195,'&#127838;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

      </div>
      <div class="text-center mt-4">
        <a href="products.php" class="btn btn-outline-success rounded-pill px-4 fw-semibold">View All Products &rarr;</a>
      </div>
    </div>
  </section>

  <!-- CATEGORIES -->
  <section class="py-5 bg-white">
    <div class="container">
      <div class="text-center mb-4">
        <h2 class="section-title">Shop by Category</h2>
        <div class="title-line mx-auto"></div>
      </div>
      <div class="row g-3">
        <div class="col-6 col-md-4 col-lg-2">
          <a class="cat-card c1" onclick="navigateToProducts('fruits')">
            <div class="cat-icon">&#127820;</div><div class="cat-name">Fruits</div><div class="cat-count">42 items</div>
          </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <a class="cat-card c2" onclick="navigateToProducts('vegetables')">
            <div class="cat-icon">&#129382;</div><div class="cat-name">Vegetables</div><div class="cat-count">58 items</div>
          </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <a class="cat-card c3" onclick="navigateToProducts('beverages')">
            <div class="cat-icon">&#127863;</div><div class="cat-name">Beverages</div><div class="cat-count">31 items</div>
          </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <a class="cat-card c4" onclick="navigateToProducts('dairy')">
            <div class="cat-icon">&#129371;</div><div class="cat-name">Dairy</div><div class="cat-count">24 items</div>
          </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <a class="cat-card c5" onclick="navigateToProducts('bakery')">
            <div class="cat-icon">&#127838;</div><div class="cat-name">Bakery</div><div class="cat-count">19 items</div>
          </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <a class="cat-card c6" onclick="navigateToProducts('snacks')">
            <div class="cat-icon">&#127871;</div><div class="cat-name">Snacks</div><div class="cat-count">47 items</div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- PROMO BANNER -->
  <section class="py-5" style="background:var(--body-bg)">
    <div class="container">
      <div class="promo-banner p-5 d-flex flex-column flex-md-row align-items-center justify-content-between gap-4">
        <div>
          <h3 style="font-family:'Playfair Display',serif;font-size:1.9rem">Get 20% Off Your First Order!</h3>
          <p class="opacity-75 mb-0">Use code <strong>FRESH20</strong> at checkout. Valid for new customers only.</p>
        </div>
        <a href="products.php" class="btn-promo flex-shrink-0">Shop Now</a>
      </div>
    </div>
  </section>

<?php renderCartCanvas(); ?>

  <footer class="pt-5 pb-3">
    <div class="container">
      <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
          <div class="footer-logo mb-2">Fresh<span>Mart</span></div>
          <p style="font-size:.87rem;line-height:1.65">Your trusted online supermarket delivering fresh produce right to your door.</p>
          <div class="d-flex gap-2 mt-3">
            <a class="social-btn" href="#"><i class="bi bi-facebook"></i></a>
            <a class="social-btn" href="#"><i class="bi bi-instagram"></i></a>
            <a class="social-btn" href="#"><i class="bi bi-twitter-x"></i></a>
            <a class="social-btn" href="#"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>
        <div class="col-6 col-md-2"><h5>Quick Links</h5><ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="categories.php">Categories</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="orders.php">My Orders</a></li>
        </ul></div>
        <div class="col-6 col-md-2"><h5>Categories</h5><ul>
          <li><a onclick="navigateToProducts('fruits')">Fruits</a></li>
          <li><a onclick="navigateToProducts('vegetables')">Vegetables</a></li>
          <li><a onclick="navigateToProducts('dairy')">Dairy</a></li>
          <li><a onclick="navigateToProducts('bakery')">Bakery</a></li>
          <li><a onclick="navigateToProducts('snacks')">Snacks</a></li>
        </ul></div>
        <div class="col-12 col-md-4"><h5>Contact Us</h5><ul>
          <li><i class="bi bi-geo-alt-fill text-success me-2"></i>123 Market St, Colombo 07</li>
          <li class="mt-2"><i class="bi bi-telephone-fill text-success me-2"></i>+94 11 234 5678</li>
          <li class="mt-2"><i class="bi bi-clock-fill text-success me-2"></i>Mon to Fri: 8am to 9pm</li>
        </ul></div>
      </div>
      <hr class="footer-divider"/>
      <p class="footer-bottom text-center mb-0">&copy; 2025 FreshMart. All rights reserved. Built with Bootstrap 5.</p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
  <script>
  // Patch navigation to use .php URLs
  function navigateToProducts(cat) {
    localStorage.setItem('fm_filter_cat', cat);
    window.location.href = 'products.php';
  }
  </script>
</body>
</html>

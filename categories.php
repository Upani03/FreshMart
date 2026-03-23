<?php
require_once __DIR__ . '/includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head><?php renderHead('FreshMart – Categories'); ?></head>
<body>

  <?php renderNav('categories'); ?>

  <div class="page-hero">
    <div class="container">
      <h1><i class="bi bi-grid me-3"></i>All Categories</h1>
      <p class="opacity-75 mb-0">Browse our wide selection of fresh products</p>
    </div>
  </div>

  <section class="py-5" style="background:var(--body-bg)">
    <div class="container">
      <div class="row g-4">

        <!-- SIDEBAR -->
        <div class="col-12 col-lg-3">
          <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <h6 class="fw-bold mb-3"><i class="bi bi-funnel-fill text-success me-2"></i>Categories</h6>
            <div class="list-group list-group-flush" id="catSidebar">
              <a class="list-group-item list-group-item-action active d-flex justify-content-between align-items-center" onclick="filterCatPage('all',this)">
                All Categories <span class="badge rounded-pill bg-white text-success">73</span>
              </a>
              <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="filterCatPage('fruits',this)">
                &#127820; Fruits <span class="badge rounded-pill bg-success">21</span>
              </a>
              <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="filterCatPage('vegetables',this)">
                &#129382; Vegetables <span class="badge rounded-pill bg-success">15</span>
              </a>
              <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="filterCatPage('beverages',this)">
                &#127863; Beverages <span class="badge rounded-pill bg-success">12</span>
              </a>
              <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="filterCatPage('dairy',this)">
                &#129371; Dairy <span class="badge rounded-pill bg-success">6</span>
              </a>
              <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="filterCatPage('bakery',this)">
                &#127838; Bakery <span class="badge rounded-pill bg-success">10</span>
              </a>
              <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="filterCatPage('snacks',this)">
                &#127871; Snacks <span class="badge rounded-pill bg-success">9</span>
              </a>
            </div>
          </div>

          <!-- Stats card -->
          <div class="stat-card p-4">
            <h6 class="fw-bold text-white mb-3"><i class="bi bi-bar-chart-fill me-2"></i>Store Stats</h6>
            <div class="d-flex justify-content-between mb-2" style="font-size:.88rem;color:rgba(255,255,255,.85)">
              <span>Total Products</span><strong class="text-white">73</strong>
            </div>
            <div class="d-flex justify-content-between mb-2" style="font-size:.88rem;color:rgba(255,255,255,.85)">
              <span>Categories</span><strong class="text-white">6</strong>
            </div>
            <div class="d-flex justify-content-between" style="font-size:.88rem;color:rgba(255,255,255,.85)">
              <span>Daily Deliveries</span><strong class="text-white">100+</strong>
            </div>
          </div>
        </div>

        <!-- CATEGORIES GRID -->
        <div class="col-12 col-lg-9">
          <div class="row g-3" id="categoriesGrid">

            <div class="col-6 col-md-4 cat-card-wrap" data-cat="fruits">
              <a class="big-cat-card" onclick="navigateToProducts('fruits')">
                <div class="big-cat-banner bg-fruits"><img src="https://images.unsplash.com/photo-1610832958506-aa56368176cf?w=600&q=80" alt="Fruits" loading="lazy"/></div>
                <div class="big-cat-body">
                  <div class="big-cat-name">Fruits</div>
                  <div class="big-cat-desc">Fresh seasonal and tropical fruits</div>
                  <div class="big-cat-meta"><span class="big-cat-badge">21 items</span><i class="bi bi-arrow-right text-success"></i></div>
                </div>
              </a>
            </div>

            <div class="col-6 col-md-4 cat-card-wrap" data-cat="vegetables">
              <a class="big-cat-card" onclick="navigateToProducts('vegetables')">
                <div class="big-cat-banner bg-vegetables"><img src="https://images.unsplash.com/photo-1557844352-761f2565b576?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHZlZ2V0YWJsZXN8ZW58MHx8MHx8fDA%3D" alt="Vegetables" loading="lazy"/></div>
                <div class="big-cat-body">
                  <div class="big-cat-name">Vegetables</div>
                  <div class="big-cat-desc">Farm-fresh organic vegetables</div>
                  <div class="big-cat-meta"><span class="big-cat-badge">15 items</span><i class="bi bi-arrow-right text-success"></i></div>
                </div>
              </a>
            </div>

            <div class="col-6 col-md-4 cat-card-wrap" data-cat="beverages">
              <a class="big-cat-card" onclick="navigateToProducts('beverages')">
                <div class="big-cat-banner bg-beverages"><img src="https://images.unsplash.com/photo-1551024709-8f23befc6f87?q=80&w=1257&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Beverages" loading="lazy"/></div>
                <div class="big-cat-body">
                  <div class="big-cat-name">Beverages</div>
                  <div class="big-cat-desc">Juices, water, and soft drinks</div>
                  <div class="big-cat-meta"><span class="big-cat-badge">12 items</span><i class="bi bi-arrow-right text-success"></i></div>
                </div>
              </a>
            </div>

            <div class="col-6 col-md-4 cat-card-wrap" data-cat="dairy">
              <a class="big-cat-card" onclick="navigateToProducts('dairy')">
                <div class="big-cat-banner bg-dairy"><img src="https://images.unsplash.com/photo-1628088062854-d1870b4553da?w=600&q=80" alt="Dairy" loading="lazy"/></div>
                <div class="big-cat-body">
                  <div class="big-cat-name">Dairy</div>
                  <div class="big-cat-desc">Milk, cheese, yogurt and more</div>
                  <div class="big-cat-meta"><span class="big-cat-badge">6 items</span><i class="bi bi-arrow-right text-success"></i></div>
                </div>
              </a>
            </div>

            <div class="col-6 col-md-4 cat-card-wrap" data-cat="bakery">
              <a class="big-cat-card" onclick="navigateToProducts('bakery')">
                <div class="big-cat-banner bg-bakery"><img src="https://images.unsplash.com/photo-1534432182912-63863115e106?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGJha2VyeXxlbnwwfHwwfHx8MA%3D%3D" alt="Bakery" loading="lazy"/></div>
                <div class="big-cat-body">
                  <div class="big-cat-name">Bakery</div>
                  <div class="big-cat-desc">Freshly baked breads and pastries</div>
                  <div class="big-cat-meta"><span class="big-cat-badge">10 items</span><i class="bi bi-arrow-right text-success"></i></div>
                </div>
              </a>
            </div>

            <div class="col-6 col-md-4 cat-card-wrap" data-cat="snacks">
              <a class="big-cat-card" onclick="navigateToProducts('snacks')">
                <div class="big-cat-banner bg-snacks"><img src="https://images.unsplash.com/photo-1621939514649-280e2ee25f60?w=600&q=80" alt="Snacks" loading="lazy"/></div>
                <div class="big-cat-body">
                  <div class="big-cat-name">Snacks</div>
                  <div class="big-cat-desc">Chips, nuts, and bite-sized treats</div>
                  <div class="big-cat-meta"><span class="big-cat-badge">9 items</span><i class="bi bi-arrow-right text-success"></i></div>
                </div>
              </a>
            </div>

          </div>

          <!-- Popular Products Strip -->
          <div class="mt-5">
            <h5 class="fw-bold mb-3"><i class="bi bi-fire text-danger me-2"></i>Popular Right Now</h5>
            <div class="popular-scroll">
              <div class="pop-card">
                <div class="pop-img"><img src="https://images.unsplash.com/photo-1553279768-865429fa0078?w=400&q=80" alt="Mangoes" loading="lazy"/></div>
                <div class="pop-body">
                  <div class="pop-name">Alphonso Mangoes</div>
                  <div class="pop-price">Rs. 450</div>
                  <button class="btn-pop" onclick="addToCart(this,'Alphonso Mangoes',450,'&#129389;')">+ Add</button>
                </div>
              </div>
              <div class="pop-card">
                <div class="pop-img"><img src="https://images.unsplash.com/photo-1584270354949-c26b0d5b4a0c?w=400&q=80" alt="Broccoli" loading="lazy"/></div>
                <div class="pop-body">
                  <div class="pop-name">Organic Broccoli</div>
                  <div class="pop-price">Rs. 280</div>
                  <button class="btn-pop" onclick="addToCart(this,'Organic Broccoli',280,'&#129382;')">+ Add</button>
                </div>
              </div>
              <div class="pop-card">
                <div class="pop-img"><img src="https://images.unsplash.com/photo-1618164435735-413d3b066c9a?w=400&q=80" alt="Cheese" loading="lazy"/></div>
                <div class="pop-body">
                  <div class="pop-name">Cheddar Cheese</div>
                  <div class="pop-price">Rs. 720</div>
                  <button class="btn-pop" onclick="addToCart(this,'Cheddar Cheese 200g',720,'&#129472;')">+ Add</button>
                </div>
              </div>
              <div class="pop-card">
                <div class="pop-img"><img src="https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=400&q=80" alt="Juice" loading="lazy"/></div>
                <div class="pop-body">
                  <div class="pop-name">Apple Juice 1L</div>
                  <div class="pop-price">Rs. 390</div>
                  <button class="btn-pop" onclick="addToCart(this,'Apple Juice 1L',390,'&#129381;')">+ Add</button>
                </div>
              </div>
              <div class="pop-card">
                <div class="pop-img"><img src="https://images.unsplash.com/photo-1585681614547-a9c87fcf6a30?w=400&q=80" alt="Popcorn" loading="lazy"/></div>
                <div class="pop-body">
                  <div class="pop-name">Butter Popcorn</div>
                  <div class="pop-price">Rs. 175</div>
                  <button class="btn-pop" onclick="addToCart(this,'Butter Popcorn 150g',175,'&#127871;')">+ Add</button>
                </div>
              </div>
              <div class="pop-card">
                <div class="pop-img"><img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=400&q=80" alt="Bread" loading="lazy"/></div>
                <div class="pop-body">
                  <div class="pop-name">Wheat Loaf</div>
                  <div class="pop-price">Rs. 195</div>
                  <button class="btn-pop" onclick="addToCart(this,'Whole Wheat Loaf',195,'&#127838;')">+ Add</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php renderCartCanvas(); ?>
  </div>

  <?php renderFooter(); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
  <script>
    function filterCatPage(cat, btn) {
      var items = document.querySelectorAll('.cat-card-wrap');
      for(var i=0;i<items.length;i++) items[i].style.display=(cat==='all'||items[i].dataset.cat===cat)?'':'none';
      var links = document.querySelectorAll('#catSidebar a');
      for(var i=0;i<links.length;i++) links[i].classList.remove('active');
      if(btn) btn.classList.add('active');
    }
  </script>
</body>
</html>

<?php
require_once __DIR__ . '/includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head><?php renderHead('FreshMart – Products'); ?></head>
<body>

  <?php renderNav('products'); ?>

  <div class="page-hero">
    <div class="container">
      <h1><i class="bi bi-grid-3x3-gap me-3"></i>All Products</h1>
      <p class="opacity-75 mb-0">Fresh, quality products delivered to your door</p>
    </div>
  </div>

  <!-- FILTER BAR -->
  <div class="filter-bar py-3 sticky-top" style="top:68px;z-index:100">
    <div class="container">
      <div class="d-flex gap-2 flex-wrap">
        <button class="btn btn-sm btn-filter active" data-cat="all"        onclick="filterProducts('all',this)">All</button>
        <button class="btn btn-sm btn-filter" data-cat="fruits"       onclick="filterProducts('fruits',this)">&#127820; Fruits</button>
        <button class="btn btn-sm btn-filter" data-cat="vegetables"   onclick="filterProducts('vegetables',this)">&#129382; Vegetables</button>
        <button class="btn btn-sm btn-filter" data-cat="beverages"    onclick="filterProducts('beverages',this)">&#127863; Beverages</button>
        <button class="btn btn-sm btn-filter" data-cat="dairy"        onclick="filterProducts('dairy',this)">&#129371; Dairy</button>
        <button class="btn btn-sm btn-filter" data-cat="bakery"       onclick="filterProducts('bakery',this)">&#127838; Bakery</button>
        <button class="btn btn-sm btn-filter" data-cat="snacks"       onclick="filterProducts('snacks',this)">&#127871; Snacks</button>
      </div>
    </div>
  </div>

  <!-- PRODUCTS GRID -->
  <section class="py-5" style="background:var(--body-bg)">
    <div class="container">
      <div class="row g-3" id="productsGrid">

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

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1537640538966-79f369143f8f?w=400&q=80" alt="Red Grapes" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text"> Grapes 500g</div>
              <span class="price">Rs. 380</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Red Grapes 500g',380,'&#127815;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
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

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=400&q=80" alt="Baby Carrots" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Baby Carrots 250g</div>
              <span class="price">Rs. 150</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Baby Carrots 250g',150,'&#129367;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=400&q=80" alt="Orange Juice" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">Orange Juice 1L</div>
              <span class="price">Rs. 390</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Apple Juice 1L',390,'&#129381;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1553530666-ba11a7da3888?w=400&q=80" alt="Strawberry Smoothie" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">Strawberry Smoothie</div>
              <span class="price">Rs. 320</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberry Smoothie',320,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
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

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="dairy">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1550583724-b2692b85b150?w=400&q=80" alt="Full Cream Milk" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Dairy</div>
              <div class="card-title-text">Full Cream Milk 1L</div>
              <span class="price">Rs. 230</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Full Cream Milk 1L',230,'&#127853;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
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

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="bakery">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400&q=80" alt="Butter Croissant" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Bakery</div>
              <div class="card-title-text">Butter Croissant</div>
              <span class="price">Rs. 120</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Butter Croissant',120,'&#129360;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="snacks">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://plus.unsplash.com/premium_photo-1676049461933-28e3e6ee359c?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8cG9wY29ybnxlbnwwfHwwfHx8MA%3D%3D" alt="Butter Popcorn" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Snacks</div>
              <div class="card-title-text">Butter Popcorn 150g</div>
              <span class="price">Rs. 175</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Butter Popcorn 150g',175,'&#127871;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="snacks">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1508061253366-f7da158b6d46?w=400&q=80" alt="Almonds" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Snacks</div>
              <div class="card-title-text">Almonds 200g</div>
              <span class="price">Rs. 560</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Almonds',560,'&#129372;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <!-- NEW FRUITS -->
        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://plus.unsplash.com/premium_photo-1663855531381-f9c100b3c48f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fHdhdGVybWVsb258ZW58MHx8MHx8fDA%3D" alt="Watermelon" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Watermelon (Whole)</div>
              <span class="price">Rs. 350</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Watermelon',350,'&#127817;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?q=80&w=1160&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Bananas" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Bananas 1kg</div>
              <span class="price">Rs. 180</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Bananas 1kg',180,'&#127820;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1512578659172-63a4634c05ec?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGdyZWVuJTIwYXBwbGV8ZW58MHx8MHx8fDA%3D" alt="Green Apples" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Green Apples 500g</div>
              <span class="price">Rs. 420</span><span class="old-price">Rs. 500</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Green Apples 500g',420,'&#127822;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://plus.unsplash.com/premium_photo-1672176148719-46fe21a12683?q=80&w=992&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Strawberries" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Strawberries 250g</div>
              <span class="price">Rs. 590</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=400&q=80" alt="Pineapple" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Pineapple 1kg</div>
              <span class="price">Rs. 590</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1595515018409-49ec62f435a1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fGJsdWUlMjBiZXJyeXxlbnwwfHwwfHx8MA%3D%3D" alt="blueBeery" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Blue Berry</div>
              <span class="price">Rs. 990</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

         <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://plus.unsplash.com/premium_photo-1724256067514-8ed44a51c318?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cmFzc2JlcnJ5fGVufDB8fDB8fHww" alt="blueBeery" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Rassberry</div>
              <span class="price">Rs. 990</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1639588473831-dd9d014646ae?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cGVhY2h8ZW58MHx8MHx8fDA%3D" alt="Peaches" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Peach</div>
              <span class="price">Rs. 90</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1695028102094-9b1396f17304?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHJlZCUyMGFwcGxlfGVufDB8fDB8fHww" alt="Red Apple" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Red Apple </div>
              <span class="price">Rs. 490</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1588444872849-1c9a5ade50ff?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fG9yYW5nZXN8ZW58MHx8MHx8fDA%3D" alt="Oranges" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Oranges 1kg</div>
              <span class="price">Rs. 490</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

         <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://media.istockphoto.com/id/186858235/photo/kiwifruit.jpg?s=612x612&w=is&k=20&c=PRr6XzqBBtQbZXmii-GYpFOgp5ttJnIfBI1lXfCl1Y4=" alt="Kivi" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Kivi</div>
              <span class="price">Rs. 990</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1571347586843-69826a524206?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8UG9tZWdyYW5hdGV8ZW58MHx8MHx8fDA%3D" alt="Pineapple" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Pomegranate 1kg</div>
              <span class="price">Rs. 990</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1696426506268-00a41b06b956?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cGVhcnxlbnwwfHwwfHx8MA%3D%3D" alt="Pear" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Pear 1kg</div>
              <span class="price">Rs. 990</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://media.istockphoto.com/id/182400599/photo/blackberry.jpg?s=612x612&w=is&k=20&c=JaUzpAfW4AtZ5dRtHJmbWv8C0nIw5uE2cqTRTZbGlxM=" alt="Blackberry" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">BlackBerry 250g</div>
              <span class="price">Rs. 590</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://media.istockphoto.com/id/519050468/photo/close-up-of-fresh-cherry.jpg?s=612x612&w=is&k=20&c=7eUxSV6zT2N_gbzFzWNK8Bc60hyfet-1-KJAlvw02V4=" alt="Cherry" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Cherry 250g</div>
              <span class="price">Rs. 790</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1635843110565-cb35d1c03d86?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8ZHJhZ29uJTIwZnJ1aXR8ZW58MHx8MHx8fDA%3D" alt="Dragon Fruit" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Dragon Fruit 1kg</div>
              <span class="price">Rs. 990</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://plus.unsplash.com/premium_photo-1723294490531-adb186f8e319?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGFzc2lvbiUyMGZydWl0fGVufDB8fDB8fHww" alt="passion Fruit" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Passion Fuit 1kg</div>
              <span class="price">Rs. 590</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://plus.unsplash.com/premium_photo-1722961405964-ec2ab6e7ecb8?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8THljaGVlfGVufDB8fDB8fHww" alt="Lychee" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Lychee 1kg</div>
              <span class="price">Rs. 990</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="fruits">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1627998393358-06afa811bf77?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8TWFuZ29zdGVlbnxlbnwwfHwwfHx8MA%3D%3D" alt="Mangosteen" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Fruits</div>
              <div class="card-title-text">Mangosteen 1kg</div>
              <span class="price">Rs. 890</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Strawberries 250g',490,'&#127827;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>




        <!-- NEW VEGETABLES -->
        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1518977676601-b53f82aba655?w=400&q=80" alt="Potatoes" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Potatoes 1kg</div>
              <span class="price">Rs. 130</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Potatoes 1kg',130,'&#129364;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1561136594-7f68413baa99?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fHRvbWF0b3xlbnwwfHwwfHx8MA%3D%3D" alt="Tomatoes" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Tomatoes 500g</div>
              <span class="price">Rs. 160</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Tomatoes 500g',160,'&#127813;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1587411768638-ec71f8e33b78?w=400&q=80" alt="Cucumber" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Cucumber 2 pcs</div>
              <span class="price">Rs. 110</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Cucumber 2 pcs',110,'&#129362;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1666213871235-422c5f80ceba?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fHJlZCUyMGNhcHNpY3VtfGVufDB8fDB8fHww" alt="Red Capsicum" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Red Capsicum 3 pcs</div>
              <span class="price">Rs. 220</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Red Capsicum 3 pcs',220,'&#127798;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1620574387735-3624d75b2dbc?q=80&w=1160&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Onion" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Onion 1kg</div>
              <span class="price">Rs. 230</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Potatoes 1kg',130,'&#129364;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1591586007768-40725cc562a1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8Q2FiYmFnZXxlbnwwfHwwfHx8MA%3D%3D" alt="Cabbage" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Cabbage 1kg</div>
              <span class="price">Rs. 430</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Potatoes 1kg',130,'&#129364;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1590944392009-4ef14b5704c8?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fENhdWxpZmxvd2VyfGVufDB8fDB8fHww" alt="Cauliflower" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Cauliflower 1kg</div>
              <span class="price">Rs. 450</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Potatoes 1kg',130,'&#129364;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://plus.unsplash.com/premium_photo-1703260007808-bdc648fd29b7?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fFNwaW5hY2h8ZW58MHx8MHx8fDA%3D" alt="Spinach" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Spinach 500g</div>
              <span class="price">Rs. 250</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Potatoes 1kg',130,'&#129364;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1591193144634-a2bf060fdb36?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8bGV0dHVjZXxlbnwwfHwwfHx8MA%3D%3D" alt="Potatoes" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Lettuce 500g</div>
              <span class="price">Rs. 330</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Potatoes 1kg',130,'&#129364;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://media.istockphoto.com/id/2224726425/photo/image-of-fresh-purple-aubergines-displayed-at-fruit-veg-market-organic-produce-at-supermarket.jpg?s=612x612&w=is&k=20&c=q4MX-hl0XHqMebZ1i_K4G840w9lZCetCZ9VK4NHLQ4s=" alt="Brinjal" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Brinjal 1kg</div>
              <span class="price">Rs. 330</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Potatoes 1kg',130,'&#129364;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1551754655-cd27e38d2076?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNvcm58ZW58MHx8MHx8fDA%3D" alt="corn" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Corn 1kg</div>
              <span class="price">Rs. 530</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Corn 1kg',530,'&#129364;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1663262432134-93bb1e7a60ed?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8WnVjY2hpbml8ZW58MHx8MHx8fDA%3D" alt="Zucchini" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Zucchini 1kg</div>
              <span class="price">Rs. 550</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Zucchini 1kg',550,'&#129364;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="vegetables">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1737507844233-9bad00475be8?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8bGVla3xlbnwwfHwwfHx8MA%3D%3D" alt="Leek" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Vegetables</div>
              <div class="card-title-text">Leek 1kg</div>
              <span class="price">Rs. 380</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Leek 1kg',380,'&#129364;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>


        <!-- NEW BAKERY -->
        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="bakery">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1611614010348-7df489604fe3?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2hvY29sYXRlJTIwbXVmZmlufGVufDB8fDB8fHww" alt="Chocolate Muffin" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Bakery</div>
              <div class="card-title-text">Chocolate Muffin</div>
              <span class="price">Rs. 145</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Chocolate Muffin',145,'&#129369;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="bakery">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1568471173242-461f0a730452?w=400&q=80" alt="Sourdough Bread" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Bakery</div>
              <div class="card-title-text">Sourdough Bread</div>
              <span class="price">Rs. 165</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Sourdough Bread',165,'&#129360;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="bakery">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1509365465985-25d11c17e812?w=400&q=80" alt="Cinnamon Roll" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Bakery</div>
              <div class="card-title-text">Cinnamon Roll</div>
              <span class="price">Rs. 280</span><span class="old-price">Rs. 320</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Cinnamon Roll',280,'&#127838;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <!-- NEW BEVERAGES -->
        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1595981267035-7b04ca84a82d?w=400&q=80" alt="Orange Mojito" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">Orange Mojito </div>
              <span class="price">Rs. 360</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Orange Mojito',360,'&#129381;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400&q=80" alt="Ice Tea" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">Ice Tea</div>
              <span class="price">Rs. 290</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Ice Tea ',290,'&#127861;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1622483767028-3f66f32aef97?w=400&q=80" alt="Cocacola" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">Cocacola 500ml</div>
              <span class="price">Rs. 210</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Cocacola 500ml',210,'&#127944;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://plus.unsplash.com/premium_photo-1663853293357-41695a0713a0?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGJldmVyYWdlc3xlbnwwfHwwfHx8MA%3D%3D" alt="Ice Matcha" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">Ice Matcha </div>
              <span class="price">Rs. 580</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Ice Matcha',580,'&#127944;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1599536837271-f3e08bd0fac5?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fGJ1YmJsZSUyMHRlYXxlbnwwfHwwfHx8MA%3D%3D" alt="Bubble Tea" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">Bubble Tea</div>
              <span class="price">Rs. 800</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Bubble Tea',800,'&#127944;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1621263764928-df1444c5e859?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8bGltZSUyMGp1aWNlfGVufDB8fDB8fHww" alt="Lime" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">Lime Juice</div>
              <span class="price">Rs. 210</span>
              <button class="btn-cart-card" onclick="addToCart(this,'lime juice',210,'&#127944;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1696487774083-44992ca48eb4?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZmFsdWRhfGVufDB8fDB8fHww" alt="Faluda" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">Faluda</div>
              <span class="price">Rs. 250</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Faluda',250,'&#127944;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://plus.unsplash.com/premium_photo-1726804881341-bfc9554ad94f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8aWNlJTIwY29mZWV8ZW58MHx8MHx8fDA%3D" alt="Ice Coffee" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">Ice Coffee</div>
              <span class="price">Rs. 350</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Ice Coffee',250,'&#127944;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1616118132534-381148898bb4?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8d2F0ZXIlMjBib3R0bGV8ZW58MHx8MHx8fDA%3D" alt="water" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">water 1l</div>
              <span class="price">Rs. 100</span>
              <button class="btn-cart-card" onclick="addToCart(this,'water 1l',210,'&#127944;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="beverages">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1582785513054-8d1bf9d69c1a?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8bWF0Y2hhJTIwbGF0dGV8ZW58MHx8MHx8fDA%3D" alt="Matcha Latte" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Beverages</div>
              <div class="card-title-text">Matcha latte</div>
              <span class="price">Rs. 800</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Matcha Latte',8000,'&#127944;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <!-- NEW SNACKS -->
        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="snacks">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1566478989037-eec170784d0b?w=400&q=80" alt="Potato Chips" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Snacks</div>
              <div class="card-title-text">Potato Chips 100g</div>
              <span class="price">Rs. 135</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Potato Chips 100g',135,'&#127839;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="snacks">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=400&q=80" alt="Chocolate Cookies" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Snacks</div>
              <div class="card-title-text">Choco Cookies 200g</div>
              <span class="price">Rs. 240</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Choco Cookies 200g',240,'&#127850;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="snacks">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1629214831802-bb2a07f9517e?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8Z3Jhbm9sYSUyMGJhcnxlbnwwfHwwfHx8MA%3D%3D" alt="Granola Bar" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Snacks</div>
              <div class="card-title-text">Granola Bar 6 pack</div>
              <span class="price">Rs. 310</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Granola Bar 6 pack',310,'&#127859;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="snacks">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1698158225819-2430cd5bfab5?q=80&w=686&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Crackers" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Snacks</div>
              <div class="card-title-text">Crackers</div>
              <span class="price">Rs. 250</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Crackers',250,'&#127859;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="snacks">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1610450949065-1f2841536c88?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2hvY29sYXRlfGVufDB8fDB8fHww" alt="Chocalate" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Snacks</div>
              <div class="card-title-text">Chocolate</div>
              <span class="price">Rs. 500</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Chocolate',500,'&#127859;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="snacks">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1700339062616-11c7fc9a673d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cHJpbmdsZXN8ZW58MHx8MHx8fDA%3D" alt="Pringles" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Snacks</div>
              <div class="card-title-text">Pringles</div>
              <span class="price">Rs. 800</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Prigles',800,'&#127859;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="snacks">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://plus.unsplash.com/premium_photo-1694708455263-e58c7aacbb19?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cmFtZW58ZW58MHx8MHx8fDA%3D" alt="Ramen" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Snacks</div>
              <div class="card-title-text">Ramen</div>
              <span class="price">Rs. 500</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Ramen',500,'&#127859;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="bakery">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1551106652-a5bcf4b29ab6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGRvbnV0c3xlbnwwfHwwfHx8MA%3D%3D" alt="Donuts" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Bakery</div>
              <div class="card-title-text">Donuts</div>
              <span class="price">Rs. 120</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Donuts',120,'&#129360;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="bakery">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://plus.unsplash.com/premium_photo-1681506525264-f3d415752701?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fGNha2VzJTIwZmxhdm9yJTIwYm94fGVufDB8fDB8fHww" alt="Cake Flavor Box" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Bakery</div>
              <div class="card-title-text">Cake Flavor Box</div>
              <span class="price">Rs. 600</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Cake Flavor Box',120,'&#129360;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="bakery">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1623246123320-0d6636755796?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fGN1cGNha2V8ZW58MHx8MHx8fDA%3D" alt="Cupcake" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Bakery</div>
              <div class="card-title-text"> Cupcake</div>
              <span class="price">Rs. 120</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Cupcakes',120,'&#129360;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="bakery">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400&q=80" alt="Buns" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Bakery</div>
              <div class="card-title-text">Buns</div>
              <span class="price">Rs. 100</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Buns',100,'&#129360;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="bakery">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://media.istockphoto.com/id/2184085032/photo/lemon-macarons.jpg?s=612x612&w=is&k=20&c=_BijDS5HrA9T0GDWKIQ3Uf8A44h1s5wT-h53HHCJtDw=" alt="Macarons" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Bakery</div>
              <div class="card-title-text">Macarons</div>
              <span class="price">Rs. 200</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Macarons',220,'&#129360;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

         <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="dairy">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1604095853918-1a1823a63dd5?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8Z3JlZWslMjBZb2d1cnR8ZW58MHx8MHx8fDA%3D" alt="greek Yogurt" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Dairy</div>
              <div class="card-title-text">greek Yogurt</div>
              <span class="price">Rs. 500</span>
              <button class="btn-cart-card" onclick="addToCart(this,'greek Yogurt',500,'&#127853;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

         <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="dairy">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1627308595228-9d0497edbe74?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGZydWl0JTIwWW9ndXJ0fGVufDB8fDB8fHww" alt="yogurt with fruits" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Dairy</div>
              <div class="card-title-text">yogurt with fruits</div>
              <span class="price">Rs. 600</span>
              <button class="btn-cart-card" onclick="addToCart(this,'yogurt with fruits',600,'&#127853;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

         <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="dairy">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1567206563064-6f60f40a2b57?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8aWNlJTIwY3JlYW18ZW58MHx8MHx8fDA%3D" alt="ice Cream " loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Dairy</div>
              <div class="card-title-text">Ice Cream cup</div>
              <span class="price">Rs. 230</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Ice cream',230,'&#127853;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

         <div class="col-6 col-md-4 col-lg-3 product-card-wrap" data-cat="dairy">
          <div class="product-card card h-100">
            <div class="card-img-wrap"><img src="https://plus.unsplash.com/premium_photo-1666174848373-eda251e3acb1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Q29uZGVuc2VkJTIwTWlsayUyMHRpbnxlbnwwfHwwfHx8MA%3D%3D" alt="Condensed Milk" loading="lazy"/></div>
            <div class="card-body px-3 pb-3">
              <div class="cat-tag">Dairy</div>
              <div class="card-title-text">Condensed Milk</div>
              <span class="price">Rs. 900</span>
              <button class="btn-cart-card" onclick="addToCart(this,'Condensed Milk',900,'&#127853;')"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
            </div>
          </div>
        </div>

        


      </div>
    </div>
  </section>

  <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" style="width:380px">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title"><i class="bi bi-cart3 me-2"></i>Your Cart</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column p-0">
      <div class="flex-grow-1 overflow-auto px-3 py-2" id="cartItems"></div>
      <div class="cart-summary" id="cartSummary"></div>
    </div>
  </div>

  <div class="toast-container position-fixed bottom-0 start-50 translate-middle-x mb-3" style="z-index:9999">
    <div id="addToast" class="toast align-items-center text-bg-dark border-0 rounded-pill px-2" role="alert">
      <div class="d-flex">
        <div class="toast-body" id="toastMsg"></div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>

  <?php renderFooter(); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
</body>
</html>

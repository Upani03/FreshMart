<?php
// includes/functions.php – shared helper functions

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check whether a user is currently logged in.
 */
function isLoggedIn(): bool {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Redirect to a URL and stop execution.
 */
function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

/**
 * Sanitize a string for safe HTML output.
 */
function sanitize(string $value): string {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

/**
 * Return the logged-in user's username or a fallback.
 */
function currentUsername(string $fallback = 'Guest'): string {
    return isset($_SESSION['username']) ? sanitize($_SESSION['username']) : $fallback;
}

/**
 * Return the logged-in user's id.
 */
function currentUserId(): ?int {
    return isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;
}

/**
 * Set a one-time flash message.
 * Usage: setFlash('error', 'Invalid password');
 */
function setFlash(string $type, string $msg): void {
    $_SESSION['flash'] = ['type' => $type, 'msg' => $msg];
}

/**
 * Retrieve and clear the flash message.
 * Returns ['type'=>..., 'msg'=>...] or null.
 */
function getFlash(): ?array {
    if (isset($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $f;
    }
    return null;
}

/**
 * Render the Bootstrap alert HTML for a flash message.
 */
function renderFlash(): string {
    $f = getFlash();
    if (!$f) return '';
    $map = [
        'success' => 'alert-success',
        'error'   => 'alert-danger',
        'info'    => 'alert-info',
        'warning' => 'alert-warning',
    ];
    $cls = $map[$f['type']] ?? 'alert-info';
    return '<div class="alert ' . $cls . ' rounded-3 mb-3" role="alert">'
         . sanitize($f['msg']) . '</div>';
}

/**
 * Generate a CSRF token and store it in the session.
 */
function csrfToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate the submitted CSRF token.
 */
function verifyCsrf(): bool {
    $token = $_POST['csrf_token'] ?? '';
    return !empty($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Output a hidden CSRF input field.
 */
function csrfField(): string {
    return '<input type="hidden" name="csrf_token" value="' . csrfToken() . '">';
}

/**
 * Render the shared navigation bar.
 * $active: one of 'index','products','categories','contact','orders'
 */
function renderNav(string $active = ''): void {
    $loggedIn = isLoggedIn();
    $username = currentUsername();
    echo <<<HTML
<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">Fresh<span>Mart</span></a>
    <button class="navbar-toggler border-0" type="button"
            data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav mx-auto gap-1">
        <li class="nav-item"><a class="nav-link" data-page="index"      href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" data-page="products"   href="products.php">Products</a></li>
        <li class="nav-item"><a class="nav-link" data-page="categories" href="categories.php">Categories</a></li>
        <li class="nav-item"><a class="nav-link" data-page="contact"    href="contact.php">Contact</a></li>
        <li class="nav-item"><a class="nav-link" data-page="orders"     href="orders.php">My Orders</a></li>
      </ul>
      <div class="d-flex align-items-center gap-2">
HTML;
    if ($loggedIn) {
        echo <<<HTML
        <a href="dashboard.php" class="btn btn-sm btn-outline-success rounded-pill px-3">
          <i class="bi bi-person-fill me-1"></i>Hi, {$username}
        </a>
        <a href="auth/logout.php" class="btn btn-sm btn-outline-danger rounded-pill px-3">
          <i class="bi bi-box-arrow-right me-1"></i>Logout
        </a>
HTML;
    } else {
        echo <<<HTML
        <a href="auth/login.php" class="btn btn-sm btn-outline-success rounded-pill px-3">
          <i class="bi bi-person me-1"></i>Login
        </a>
        <a href="auth/register.php" class="btn btn-sm btn-success rounded-pill px-3">
          <i class="bi bi-person-plus me-1"></i>Register
        </a>
HTML;
    }
    echo <<<HTML
        <button class="btn-cart-nav ms-1" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
          <i class="bi bi-cart3"></i> Cart <span class="cart-pill">0</span>
        </button>
      </div>
    </div>
  </div>
</nav>
HTML;
}

/**
 * Render the shared cart offcanvas + toast HTML (included on every page).
 */
function renderCartCanvas(): void {
    echo <<<HTML
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
      <button type="button" class="btn-close btn-close-white me-2 m-auto"
              data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>
HTML;
}

/**
 * Render the shared footer.
 */
function renderFooter(): void {
    echo <<<HTML
<footer class="pt-5 pb-3">
  <div class="container">
    <div class="row g-4 mb-4">
      <div class="col-12 col-md-4">
        <div class="footer-logo mb-2">Fresh<span>Mart</span></div>
        <p style="font-size:.87rem">Your trusted online supermarket delivering
           fresh produce right to your door.</p>
      </div>
      <div class="col-6 col-md-4"><h5>Quick Links</h5><ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="categories.php">Categories</a></li>
        <li><a href="orders.php">My Orders</a></li>
      </ul></div>
      <div class="col-12 col-md-4"><h5>Contact Us</h5><ul>
        <li><i class="bi bi-geo-alt-fill text-success me-2"></i>123 Market St, Colombo 07</li>
        <li class="mt-2"><i class="bi bi-telephone-fill text-success me-2"></i>+94 11 234 5678</li>
        <li class="mt-2"><i class="bi bi-clock-fill text-success me-2"></i>Mon to Fri: 8am to 9pm</li>
      </ul></div>
    </div>
    <hr class="footer-divider"/>
    <p class="footer-bottom text-center mb-0">&copy; 2025 FreshMart. All rights reserved.
       Built with Bootstrap 5.</p>
  </div>
</footer>
HTML;
}

/**
 * Common <head> block shared by all pages.
 */
function renderHead(string $title = 'FreshMart'): void {
    echo <<<HTML
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="Cache-Control" content="no-store"/>
<title>{$title}</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="/freshmart/style.css"/>
HTML;
}

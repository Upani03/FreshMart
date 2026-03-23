<?php
// auth/login.php – User login
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (isLoggedIn()) redirect('../dashboard.php');

$error = '';
$oldEmail = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf()) {
        $error = 'Invalid request. Please try again.';
    } else {
        $email    = trim($_POST['email']    ?? '');
        $password = $_POST['password']      ?? '';
        $oldEmail = $email;

        if (empty($email) || empty($password)) {
            $error = 'Please fill in all fields.';
        } else {
            $db   = getDB();
            $stmt = $db->prepare('SELECT id, username, password FROM users WHERE email = ? LIMIT 1');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user_id']  = $user['id'];
                $_SESSION['username'] = $user['username'];
                setFlash('success', 'Welcome back, ' . $user['username'] . '!');
                redirect('../dashboard.php');
            } else {
                $error = 'Incorrect email or password.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><?php renderHead('FreshMart – Login'); ?></head>
<body>
<?php renderNav(); ?>

<section class="py-5" style="background:var(--body-bg);min-height:80vh">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-lg-5">

        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
          <div class="text-center mb-4">
            <div style="font-size:2.5rem">🔑</div>
            <h3 style="font-family:'Playfair Display',serif">Welcome Back</h3>
            <p class="text-muted" style="font-size:.9rem">Login to track your orders and save your details.</p>
          </div>

          <?= renderFlash() ?>

          <?php if ($error): ?>
            <div class="alert alert-danger rounded-3"><?= sanitize($error) ?></div>
          <?php endif; ?>

          <form method="POST" novalidate>
            <?= csrfField() ?>

            <div class="mb-3">
              <label class="form-label">Email Address <span class="text-danger">*</span></label>
              <input type="email" name="email" class="form-control"
                     value="<?= sanitize($oldEmail) ?>"
                     placeholder="john@example.com" required/>
            </div>
            <div class="mb-4">
              <label class="form-label">Password <span class="text-danger">*</span></label>
              <input type="password" name="password" class="form-control"
                     placeholder="Your password" required/>
            </div>

            <button type="submit" class="btn btn-success w-100 rounded-pill py-2 fw-semibold">
              <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
          </form>

          <p class="text-center mt-3 mb-0" style="font-size:.88rem">
            Don't have an account?
            <a href="register.php" class="text-success fw-semibold">Register</a>
          </p>
        </div>

        <!-- Demo credentials hint -->
        <div class="text-center mt-3 text-muted" style="font-size:.82rem">
          Demo account: <strong>demo@freshmart.lk</strong> / <strong>Demo@1234</strong>
        </div>

      </div>
    </div>
  </div>
</section>

<?php renderCartCanvas(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="../app.js"></script>
</body>
</html>

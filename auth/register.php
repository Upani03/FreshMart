<?php
// auth/register.php – User registration
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (isLoggedIn()) redirect('../dashboard.php');

$errors = [];
$old    = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf()) {
        $errors[] = 'Invalid request. Please try again.';
    } else {
        $username  = trim($_POST['username']  ?? '');
        $email     = trim($_POST['email']     ?? '');
        $password  = $_POST['password']       ?? '';
        $confirm   = $_POST['confirm']        ?? '';
        $old       = compact('username', 'email');

        // Validate
        if (strlen($username) < 3) {
            $errors[] = 'Username must be at least 3 characters.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }
        if (strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters.';
        }
        if ($password !== $confirm) {
            $errors[] = 'Passwords do not match.';
        }

        if (empty($errors)) {
            $db = getDB();
            // Check if email already taken
            $stmt = $db->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors[] = 'This email is already registered. <a href="login.php">Login instead?</a>';
            } else {
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $ins  = $db->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
                $ins->execute([$username, $email, $hash]);

                setFlash('success', 'Account created successfully! Please log in.');
                redirect('login.php');
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><?php renderHead('FreshMart – Register'); ?></head>
<body>
<?php renderNav(); ?>

<section class="py-5" style="background:var(--body-bg);min-height:80vh">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-lg-5">

        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
          <div class="text-center mb-4">
            <div style="font-size:2.5rem">🛒</div>
            <h3 style="font-family:'Playfair Display',serif">Create Account</h3>
            <p class="text-muted" style="font-size:.9rem">Join FreshMart for faster checkout &amp; order tracking.</p>
          </div>

          <?php if ($errors): ?>
            <div class="alert alert-danger rounded-3">
              <?php foreach ($errors as $e) echo '<div>' . $e . '</div>'; ?>
            </div>
          <?php endif; ?>

          <form method="POST" novalidate>
            <?= csrfField() ?>

            <div class="mb-3">
              <label class="form-label">Username <span class="text-danger">*</span></label>
              <input type="text" name="username" class="form-control"
                     value="<?= sanitize($old['username'] ?? '') ?>"
                     placeholder="john_silva" required/>
            </div>
            <div class="mb-3">
              <label class="form-label">Email Address <span class="text-danger">*</span></label>
              <input type="email" name="email" class="form-control"
                     value="<?= sanitize($old['email'] ?? '') ?>"
                     placeholder="john@example.com" required/>
            </div>
            <div class="mb-3">
              <label class="form-label">Password <span class="text-danger">*</span></label>
              <input type="password" name="password" class="form-control"
                     placeholder="At least 6 characters" required/>
            </div>
            <div class="mb-4">
              <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
              <input type="password" name="confirm" class="form-control"
                     placeholder="Repeat password" required/>
            </div>

            <button type="submit" class="btn btn-success w-100 rounded-pill py-2 fw-semibold">
              <i class="bi bi-person-plus me-2"></i>Create Account
            </button>
          </form>

          <p class="text-center mt-3 mb-0" style="font-size:.88rem">
            Already have an account?
            <a href="login.php" class="text-success fw-semibold">Login</a>
          </p>
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

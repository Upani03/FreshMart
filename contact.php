<?php
// contact.php – Contact form with database storage
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$ajaxMode = !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $phone   = trim($_POST['phone']   ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $errors  = [];

    if (!verifyCsrf()) $errors[] = 'Invalid request.';
    if (strlen($name)    < 2)                           $errors[] = 'Please enter your name.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))     $errors[] = 'Please enter a valid email.';
    if (strlen($subject) < 2)                           $errors[] = 'Please enter a subject.';
    if (strlen($message) < 5)                           $errors[] = 'Please enter your message.';

    if (empty($errors)) {
        $db   = getDB();
        $stmt = $db->prepare(
            'INSERT INTO messages (name, email, phone, subject, message)
             VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->execute([$name, $email, $phone ?: null, $subject, $message]);

        if ($ajaxMode) {
            header('Content-Type: application/json');
            echo json_encode(['ok' => true]);
            exit;
        }
        setFlash('success', 'Message sent! We\'ll get back to you within 24 hours.');
        redirect('contact.php');
    } elseif ($ajaxMode) {
        header('Content-Type: application/json');
        http_response_code(422);
        echo json_encode(['ok' => false, 'errors' => $errors]);
        exit;
    }
    // Non-AJAX fallback: re-render with errors via flash
    setFlash('error', implode(' ', $errors));
    redirect('contact.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head><?php renderHead('FreshMart – Contact Us'); ?></head>
<body>
<?php renderNav('contact'); ?>

<div class="page-hero">
  <div class="container text-center">
    <h1>Contact Us</h1>
    <p class="opacity-75 mb-0">We'd love to hear from you. Reach out anytime!</p>
  </div>
</div>

<section class="py-5" style="background:var(--body-bg)">
  <div class="container">
    <div class="row g-4">

      <!-- LEFT INFO -->
      <div class="col-12 col-lg-4">
        <div class="info-card card p-4 mb-3">
          <div class="d-flex gap-3 align-items-start">
            <div class="info-icon"><i class="bi bi-geo-alt-fill text-success"></i></div>
            <div><h6 class="fw-bold mb-1">Our Location</h6>
              <p class="mb-0 text-muted" style="font-size:.9rem">123 Market Street, Colombo 07<br/>Sri Lanka</p></div>
          </div>
        </div>
        <div class="info-card card p-4 mb-3">
          <div class="d-flex gap-3 align-items-start">
            <div class="info-icon"><i class="bi bi-telephone-fill text-success"></i></div>
            <div><h6 class="fw-bold mb-1">Phone</h6>
              <p class="mb-0 text-muted" style="font-size:.9rem">+94 11 234 5678<br/>+94 77 890 1234 (WhatsApp)</p></div>
          </div>
        </div>
        <div class="info-card card p-4 mb-3">
          <div class="d-flex gap-3 align-items-start">
            <div class="info-icon"><i class="bi bi-envelope-fill text-success"></i></div>
            <div><h6 class="fw-bold mb-1">Email</h6>
              <p class="mb-0 text-muted" style="font-size:.9rem">info@freshmart.lk<br/>support@freshmart.lk</p></div>
          </div>
        </div>
        <div class="hours-card p-4">
          <h6 class="fw-bold mb-3"><i class="bi bi-clock-fill me-2"></i>Opening Hours</h6>
          <div class="hours-row"><span>Monday – Friday</span><strong>8:00 AM – 9:00 PM</strong></div>
          <div class="hours-row"><span>Saturday</span><strong>8:00 AM – 8:00 PM</strong></div>
          <div class="hours-row"><span>Sunday</span><strong>9:00 AM – 6:00 PM</strong></div>
        </div>
      </div>

      <!-- RIGHT FORM -->
      <div class="col-12 col-lg-8">
        <div class="form-card card p-4 p-md-5">
          <h4 style="font-family:'Playfair Display',serif" class="mb-1">Send Us a Message</h4>
          <p class="text-muted mb-4" style="font-size:.9rem">We'll get back to you within 24 hours.</p>

          <div id="successAlert" class="alert alert-success d-none rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <strong>Message sent!</strong> We'll get back to you within 24 hours.
          </div>
          <div id="errorAlert" class="alert alert-danger d-none rounded-3 mb-4" role="alert"></div>

          <form id="contactForm" novalidate>
            <?= csrfField() ?>
            <div class="row g-3">
              <div class="col-12 col-md-6">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="John Silva" required/>
                <div class="invalid-feedback">Please enter your name.</div>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" placeholder="john@example.com" required/>
                <div class="invalid-feedback">Please enter a valid email.</div>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Phone Number <span class="text-muted fw-normal">(optional)</span></label>
                <input type="tel" name="phone" class="form-control" placeholder="+94 77 123 4567"/>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Subject <span class="text-danger">*</span></label>
                <input type="text" name="subject" class="form-control" placeholder="Order enquiry, Feedback..." required/>
                <div class="invalid-feedback">Please enter a subject.</div>
              </div>
              <div class="col-12">
                <label class="form-label">Message <span class="text-danger">*</span></label>
                <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                <div class="invalid-feedback">Please enter your message.</div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn-submit">
                  Send Message <i class="bi bi-send-fill ms-2"></i>
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- FAQ -->
        <div class="mt-4">
          <h5 class="fw-bold mb-3"><i class="bi bi-question-circle-fill text-success me-2"></i>Frequently Asked Questions</h5>
          <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">What areas do you deliver to?</button>
              </h2>
              <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">We deliver across Colombo, Gampaha, and Negombo. Free delivery on orders above Rs. 3,000.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">How long does delivery take?</button>
              </h2>
              <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">Standard delivery is 2-4 hours. Express delivery is under 90 minutes.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">Can I return or exchange items?</button>
              </h2>
              <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">Yes! We accept returns within 24 hours for damaged or incorrect items.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">What payment methods do you accept?</button>
              </h2>
              <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">Cash on Delivery, Credit/Debit Cards, PayHere, FriMi Wallet, Koko BNPL, and Bank Transfer.</div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<?php renderCartCanvas(); ?>
<?php renderFooter(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>
<script>
// Override the default contact-form handler to use AJAX
document.addEventListener('DOMContentLoaded', function () {
  var form   = document.getElementById('contactForm');
  var okDiv  = document.getElementById('successAlert');
  var errDiv = document.getElementById('errorAlert');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    if (!form.checkValidity()) { form.classList.add('was-validated'); return; }

    var btn = form.querySelector('button[type="submit"]');
    if (btn) { btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...'; btn.disabled = true; }

    var data = new FormData(form);
    fetch('contact.php', {
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
      body: data
    })
    .then(function (r) { return r.json(); })
    .then(function (res) {
      if (res.ok) {
        okDiv.classList.remove('d-none');
        errDiv.classList.add('d-none');
        form.reset();
        form.classList.remove('was-validated');
        setTimeout(function () { okDiv.classList.add('d-none'); }, 4000);
      } else {
        errDiv.innerHTML = (res.errors || ['Unknown error.']).join('<br>');
        errDiv.classList.remove('d-none');
        okDiv.classList.add('d-none');
      }
    })
    .catch(function () {
      errDiv.innerHTML = 'Could not send message. Please try again.';
      errDiv.classList.remove('d-none');
    })
    .finally(function () {
      if (btn) { btn.innerHTML = 'Send Message <i class="bi bi-send-fill ms-2"></i>'; btn.disabled = false; }
    });
  });
});
</script>
</body>
</html>

<?php
// cancel_order.php – Cancel an order (AJAX POST)
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'Not logged in.']);
    exit;
}

$raw  = file_get_contents('php://input');
$data = json_decode($raw, true) ?: $_POST;
$orderId = (int)($data['orderId'] ?? 0);

if (!$orderId) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Invalid order ID.']);
    exit;
}

$db   = getDB();
// Only allow cancelling Confirmed/Processing orders belonging to this user
$stmt = $db->prepare('
    UPDATE orders SET status = "Cancelled"
    WHERE id = ? AND user_id = ? AND status IN ("Confirmed","Processing")
');
$stmt->execute([$orderId, currentUserId()]);

if ($stmt->rowCount() > 0) {
    echo json_encode(['ok' => true]);
} else {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Order cannot be cancelled.']);
}
exit;

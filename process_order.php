<?php
// process_order.php – Receives order data via AJAX POST, saves to DB
// Also accessible via normal form POST for non-JS fallback.
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed.']);
    exit;
}

// --- Auth check ---
if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'redirect' => 'auth/login.php']);
    exit;
}

// --- Read JSON body (AJAX sends JSON) ---
$raw  = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) {
    // Fallback: form-encoded POST
    $data = $_POST;
}

// --- Extract & validate ---
$items        = $data['items']          ?? [];
$subtotal     = (float)($data['subtotal']    ?? 0);
$deliveryFee  = (float)($data['deliveryFee'] ?? 0);
$total        = (float)($data['total']       ?? 0);
$delivName    = trim($data['delivName']    ?? '');
$delivPhone   = trim($data['delivPhone']   ?? '');
$delivAddress = trim($data['delivAddress'] ?? '');
$delivCity    = trim($data['delivCity']    ?? '');
$delivPostal  = trim($data['delivPostal']  ?? '');
$delivNote    = trim($data['delivNote']    ?? '');
$delivType    = trim($data['delivType']    ?? 'standard');
$delivSlot    = trim($data['delivSlot']    ?? '');
$payMethod    = trim($data['payMethod']    ?? 'cod');
$payLabel     = trim($data['payLabel']     ?? 'Cash on Delivery');
$orderRef     = trim($data['orderRef']     ?? 'FM-' . strtoupper(bin2hex(random_bytes(4))));

if (empty($items) || $subtotal <= 0) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Cart is empty.']);
    exit;
}

if ($delivType !== 'pickup') {
    if (!$delivName || !$delivPhone || !$delivAddress || !$delivCity || !$delivPostal) {
        http_response_code(422);
        echo json_encode(['ok' => false, 'error' => 'Please fill in all delivery fields.']);
        exit;
    }
}

// --- Insert into DB ---
$db = getDB();

try {
    $db->beginTransaction();

    $stmt = $db->prepare('
        INSERT INTO orders
          (user_id, order_ref, subtotal, delivery_fee, total_amount,
           delivery_name, delivery_phone, delivery_address, delivery_city,
           postal_code, delivery_note, delivery_type, delivery_slot,
           payment_method, payment_label, status)
        VALUES (?,?,?,?,?, ?,?,?,?,?,?,?,?, ?,?,?)
    ');
    $stmt->execute([
        currentUserId(), $orderRef, $subtotal, $deliveryFee, $total,
        $delivName ?: null, $delivPhone ?: null, $delivAddress ?: null,
        $delivCity ?: null, $delivPostal ?: null, $delivNote ?: null,
        $delivType, $delivSlot ?: null,
        $payMethod, $payLabel, 'Confirmed'
    ]);
    $orderId = (int)$db->lastInsertId();

    $itemStmt = $db->prepare('
        INSERT INTO order_items (order_id, product_name, product_price, quantity, emoji)
        VALUES (?,?,?,?,?)
    ');
    foreach ($items as $it) {
        $itemStmt->execute([
            $orderId,
            substr(trim($it['name']  ?? ''), 0, 150),
            (float)($it['price'] ?? 0),
            max(1, (int)($it['qty']  ?? 1)),
            substr(trim($it['emoji'] ?? '🛒'), 0, 10),
        ]);
    }

    $db->commit();
} catch (Exception $e) {
    $db->rollBack();
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'DB error: ' . $e->getMessage()]);
    exit;
}

echo json_encode(['ok' => true, 'orderId' => $orderId, 'orderRef' => $orderRef]);
exit;

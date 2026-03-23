<?php
// includes/db.php – PDO database connection
// Update credentials to match your XAMPP/WAMP setup.

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'freshmart_db2');
define('DB_USER', 'root');
define('DB_PASS', '');          // XAMPP default is empty; change if needed
define('DB_CHARSET', 'utf8mb4');
define('DB_PORT', 3308);

function getDB(): PDO {
    static $pdo = null;
    if ($pdo !== null) return $pdo;

    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT. ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        // Show a friendly message; never expose credentials in production
        http_response_code(500);
        die('<h3 style="font-family:sans-serif;color:#c00">Database connection failed. '
          . 'Please check your credentials in <code>includes/db.php</code>.</h3>'
          . '<p style="font-family:sans-serif">' . htmlspecialchars($e->getMessage()) . '</p>');
    }
    return $pdo;
}

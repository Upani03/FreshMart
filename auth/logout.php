<?php
// auth/logout.php – Destroy session and redirect
require_once __DIR__ . '/../includes/functions.php';

session_unset();
session_destroy();

// Start a fresh session just to set the flash message
session_start();
setFlash('info', 'You have been logged out successfully.');

redirect('../index.php');

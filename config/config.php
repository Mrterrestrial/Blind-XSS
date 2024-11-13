<?php
// Retrieve webhook URL from environment variable for better security
$webhook_url = getenv('WEBHOOK_URL');
if (!$webhook_url || !filter_var($webhook_url, FILTER_VALIDATE_URL)) {
    error_log("Invalid or missing webhook URL. Please set it in the environment variables.");
    exit('Configuration error: Invalid webhook URL');
}
define("WEBHOOK_URL", $webhook_url);
?>

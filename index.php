<?php
// index.php

// Define the class for email decoding
namespace App;

class EmailDecoder
{
    // Check if a string is Base64 encoded
    public static function isBase64($data)
    {
        return base64_encode(base64_decode($data, true)) === $data;
    }

    // Process the input and redirect
    public static function process($input)
    {
        if (self::isBase64($input)) {
            $email = base64_decode($input);

            // Re-encode the email for the URL
            $encodedEmail = base64_encode($email);

            // Avoid infinite redirection
            if ($_SERVER['REQUEST_URI'] !== "/{$encodedEmail}") {
                header("Location: /{$encodedEmail}");
                exit;
            } else {
                echo "Processed email: " . htmlspecialchars($email);
            }
        } else {
            echo "Invalid Base64 encoded email.";
        }
    }
}

// Get the email from the URL query parameter (e.g., ?email=encodedemail)
if (isset($_GET['email']) && !empty($_GET['email'])) {
    $email = $_GET['email'];
    EmailDecoder::process($email);
} else {
    echo "No email provided.";
}
?>

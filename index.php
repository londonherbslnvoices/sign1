<?php

// Extract the 5-digit random number and the Base64-encoded email from the URL path
$path = trim($_SERVER['REQUEST_URI'], '/');
$randomNumber = substr($path, 0, 5); // Extract the first 5 digits
$encodedEmail = substr($path, 5); // Extract the rest (the Base64-encoded email)

// Validate the Base64-encoded email format
if (base64_encode(base64_decode($encodedEmail, true)) === $encodedEmail) {
    // Construct the redirect URL with the Base64-encoded email
    $redirectUrl = "https://example.com/{$encodedEmail}";

    // Redirect the user to the new URL
    header("Location: {$redirectUrl}");
    exit;
} else {
    // If the email is not valid, display an error
    echo "Invalid Base64-encoded email.";
}
?>

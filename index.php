<?php

// Check if the 'email' parameter is passed in the URL
if (isset($_GET['email']) && !empty($_GET['email'])) {
    $encodedEmail = $_GET['email'];

    // Ensure the email is Base64 encoded
    if (base64_encode(base64_decode($encodedEmail, true)) === $encodedEmail) {
        // Check if the URL contains the 5-digit random number and the encoded email
        if (preg_match('/^(\d{5})([a-zA-Z0-9+\/=]+)$/', $encodedEmail, $matches)) {
            $randomNumber = $matches[1];  // Extract the 5-digit random number
            $emailPart = $matches[2];     // Extract the Base64 email part

            // Construct the new redirect URL
            $redirectUrl = "https://example.com/{$randomNumber}{$emailPart}";

            // Redirect to the new URL
            header("Location: {$redirectUrl}");
            exit; // Ensure no further code is executed
        } else {
            echo "The email does not contain a valid 5-digit random number and Base64 encoded email.";
        }
    } else {
        echo "Invalid Base64 encoded email.";
    }
} else {
    echo "No email parameter provided.";
}

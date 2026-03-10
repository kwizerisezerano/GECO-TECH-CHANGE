<?php
/**
 * Simple PHP Contact Form for GECO RWANDA
 * Backup contact form using PHP mail function
 */

header('Content-Type: application/json');

// Configuration
$to_email = 'globalepelepticc@gmail.com';
$from_email = 'noreply@gecorwanda.org';
$app_name = 'GECO RWANDA';

// Get POST data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validate required fields
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please fill in all required fields.'
    ]);
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please enter a valid email address.'
    ]);
    exit;
}

// Email subject
$email_subject = "$app_name Contact Form: $subject";

// Email body
$email_body = "
You have received a new message from $app_name contact form.

Name: $name
Email: $email
Phone: $phone
Subject: $subject

Message:
$message

---
This email was sent from the $app_name website.
Date: " . date('Y-m-d H:i:s');

// Email headers
$headers = "From: $app_name <$from_email>\r\n";
$headers .= "Reply-To: $name <$email>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
if (mail($to_email, $email_subject, $email_body, $headers)) {
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your message! We will get back to you soon.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Sorry, there was an error sending your message. Please try again.'
    ]);
}
?>

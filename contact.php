<?php
session_start();

$success = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if (empty($name)) {
        $error = 'Name is required';
    } elseif (empty($email)) {
        $error = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format';
    } elseif (empty($subject)) {
        $error = 'Subject is required';
    } elseif (empty($message)) {
        $error = 'Message is required';
    } else {
        $success = 'Thank you for contacting us! We will get back to you soon.';
        $name = $email = $subject = $message = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Freelance Marketplace</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="wrapper">
<?php include 'navigation.php'; ?>

<main class="main-content">
<div class="container">
<h1 class="heading-primary">Contact Us</h1>

<!-- GRID CONTAINER -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 30px;">

    <!-- CARD 1 -->
    <div class="card">
        <div class="card-header">
            <h2 class="heading-secondary" style="margin: 0;">Contact Information</h2>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong><br>
            <a href="mailto:support@skillup.com">support@skillup.com</a></p>

            <p><strong>Phone:</strong><br>
            +1 (555) 123-4567</p>

            <p><strong>Address:</strong><br>
            Nablus Street<br>
            Ramallah<br>
            Palestine</p>

            <p><strong>Business Hours:</strong><br>
            Monday - Friday: 9:00 AM - 6:00 PM<br>
            Saturday: 10:00 AM - 4:00 PM<br>
            Sunday: Closed</p>
        </div>
    </div>

    <!-- CARD 2 -->
    <div class="card">
        <div class="card-header">
            <h2 class="heading-secondary" style="margin: 0;">Frequently Asked Questions</h2>
        </div>
        <div class="card-body">
            <p><strong>How long does it take to get a response?</strong><br>
            We typically respond within 24–48 hours during business days.</p>

            <p><strong>What should I include in my message?</strong><br>
            Please provide as much detail as possible about your inquiry.</p>

            <p><strong>Can I call for urgent issues?</strong><br>
            Yes, please call our support line during business hours.</p>

            <p><strong>Do you offer live chat support?</strong><br>
            Chat support is available for logged-in users Monday through Friday from 9:00 AM to 5:00 PM.</p>
        </div>
    </div>

</div>
</div>
</main>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

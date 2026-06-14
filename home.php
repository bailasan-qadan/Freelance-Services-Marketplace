<?php
session_start();
require_once 'db.php.inc';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelance Marketplace - Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="wrapper">
        <?php include 'navigation.php'; ?>
        
        <main class="main-content">
            <!-- Hero Section -->
            <section class="hero-section">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1 class="hero-title">Freelance work, <br>build on trust.</h1>
                        <p class="hero-description">
                            Freelance Marketplace is a professional platform that connects clients with skilled freelancers in a secure and transparent environment. We focus on quality, clarity, and fairness to ensure successful collaboration for every project.
                        </p>
                        <p class="hero-description">
                            Our platform is designed to simplify the hiring process for clients while giving freelancers the tools they need to showcase their expertise, manage their work, and build long-term professional relationships.
                        </p>
                    </div>
                    <div class="hero-image">
                        <img src="images/hero-illustration.png" alt="Freelance work illustration">
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="features-section">
                <div class="feature-card">
                    <div class="feature-image">
                        <img src="images/client-illustration.png" alt="For our clients">
                    </div>
                    <div class="feature-content">
                        <h2 class="feature-title">For our clients</h2>
                        <p class="feature-description">
                            Find qualified professionals, manage projects efficiently, and communicate with confidence. Our marketplace helps clients make informed decisions and achieve reliable results.
                        </p>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-image">
                        <img src="images/freelancer-illustration.png" alt="For our freelancers">
                    </div>
                    <div class="feature-content">
                        <h2 class="feature-title">For our freelancers</h2>
                        <p class="feature-description">
                            Create your professional presence, offer your services, and connect with real clients. We support freelancers in growing their careers through fair opportunities and clear workflows.
                        </p>
                    </div>
                </div>
            </section>
        </main>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>
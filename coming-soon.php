<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        .coming-soon-wrapper {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .coming-soon-card {
            max-width: 600px;
            width: 100%;
            text-align: center;
            padding: 40px;
        }

        .coming-soon-card h1 {
            margin-bottom: 15px;
        }

        .coming-soon-card p {
            color: #555;
            line-height: 1.6;
        }

        .phase-note {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #888;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="wrapper">
<?php include 'navigation.php'; ?>

<main class="main-content">
    <div class="container coming-soon-wrapper">
        <div class="card coming-soon-card">
            <h1 class="heading-primary">Coming Soon 🚧</h1>

            <p>
                This page is currently under development.
                We are working on the next phase of the platform to bring you
                a complete and polished experience.
            </p>

            <p class="phase-note">
                Final project is in progress. Stay tuned.
            </p>
        </div>
    </div>
</main>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

<?php
session_start();
require_once 'db.php.inc';

// Get service ID
$serviceId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($serviceId <= 0) {
    header("Location: index.php");
    exit;
}

// Fetch service details
try {
    $stmt = $pdo->prepare("
        SELECT 
            s.service_id,
            s.title,
            s.category,
            s.subcategory,
            s.description,
            s.price,
            s.delivery_time,
            s.revisions_included,
            s.image_1,
            s.image_2,
            s.image_3,
            s.status,
            s.featured_status,
            s.created_date,
            u.first_name,
            u.last_name
        FROM services s
        JOIN users u ON s.freelancer_id = u.user_id
        WHERE s.service_id = :id
        AND s.status = 'Active'
        LIMIT 1
    ");
    $stmt->execute(['id' => $serviceId]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$service) {
        $error = "Service not found or no longer available.";
    }
} catch (PDOException $e) {
    $error = "Error loading service details.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="wrapper">
    <?php include 'navigation.php'; ?>

    <main class="main-content">
        <div class="container">

            <?php if (isset($error)): ?>
                <div class="card">
                    <div class="card-body text-center message-error">
                        <?php echo htmlspecialchars($error); ?>
                        <br><br>
                        <a href="index.php" class="btn btn-primary">Back to Services</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="card">

                    <!-- CARD HEADER -->
                    <div class="card-header">
                        <h1 class="heading-primary">
                            <?php echo htmlspecialchars($service['title']); ?>
                        </h1>
                        <?php if ($service['featured_status'] === 'Yes'): ?>
                            <span class="featured-indicator"></span>
                        <?php endif; ?>
                    </div>

                    <!-- CARD BODY -->
                    <div class="card-body">

                        <p class="text-muted">
                            By <strong><?php echo htmlspecialchars($service['first_name'] . ' ' . $service['last_name']); ?></strong>
                        </p>

                        <?php
                        $images = array_filter([
                            $service['image_1'],
                            $service['image_2'],
                            $service['image_3']
                        ]);
                        ?>

                        <?php if (!empty($images)): ?>
                            <div class="services-grid">
                                <?php foreach ($images as $img): ?>
                                    <img src="<?php echo htmlspecialchars($img); ?>" alt="Service image" class="service-card-image">
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <p><strong>Category:</strong> 
                            <?php echo htmlspecialchars($service['category']); ?>
                            <?php if (!empty($service['subcategory'])): ?>
                                / <?php echo htmlspecialchars($service['subcategory']); ?>
                            <?php endif; ?>
                        </p>

                        <p><strong>Delivery Time:</strong> <?php echo htmlspecialchars($service['delivery_time']); ?> days</p>
                        <p><strong>Revisions Included:</strong> <?php echo htmlspecialchars($service['revisions_included']); ?></p>
                        <p><strong>Price:</strong> $<?php echo number_format($service['price'], 2); ?></p>

                        <hr>

                        <p><strong>Description:</strong></p>
                        <p><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>

                    </div>

                    <!-- CARD FOOTER -->
                    <div class="card-footer">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="coming-soon.php" class="btn btn-primary">Add to Cart</a>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endif; ?>

        </div>
    </main>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

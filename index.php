<?php
session_start();
require_once 'db.php.inc';

// Get search query
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';

// Fetch services from database with optional search
try {
    if (!empty($searchQuery)) {
        // Search in title, category, subcategory, and freelancer name
        $query = "SELECT 
                    s.service_id,
                    s.title,
                    s.category,
                    s.subcategory,
                    s.price,
                    s.delivery_time,
                    s.status,
                    s.featured_status,
                    s.service_image,
                    s.created_date,
                    u.first_name,
                    u.last_name
                  FROM services s
                  JOIN users u ON s.freelancer_id = u.user_id
                  WHERE s.status = 'Active'
                  AND (
                      s.title LIKE :search
                      OR s.category LIKE :search
                      OR s.subcategory LIKE :search
                      OR CONCAT(u.first_name, ' ', u.last_name) LIKE :search
                  )
                  ORDER BY s.featured_status DESC, s.created_date DESC";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute(['search' => '%' . $searchQuery . '%']);
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // No search query - show all active services
        $query = "SELECT 
                    s.service_id,
                    s.title,
                    s.category,
                    s.subcategory,
                    s.price,
                    s.delivery_time,
                    s.status,
                    s.featured_status,
                    s.service_image,
                    s.created_date,
                    u.first_name,
                    u.last_name
                  FROM services s
                  JOIN users u ON s.freelancer_id = u.user_id
                  WHERE s.status = 'Active'
                  ORDER BY s.featured_status DESC, s.created_date DESC";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
} catch (PDOException $e) {
    $error = "Error loading services: " . $e->getMessage();
    $services = [];
}

$serviceCount = count($services);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Services - Freelance Marketplace</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="wrapper">
        <?php include 'navigation.php'; ?>
        
        <main class="main-content">
            <div class="container">
                <h1 class="heading-primary">Browse Services</h1>
                
                <!-- Search Results Info -->
                <?php if (!empty($searchQuery)): ?>
                    <div class="results-info">
                        <div>
                            <strong>Search results for "<?php echo htmlspecialchars($searchQuery); ?>"</strong>
                            <span class="text-muted"> - <?php echo $serviceCount; ?> service<?php echo $serviceCount !== 1 ? 's' : ''; ?> found</span>
                        </div>
                        <a href="index.php" class="clear-filters">Show All Services</a>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($error)): ?>
                    <div class="message-error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <?php if (empty($services)): ?>
                    <div class="empty-state">
                        <?php if (!empty($searchQuery)): ?>
                            <p>No services found matching "<?php echo htmlspecialchars($searchQuery); ?>"</p>
                            <a href="index.php" class="btn btn-primary">Show All Services</a>
                        <?php else: ?>
                            <p>No services available at the moment.</p>
                            <a href="home.php" class="btn btn-primary">Return to Home</a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="table-container">
                        <table class="services-table">
                            <tbody>
                                <!-- Header Row (as regular row with bold text) -->
                                <tr class="table-header-row">
                                    <td></td> <!-- Empty header for image column -->
                                    <td>Service Title</td>
                                    <td>Freelancer</td>
                                    <td>Category</td>
                                    <td>Price</td>
                                    <td>Delivery Time</td>
                                    <td>Status</td>
                                    <td>Actions</td>
                                </tr>
                                
                                <!-- Data Rows -->
                                <?php foreach ($services as $service): ?>
                                <tr>
                                    <td class="image-cell">
                                        <?php if (!empty($service['service_image'])): ?>
                                            <img src="<?php echo htmlspecialchars($service['service_image']); ?>" 
                                                 alt="<?php echo htmlspecialchars($service['title']); ?>" 
                                                 class="table-thumbnail">
                                        <?php else: ?>
                                            <div class="table-thumbnail-placeholder">No Image</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="service-detail.php?id=<?php echo htmlspecialchars($service['service_id']); ?>" 
                                           class="service-link">
                                            <?php 
                                            if ($service['featured_status'] === 'Yes') {
                                                echo '<span class="featured-indicator">Featured</span> ';
                                            }
                                            echo htmlspecialchars($service['title']); 
                                            ?>
                                        </a>
                                    </td>
                                    <td><?php echo htmlspecialchars($service['first_name'] . ' ' . $service['last_name']); ?></td>
                                    <td><?php echo htmlspecialchars($service['category']); ?></td>
                                    <td class="price-cell">$<?php echo number_format($service['price'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($service['delivery_time']); ?> days</td>
                                    <td>
                                        <span class="badge badge-status-active">
                                            <?php echo htmlspecialchars($service['status']); ?>
                                        </span>
                                    </td>
                                    <td class="actions-cell">
                                        <a href="service-detail.php?id=<?php echo htmlspecialchars($service['service_id']); ?>" 
                                            class="btn btn-primary btn-sm">View Details</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>
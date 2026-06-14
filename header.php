<?php
$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $isLoggedIn ? $_SESSION['role'] : null;
$userName = $isLoggedIn ? $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] : '';

// Set default placeholder for profile photo
$userPhoto = 'images/default_picture.png';

// Check if user has a profile photo and if the file exists
if ($isLoggedIn && !empty($_SESSION['profile_photo']) && file_exists($_SESSION['profile_photo'])) {
    $userPhoto = $_SESSION['profile_photo'];
}

// Get cart count for clients
$cartCount = 0;
if ($isLoggedIn && $userRole === 'Client' && isset($_SESSION['cart'])) {
    $cartCount = count($_SESSION['cart']);
}
?>
<header class="header">
    <div class="header-container">
        <!-- Logo/Brand -->
        <div class="header-logo">
            <a href="home.php">
                <img src="images/logo.png" alt="Skill Up Logo">
                <h1>Skill Up</h1>
            </a>
        </div>
        
        <!-- Search Bar -->
        <div class="header-search">
            <form method="GET" action="index.php">
                <input type="text" name="q" class="form-input" 
                       placeholder="Search services..." 
                       value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        
        <!-- Authentication/User Section -->
        <div class="header-auth">
            <?php if (!$isLoggedIn): ?>
                <!-- Guest Users: Show Login/Sign up buttons -->
                <a href="coming-soon.php" class="btn btn-secondary">Login</a>
                <a href="coming-soon.php" class="btn btn-primary">Sign Up</a>
            <?php else: ?>
                <!-- Logged-in Users -->
                
                <?php if ($userRole === 'Client'): ?>
                    <!-- Shopping Cart Icon (Clients Only) -->
                    <div class="cart-icon-container">
                        <a href="coming-soon.php" class="cart-link">
                            <img src="images/cart.png" alt="Cart" class="cart-icon">
                            <?php if ($cartCount > 0): ?>
                                <span class="cart-badge"><?php echo $cartCount; ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endif; ?>

                <!-- User Profile Card -->
                <div class="user-profile-card <?php echo $userRole === 'Client' ? 'client-card' : 'freelancer-card'; ?>">
                    <a href="coming-soon.php" class="profile-link">
                        <img src="<?php echo htmlspecialchars($userPhoto); ?>" 
                            alt="Profile" 
                            class="profile-pic"
                            onerror="this.onerror=null; this.src='images/default_picture.png';">
                        <span class="profile-name"><?php echo htmlspecialchars($userName); ?></span>
                    </a>
                </div>
                
                <!-- Logout Link -->
                <a href="coming-soon.php" class="btn btn-secondary">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</header>
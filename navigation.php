<?php
// Determine current page
$currentPage = basename($_SERVER['PHP_SELF']);
$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $isLoggedIn ? $_SESSION['role'] : null;
?>
<nav class="navigation">
    <div class="nav-menu-title">Menu</div>
    <ul class="nav-list">
        <!-- HOME - Available to all -->
        <li class="nav-item">
            <a href="home.php" class="nav-link <?php echo ($currentPage === 'home.php') ? 'nav-link-active' : ''; ?>">
                <span class="nav-icon">
                    <img src="images/home-icon.png" alt="Home">
                </span> 
                Home
            </a>
        </li>
        
        <!-- BROWSE SERVICES -->
        <li class="nav-item">
            <a href="index.php" class="nav-link <?php echo ($currentPage === 'index.php') ? 'nav-link-active' : ''; ?>">
                <span class="nav-icon">
                    <img src="images/search-icon.png" alt="Browse">
                </span> 
                Browse Services
            </a>
        </li>
        
        <?php if (!$isLoggedIn): ?>
            <!-- GUEST USERS ONLY -->
            <li class="nav-item">
                <a href="coming-soon.php" class="nav-link <?php echo ($currentPage === 'coming-soon.php') ? 'nav-link-active' : ''; ?>">
                    <span class="nav-icon">
                        <img src="images/login-icon.png" alt="Login">
                    </span> 
                    Login
                </a>
            </li>
            <li class="nav-item">
                <a href="coming-soon.php" class="nav-link <?php echo ($currentPage === 'coming-soon.php') ? 'nav-link-active' : ''; ?>">
                    <span class="nav-icon">
                        <img src="images/signup-icon.png" alt="Sign Up">
                    </span> 
                    Sign Up
                </a>
            </li>
            
        <?php elseif ($userRole === 'Client'): ?>
            <!-- CLIENT USERS ONLY -->
            <li class="nav-item">
                <a href="coming-soon.php" class="nav-link <?php echo ($currentPage === 'coming-soon.php') ? 'nav-link-active' : ''; ?>">
                    <span class="nav-icon">
                        <img src="images/cart-icon.png" alt="Shopping Cart">
                    </span> 
                    Shopping Cart
                </a>
            </li>
            <li class="nav-item">
                <a href="coming-soon.php" class="nav-link <?php echo ($currentPage === 'coming-soon.php') ? 'nav-link-active' : ''; ?>">
                    <span class="nav-icon">
                        <img src="images/orders-icon.png" alt="My Orders">
                    </span> 
                    My Orders
                </a>
            </li>
            <li class="nav-item">
                <a href="coming-soon.php" class="nav-link <?php echo ($currentPage === 'coming-soon.php') ? 'nav-link-active' : ''; ?>">
                    <span class="nav-icon">
                        <img src="images/profile-icon.png" alt="My Profile">
                    </span> 
                    My Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="coming-soon.php" class="nav-link">
                    <span class="nav-icon">
                        <img src="images/logout-icon.png" alt="Logout">
                    </span> 
                    Logout
                </a>
            </li>
            
        <?php elseif ($userRole === 'Freelancer'): ?>
            <!-- FREELANCER USERS ONLY -->
            <li class="nav-item">
                <a href="coming-soon.php" class="nav-link <?php echo ($currentPage === 'coming-soon.php') ? 'nav-link-active' : ''; ?>">
                    <span class="nav-icon">
                        <img src="images/services-icon.png" alt="My Services">
                    </span> 
                    My Services
                </a>
            </li>
            <li class="nav-item">
                <a href="coming-soon.php" class="nav-link <?php echo ($currentPage === 'coming-soon.php') ? 'nav-link-active' : ''; ?>">
                    <span class="nav-icon">
                        <img src="images/orders-icon.png" alt="My Orders">
                    </span> 
                    My Orders
                </a>
            </li>
            <li class="nav-item">
                <a href="coming-soon.php" class="nav-link <?php echo ($currentPage === 'coming-soon.php') ? 'nav-link-active' : ''; ?>">
                    <span class="nav-icon">
                        <img src="images/profile-icon.png" alt="My Profile">
                    </span> 
                    My Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="coming-soon.php" class="nav-link">
                    <span class="nav-icon">
                        <img src="images/logout-icon.png" alt="Logout">
                    </span> 
                    Logout
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
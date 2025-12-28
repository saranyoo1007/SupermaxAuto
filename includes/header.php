<?php
// Get current theme from database
$currentTheme = 'normal';
try {
    require_once __DIR__ . '/../config/database.php';
    $themeSetting = fetchOne("SELECT setting_value FROM settings WHERE setting_key = 'current_theme'");
    if ($themeSetting) {
        $currentTheme = $themeSetting['setting_value'];
    }
} catch (Exception $e) {
    // Default to normal theme if database error
}
?>
<!DOCTYPE html>
<html lang="th" data-theme="<?php echo $currentTheme; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SuperMax Auto - บริการเปลี่ยนยางรถยนต์ น้ำมันเครื่อง ตั้งศูนย์ล้อ ครบวงจร">
    <meta name="keywords" content="เปลี่ยนยาง, น้ำมันเครื่อง, ตั้งศูนย์ล้อ, ยางรถยนต์, แบตเตอรี่">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'SuperMax Auto'; ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="Photo-Logo/Logo.jpg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="assets/css/styles.css">

    <!-- Theme CSS -->
    <?php if ($currentTheme !== 'normal'): ?>
        <link rel="stylesheet" href="assets/css/themes/theme-<?php echo $currentTheme; ?>.css">
    <?php endif; ?>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="loader"></div>
    </div>

    <!-- Header -->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="index.php" class="logo">
                <img src="Photo-Logo/Logo.jpg" alt="SuperMax Auto Logo" class="logo-img">
                <div class="logo-text">Super<span>Max</span> Auto</div>
            </a>

            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php"
                        class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">หน้าแรก</a>
                </li>
                <li><a href="services.php"
                        class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'active' : ''; ?>">บริการ</a>
                </li>
                <li><a href="products.php"
                        class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : ''; ?>">สินค้า</a>
                </li>
                <li><a href="promotions.php"
                        class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'promotions.php' ? 'active' : ''; ?>">โปรโมชั่น</a>
                </li>
                <li><a href="about.php"
                        class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">เกี่ยวกับเรา</a>
                </li>
                <li><a href="contact.php"
                        class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">ติดต่อเรา</a>
                </li>
                <li class="nav-cta">
                    <a href="tel:0849027778" class="btn btn-primary">
                        <i class="fas fa-phone"></i>
                        โทร 084-902-7778
                    </a>
                </li>
            </ul>

            <div class="mobile-toggle" id="mobileToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>
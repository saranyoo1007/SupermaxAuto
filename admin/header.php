<?php
/**
 * SuperMax Auto Admin - Header Component
 */
require_once 'auth.php';
requireLogin();
require_once '../config/database.php';

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Admin'; ?> - SuperMax Auto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>🔧 SuperMax Auto</h2>
                <small>Admin Panel</small>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="dashboard.php" class="<?php echo $currentPage === 'dashboard.php' ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="products.php"
                        class="<?php echo $currentPage === 'products.php' || $currentPage === 'product-edit.php' ? 'active' : ''; ?>">
                        <i class="fas fa-box"></i> สินค้า
                    </a>
                </li>
                <li>
                    <a href="services.php" class="<?php echo $currentPage === 'services.php' ? 'active' : ''; ?>">
                        <i class="fas fa-wrench"></i> บริการ
                    </a>
                </li>
                <li>
                    <a href="promotions.php" class="<?php echo $currentPage === 'promotions.php' ? 'active' : ''; ?>">
                        <i class="fas fa-gift"></i> โปรโมชั่น
                    </a>
                </li>
                <li>
                    <a href="theme-settings.php"
                        class="<?php echo $currentPage === 'theme-settings.php' ? 'active' : ''; ?>">
                        <i class="fas fa-palette"></i> ตั้งค่าธีม
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
                    </a>
                </li>
            </ul>

            <a href="../index.php" class="back-link" target="_blank">
                <i class="fas fa-external-link-alt"></i> ดูเว็บไซต์
            </a>
        </aside>

        <main class="main-content">
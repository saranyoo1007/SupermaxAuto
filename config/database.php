<?php
/**
 * SuperMax Auto - Database Configuration
 * แก้ไขค่าเหล่านี้ให้ตรงกับ hosting ของคุณ
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'supermax_auto');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// PDO Connection
function getConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

// Helper function to get all rows
function fetchAll($sql, $params = []) {
    $pdo = getConnection();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

// Helper function to get single row
function fetchOne($sql, $params = []) {
    $pdo = getConnection();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch();
}

// Helper function to insert data
function insert($sql, $params = []) {
    $pdo = getConnection();
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($params);
}

// Site configuration
define('SITE_NAME', 'SuperMax Auto');
define('SITE_URL', ''); // ใส่ URL จริงของเว็บไซต์
?>

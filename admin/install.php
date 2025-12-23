<?php
/**
 * SuperMax Auto - Install Admin User
 * 
 * รันไฟล์นี้ครั้งเดียวเพื่อสร้างตาราง admin_users และ user เริ่มต้น
 * หลังจากรันเสร็จให้ลบไฟล์นี้ทิ้ง
 */
require_once '../config/database.php';

echo "<h1>🔧 SuperMax Auto - Admin Setup</h1>";

try {
    $pdo = getConnection();

    // Create admin_users table
    $sql = "CREATE TABLE IF NOT EXISTS admin_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB";

    $pdo->exec($sql);
    echo "<p>✅ สร้างตาราง admin_users เรียบร้อยแล้ว</p>";

    // Check if admin exists
    $stmt = $pdo->query("SELECT COUNT(*) FROM admin_users WHERE username = 'admin'");
    $exists = $stmt->fetchColumn();

    if ($exists == 0) {
        // Create default admin (password: supermax2023)
        $password = password_hash('supermax2023', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
        $stmt->execute(['admin', $password]);
        echo "<p>✅ สร้าง admin user เรียบร้อยแล้ว</p>";
        echo "<p><strong>Username:</strong> admin</p>";
        echo "<p><strong>Password:</strong> supermax2023</p>";
    } else {
        echo "<p>⚠️ Admin user มีอยู่แล้ว</p>";
    }

    echo "<hr>";
    echo "<p style='color: red;'><strong>⚠️ กรุณาลบไฟล์นี้หลังจากติดตั้งเสร็จ!</strong></p>";
    echo "<p><a href='index.php'>➡️ ไปหน้า Admin Login</a></p>";

} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
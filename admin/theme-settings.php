<?php
/**
 * SuperMax Auto Admin - Theme Settings
 * หน้าตั้งค่าธีมเทศกาล
 */
require_once 'auth.php';
requireLogin();
require_once '../config/database.php';

$message = '';
$messageType = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'])) {
    $theme = $_POST['theme'];
    $validThemes = ['normal', 'newyear', 'chinese', 'songkran', 'christmas'];

    if (in_array($theme, $validThemes)) {
        try {
            // Check if setting exists
            $existing = fetchOne("SELECT * FROM settings WHERE setting_key = 'current_theme'");

            if ($existing) {
                execute("UPDATE settings SET setting_value = ? WHERE setting_key = 'current_theme'", [$theme]);
            } else {
                insert("INSERT INTO settings (setting_key, setting_value) VALUES ('current_theme', ?)", [$theme]);
            }

            $message = 'บันทึกธีมสำเร็จ!';
            $messageType = 'success';
        } catch (Exception $e) {
            $message = 'เกิดข้อผิดพลาด: ' . $e->getMessage();
            $messageType = 'error';
        }
    }
}

// Get current theme
$currentTheme = 'normal';
try {
    $setting = fetchOne("SELECT setting_value FROM settings WHERE setting_key = 'current_theme'");
    if ($setting) {
        $currentTheme = $setting['setting_value'];
    }
} catch (Exception $e) {
    // Table might not exist yet
}

// Theme list
$themes = [
    'normal' => [
        'name' => 'ปกติ',
        'icon' => '🏢',
        'desc' => 'ธีมมาตรฐาน สีส้ม/ดำ',
        'color' => '#FF6B00'
    ],
    'newyear' => [
        'name' => 'ปีใหม่',
        'icon' => '🎆',
        'desc' => 'พลุ, ดาว, กระดาษสี',
        'color' => '#FFD700'
    ],
    'chinese' => [
        'name' => 'ตรุษจีน',
        'icon' => '🏮',
        'desc' => 'โคมแดง, อั่งเปา, สีทอง',
        'color' => '#DC143C'
    ],
    'songkran' => [
        'name' => 'สงกรานต์',
        'icon' => '💧',
        'desc' => 'หยดน้ำ, ดอกไม้, สีฟ้า',
        'color' => '#00BCD4'
    ],
    'christmas' => [
        'name' => 'คริสต์มาส',
        'icon' => '🎄',
        'desc' => 'หิมะ, ต้นคริสต์มาส, ของขวัญ',
        'color' => '#228B22'
    ]
];

require_once 'header.php';
?>

<div class="content-header">
    <h1>🎨 ตั้งค่าธีมเทศกาล</h1>
    <p>เลือกธีมที่ต้องการแสดงบนหน้าเว็บไซต์</p>
</div>

<?php if ($message): ?>
    <div class="alert alert-<?php echo $messageType; ?>">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<div class="current-theme-info">
    <h3>ธีมปัจจุบัน: <?php echo $themes[$currentTheme]['icon'] . ' ' . $themes[$currentTheme]['name']; ?></h3>
    <a href="../index.php" target="_blank" class="btn btn-primary">
        <i class="fas fa-external-link-alt"></i> ดูตัวอย่างหน้าเว็บ
    </a>
</div>

<form method="POST" class="theme-form">
    <div class="theme-grid">
        <?php foreach ($themes as $key => $theme): ?>
            <label class="theme-card <?php echo $key === $currentTheme ? 'active' : ''; ?>">
                <input type="radio" name="theme" value="<?php echo $key; ?>" <?php echo $key === $currentTheme ? 'checked' : ''; ?>>
                <div class="theme-preview"
                    style="background: <?php echo $theme['color']; ?>20; border-color: <?php echo $theme['color']; ?>">
                    <div class="theme-icon"><?php echo $theme['icon']; ?></div>
                    <h4><?php echo $theme['name']; ?></h4>
                    <p><?php echo $theme['desc']; ?></p>
                    <?php if ($key === $currentTheme): ?>
                        <span class="current-badge">กำลังใช้งาน</span>
                    <?php endif; ?>
                </div>
            </label>
        <?php endforeach; ?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fas fa-save"></i> บันทึกการเปลี่ยนแปลง
        </button>
    </div>
</form>

<style>
    .content-header {
        margin-bottom: 30px;
    }

    .content-header h1 {
        margin-bottom: 10px;
    }

    .content-header p {
        color: var(--gray);
    }

    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: rgba(0, 200, 83, 0.15);
        color: #00c853;
        border: 1px solid rgba(0, 200, 83, 0.3);
    }

    .alert-error {
        background: rgba(255, 82, 82, 0.15);
        color: #ff5252;
        border: 1px solid rgba(255, 82, 82, 0.3);
    }

    .current-theme-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--dark-light);
        padding: 20px 25px;
        border-radius: 12px;
        margin-bottom: 30px;
        border: 1px solid var(--primary);
    }

    .current-theme-info h3 {
        margin: 0;
    }

    .theme-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .theme-card {
        cursor: pointer;
    }

    .theme-card input[type="radio"] {
        display: none;
    }

    .theme-preview {
        padding: 25px;
        border-radius: 16px;
        border: 3px solid transparent;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
    }

    .theme-card:hover .theme-preview {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .theme-card.active .theme-preview,
    .theme-card input:checked+.theme-preview {
        border-color: var(--primary);
        box-shadow: 0 0 20px rgba(255, 107, 0, 0.3);
    }

    .theme-icon {
        font-size: 50px;
        margin-bottom: 15px;
    }

    .theme-preview h4 {
        margin-bottom: 8px;
        font-size: 1.2rem;
    }

    .theme-preview p {
        color: var(--gray);
        font-size: 0.9rem;
        margin: 0;
    }

    .current-badge {
        display: inline-block;
        background: var(--primary);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        margin-top: 12px;
    }

    .form-actions {
        text-align: center;
    }

    .btn-lg {
        padding: 15px 40px;
        font-size: 1.1rem;
    }
</style>

<?php require_once 'footer.php'; ?>
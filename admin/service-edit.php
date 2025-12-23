<?php
/**
 * SuperMax Auto Admin - Service Edit
 */
$pageTitle = 'แก้ไขบริการ';
require_once 'header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$isEdit = $id > 0;
$service = null;
$error = '';

// If editing, get service data
if ($isEdit) {
    $service = fetchOne("SELECT * FROM services WHERE id = ?", [$id]);
    if (!$service) {
        header('Location: services.php');
        exit;
    }
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price_start = (float) ($_POST['price_start'] ?? 0);
    $price_end = (float) ($_POST['price_end'] ?? 0);
    $duration = trim($_POST['duration'] ?? '');
    $icon = trim($_POST['icon'] ?? '');
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;

    if (empty($name)) {
        $error = 'กรุณากรอกชื่อบริการ';
    }

    if (empty($error)) {
        $pdo = getConnection();

        if ($isEdit) {
            $sql = "UPDATE services SET 
                    name = ?, description = ?, price_start = ?, price_end = ?, 
                    duration = ?, icon = ?, is_featured = ?
                    WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $name,
                $description,
                $price_start,
                $price_end,
                $duration,
                $icon,
                $is_featured,
                $id
            ]);
        } else {
            $sql = "INSERT INTO services (name, description, price_start, price_end, 
                    duration, icon, is_featured) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $name,
                $description,
                $price_start,
                $price_end,
                $duration,
                $icon,
                $is_featured
            ]);
        }

        header('Location: services.php?success=1');
        exit;
    }
}
?>

<div class="page-header">
    <h1><?php echo $isEdit ? '✏️ แก้ไขบริการ' : '➕ เพิ่มบริการ'; ?></h1>
</div>

<?php if ($error): ?>
    <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<div class="form-card">
    <form method="POST">
        <div class="form-group">
            <label for="name">ชื่อบริการ *</label>
            <input type="text" id="name" name="name" required
                value="<?php echo htmlspecialchars($service['name'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="description">รายละเอียด</label>
            <textarea id="description"
                name="description"><?php echo htmlspecialchars($service['description'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label for="price_start">💰 ราคาเริ่มต้น (บาท)</label>
            <input type="number" id="price_start" name="price_start" step="0.01"
                value="<?php echo $service['price_start'] ?? 0; ?>">
        </div>

        <div class="form-group">
            <label for="price_end">💰 ราคาสูงสุด (บาท)</label>
            <input type="number" id="price_end" name="price_end" step="0.01"
                value="<?php echo $service['price_end'] ?? 0; ?>">
        </div>

        <div class="form-group">
            <label for="duration">ระยะเวลา</label>
            <input type="text" id="duration" name="duration" placeholder="เช่น 30-60 นาที"
                value="<?php echo htmlspecialchars($service['duration'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="icon">Icon (Font Awesome)</label>
            <input type="text" id="icon" name="icon" placeholder="เช่น fa-wrench"
                value="<?php echo htmlspecialchars($service['icon'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_featured" value="1" <?php echo ($service['is_featured'] ?? 0) ? 'checked' : ''; ?>>
                แสดงในหน้าแรก (Featured)
            </label>
        </div>

        <div class="form-actions">
            <a href="services.php" class="btn btn-secondary">ยกเลิก</a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> บันทึก
            </button>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>
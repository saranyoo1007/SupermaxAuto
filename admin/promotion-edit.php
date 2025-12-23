<?php
/**
 * SuperMax Auto Admin - Promotion Edit
 */
$pageTitle = 'แก้ไขโปรโมชั่น';
require_once 'header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$isEdit = $id > 0;
$promo = null;
$error = '';

// If editing, get promotion data
if ($isEdit) {
    $promo = fetchOne("SELECT * FROM promotions WHERE id = ?", [$id]);
    if (!$promo) {
        header('Location: promotions.php');
        exit;
    }
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $discount_percent = (int) ($_POST['discount_percent'] ?? 0);
    $discount_amount = (float) ($_POST['discount_amount'] ?? 0);
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    if (empty($title)) {
        $error = 'กรุณากรอกชื่อโปรโมชั่น';
    }

    if (empty($error)) {
        $pdo = getConnection();

        if ($isEdit) {
            $sql = "UPDATE promotions SET 
                    title = ?, description = ?, discount_percent = ?, discount_amount = ?, 
                    start_date = ?, end_date = ?, is_active = ?
                    WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $title,
                $description,
                $discount_percent,
                $discount_amount,
                $start_date,
                $end_date,
                $is_active,
                $id
            ]);
        } else {
            $sql = "INSERT INTO promotions (title, description, discount_percent, discount_amount, 
                    start_date, end_date, is_active) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $title,
                $description,
                $discount_percent,
                $discount_amount,
                $start_date,
                $end_date,
                $is_active
            ]);
        }

        header('Location: promotions.php?success=1');
        exit;
    }
}
?>

<div class="page-header">
    <h1><?php echo $isEdit ? '✏️ แก้ไขโปรโมชั่น' : '➕ เพิ่มโปรโมชั่น'; ?></h1>
</div>

<?php if ($error): ?>
    <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<div class="form-card">
    <form method="POST">
        <div class="form-group">
            <label for="title">ชื่อโปรโมชั่น *</label>
            <input type="text" id="title" name="title" required
                value="<?php echo htmlspecialchars($promo['title'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="description">รายละเอียด</label>
            <textarea id="description"
                name="description"><?php echo htmlspecialchars($promo['description'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label for="discount_percent">ส่วนลด (%)</label>
            <input type="number" id="discount_percent" name="discount_percent" min="0" max="100"
                value="<?php echo $promo['discount_percent'] ?? 0; ?>">
        </div>

        <div class="form-group">
            <label for="discount_amount">ส่วนลด (บาท)</label>
            <input type="number" id="discount_amount" name="discount_amount" step="0.01"
                value="<?php echo $promo['discount_amount'] ?? 0; ?>">
        </div>

        <div class="form-group">
            <label for="start_date">วันที่เริ่มต้น</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo $promo['start_date'] ?? ''; ?>">
        </div>

        <div class="form-group">
            <label for="end_date">วันที่สิ้นสุด</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo $promo['end_date'] ?? ''; ?>">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" <?php echo ($promo['is_active'] ?? 1) ? 'checked' : ''; ?>>
                เปิดใช้งาน (Active)
            </label>
        </div>

        <div class="form-actions">
            <a href="promotions.php" class="btn btn-secondary">ยกเลิก</a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> บันทึก
            </button>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>
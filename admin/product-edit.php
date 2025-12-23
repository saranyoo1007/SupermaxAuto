<?php
/**
 * SuperMax Auto Admin - Product Edit
 */
$pageTitle = 'แก้ไขสินค้า';
require_once 'header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$isEdit = $id > 0;
$product = null;
$error = '';
$success = '';

// Get categories for dropdown
$categories = fetchAll("SELECT * FROM categories ORDER BY name");

// If editing, get product data
if ($isEdit) {
    $product = fetchOne("SELECT * FROM products WHERE id = ?", [$id]);
    if (!$product) {
        header('Location: products.php');
        exit;
    }
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $brand = trim($_POST['brand'] ?? '');
    $category_id = (int) ($_POST['category_id'] ?? 0);
    $price = (float) ($_POST['price'] ?? 0);
    $original_price = (float) ($_POST['original_price'] ?? 0);
    $specs = trim($_POST['specs'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $stock = (int) ($_POST['stock'] ?? 0);

    // Handle image upload
    $image = $isEdit ? $product['image'] : '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/uploads/';
        $fileExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($fileExt, $allowedTypes)) {
            $newFilename = 'product_' . time() . '_' . uniqid() . '.' . $fileExt;
            $uploadPath = $uploadDir . $newFilename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                // Delete old image if exists
                if ($image && file_exists('../' . $image)) {
                    unlink('../' . $image);
                }
                $image = 'assets/uploads/' . $newFilename;
            } else {
                $error = 'ไม่สามารถอัปโหลดรูปภาพได้';
            }
        } else {
            $error = 'รูปแบบไฟล์ไม่ถูกต้อง (รองรับ: jpg, png, gif, webp)';
        }
    }

    if (empty($name)) {
        $error = 'กรุณากรอกชื่อสินค้า';
    }

    if (empty($error)) {
        $pdo = getConnection();

        if ($isEdit) {
            // Update
            $sql = "UPDATE products SET 
                    name = ?, brand = ?, category_id = ?, price = ?, original_price = ?, 
                    specs = ?, description = ?, is_featured = ?, stock = ?, image = ?
                    WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $name,
                $brand,
                $category_id,
                $price,
                $original_price,
                $specs,
                $description,
                $is_featured,
                $stock,
                $image,
                $id
            ]);
        } else {
            // Insert
            $sql = "INSERT INTO products (name, brand, category_id, price, original_price, 
                    specs, description, is_featured, stock, image) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $name,
                $brand,
                $category_id,
                $price,
                $original_price,
                $specs,
                $description,
                $is_featured,
                $stock,
                $image
            ]);
        }

        header('Location: products.php?success=1');
        exit;
    }
}
?>

<div class="page-header">
    <h1><?php echo $isEdit ? '✏️ แก้ไขสินค้า' : '➕ เพิ่มสินค้า'; ?></h1>
</div>

<?php if ($error): ?>
    <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<div class="form-card">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">ชื่อสินค้า *</label>
            <input type="text" id="name" name="name" required
                value="<?php echo htmlspecialchars($product['name'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="brand">แบรนด์</label>
            <input type="text" id="brand" name="brand" value="<?php echo htmlspecialchars($product['brand'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="category_id">หมวดหมู่</label>
            <select id="category_id" name="category_id">
                <option value="">-- เลือกหมวดหมู่ --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php echo ($product['category_id'] ?? 0) == $cat['id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="price">💰 ราคาขาย (บาท) *</label>
            <input type="number" id="price" name="price" step="0.01" required
                value="<?php echo $product['price'] ?? 0; ?>">
        </div>

        <div class="form-group">
            <label for="original_price">💵 ราคาเดิม (บาท)</label>
            <input type="number" id="original_price" name="original_price" step="0.01"
                value="<?php echo $product['original_price'] ?? 0; ?>">
        </div>

        <div class="form-group">
            <label for="specs">Specs</label>
            <input type="text" id="specs" name="specs" placeholder="เช่น 195/65R15"
                value="<?php echo htmlspecialchars($product['specs'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="description">รายละเอียด</label>
            <textarea id="description"
                name="description"><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label for="stock">จำนวนในสต็อก</label>
            <input type="number" id="stock" name="stock" value="<?php echo $product['stock'] ?? 0; ?>">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_featured" value="1" <?php echo ($product['is_featured'] ?? 0) ? 'checked' : ''; ?>>
                แสดงในหน้าแรก (Featured)
            </label>
        </div>

        <div class="form-group">
            <label for="image">📷 รูปสินค้า</label>
            <input type="file" id="image" name="image" accept="image/*">

            <?php if (!empty($product['image'])): ?>
                <div class="current-image">
                    <p style="margin-top: 10px; color: var(--light-gray); font-size: 0.85rem;">รูปปัจจุบัน:</p>
                    <img src="../<?php echo htmlspecialchars($product['image']); ?>" alt="">
                </div>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <a href="products.php" class="btn btn-secondary">ยกเลิก</a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> บันทึก
            </button>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>
<?php
require_once 'config.php';
checkAuth();

$msg = '';

// จัดการลบข่าว
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: news_manage.php");
    exit;
}

// จัดการเพิ่มข่าวใหม่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_news') {
    $title = trim($_POST['title'] ?? '');
    $category = $_POST['category'] ?? 'general';
    $detail = trim($_POST['detail'] ?? '');

    if (!empty($title) && !empty($detail)) {
        $stmt = $conn->prepare("INSERT INTO news (title, category, detail) VALUES (?, ?, ?)");
        $stmt->execute([$title, $category, $detail]);
        $msg = "เพิ่มข่าวสารสำเร็จเรียบร้อยแล้ว";
    }
}

// ดึงรายการข่าวทั้งหมด
$news_list = $conn->query("SELECT * FROM news ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข่าวสาร & กิจกรรม | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include 'sidebar.php'; ?>

    <main>
        <h2>จัดการข่าวประชาสัมพันธ์ & กิจกรรม</h2>

        <?php if (!empty($msg)): ?>
            <div class="alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo $msg; ?></div>
        <?php endif; ?>

        <!-- Form Add News -->
        <div class="card">
            <h3><i class="fa-solid fa-plus-circle"></i> เพิ่มประกาศข่าวสารใหม่</h3>
            <form method="POST">
                <input type="hidden" name="action" value="add_news">
                <div class="form-row">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>หัวข้อข่าวสาร / กิจกรรม *</label>
                        <input type="text" name="title" placeholder="เช่น กิจกรรมวันไหว้ครู ประจำปี 2569" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>หมวดหมู่ข่าว *</label>
                        <select name="category">
                            <option value="general">ข่าวประชาสัมพันธ์ทั่วไป</option>
                            <option value="academic">วิชาการ</option>
                            <option value="activity">ภาพกิจกรรม</option>
                            <option value="pride">ความภาคภูมิใจ</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 16px;">
                    <label>รายละเอียดเนื้อหาข่าว *</label>
                    <textarea name="detail" rows="4" placeholder="พิมพ์รายละเอียดเนื้อหาข่าวสาร..." required></textarea>
                </div>

                <button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane"></i> เผยแพร่ประกาศ</button>
            </form>
        </div>

        <!-- News Table List -->
        <div class="card">
            <h3><i class="fa-solid fa-list"></i> รายการข่าวสารทั้งหมดในระบบ (<?php echo count($news_list); ?> รายการ)</h3>
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>หัวข้อข่าว</th>
                        <th style="width: 140px;">หมวดหมู่</th>
                        <th style="width: 130px;">วันที่ลงประกาศ</th>
                        <th style="width: 90px; text-align: center;">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($news_list) > 0): ?>
                        <?php foreach ($news_list as $news): ?>
                            <tr>
                                <td>#<?php echo $news['id']; ?></td>
                                <td><strong><?php echo htmlspecialchars($news['title']); ?></strong></td>
                                <td><span style="background: var(--light-green); color: var(--primary-green); padding: 3px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 600;"><?php echo htmlspecialchars($news['category']); ?></span></td>
                                <td><?php echo date('d/m/Y', strtotime($news['created_at'])); ?></td>
                                <td style="text-align: center;">
                                    <a href="news_manage.php?delete=<?php echo $news['id']; ?>" class="btn-del" onclick="return confirm('ยืนยันว่าต้องการลบข่าวนี้ใช่หรือไม่?')"><i class="fa-solid fa-trash"></i> ลบ</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" style="text-align: center; color: var(--text-sub);">ยังไม่มีข้อมูลข่าวสารในระบบ</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
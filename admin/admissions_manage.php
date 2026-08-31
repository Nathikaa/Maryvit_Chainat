<?php
require_once 'config.php';
checkAuth();

$msg = '';

// อัปเดตสถานะผู้สมัคร
if (isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $adm_id = intval($_POST['adm_id'] ?? 0);
    $status = $_POST['status'] ?? 'pending';

    if ($adm_id > 0) {
        $stmt = $conn->prepare("UPDATE admissions SET status = ? WHERE id = ?");
        $stmt->execute([$status, $adm_id]);
        $msg = "อัปเดตสถานะผู้สมัครเรียบร้อยแล้ว";
    }
}

// ลบรายการผู้สมัคร
if (isset($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM admissions WHERE id = ?");
    $stmt->execute([$del_id]);
    header("Location: admissions_manage.php");
    exit;
}

// ตัวกรองตามระดับชั้น
$filter_grade = $_GET['grade'] ?? 'all';
if ($filter_grade !== 'all' && !empty($filter_grade)) {
    $stmt = $conn->prepare("SELECT * FROM admissions WHERE grade_level LIKE ? ORDER BY id DESC");
    $stmt->execute(["%$filter_grade%"]);
    $admissions_list = $stmt->fetchAll();
} else {
    $admissions_list = $conn->query("SELECT * FROM admissions ORDER BY id DESC")->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการรายชื่อผู้สมัครเรียน | Admin โรงเรียนมารีวิทย์ ชัยนาท</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include 'sidebar.php'; ?>
   

    <main>
        <h2>จัดการข้อมูลผู้สมัครเรียนออนไลน์</h2>

        <?php if (!empty($msg)): ?>
            <div class="alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo $msg; ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="filter-bar" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 16px;">
        <h3 style="color: var(--primary-green); font-size: 1.1rem; margin-bottom: 0; display: flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-list-check"></i> รายชื่อผู้สมัคร (<?php echo count($admissions_list); ?> รายการ)
        </h3>

        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
        <!-- ฟอร์มกรองระดับชั้น -->
        <form method="GET" style="display: flex; align-items: center; gap: 8px; margin: 0;">
            <label style="font-size: 0.88rem; color: var(--text-sub); white-space: nowrap;">กรองตามระดับชั้น:</label>
            <select name="grade" class="filter-select" onchange="this.form.submit()" style="padding: 8px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.9rem; outline: none; background: #fff;">
                <option value="all" <?php echo $filter_grade === 'all' ? 'selected' : ''; ?>>ทั้งหมดทุกระดับชั้น</option>
                <option value="ปฐมวัย" <?php echo $filter_grade === 'ปฐมวัย' ? 'selected' : ''; ?>>แผนกปฐมวัย</option>
                <option value="ประถมศึกษา" <?php echo $filter_grade === 'ประถมศึกษา' ? 'selected' : ''; ?>>แผนกประถมศึกษา</option>
                <option value="มัธยมศึกษาตอนต้น" <?php echo $filter_grade === 'มัธยมศึกษาตอนต้น' ? 'selected' : ''; ?>>มัธยมศึกษาตอนต้น</option>
                <option value="มัธยมศึกษาตอนปลาย" <?php echo $filter_grade === 'มัธยมศึกษาตอนปลาย' ? 'selected' : ''; ?>>มัธยมศึกษาตอนปลาย</option>
            </select>
        </form>

        <!-- ปุ่มส่งออกข้อมูล Excel / CSV (วางเรียงแถวเดียวกัน) -->
        <a href="export_admissions.php" style="display: inline-flex; align-items: center; gap: 8px; background: #0B6623; color: #fff; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 0.88rem; font-weight: 600; white-space: nowrap; transition: 0.2s; box-shadow: 0 2px 6px rgba(11,102,35,0.2);">
            <i class="fa-solid fa-file-excel"></i> ส่งออกข้อมูล (Excel/CSV)
        </a>
        </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>ชื่อ-นามสกุล นักเรียน</th>
                        <th>ระดับชั้นที่สมัคร</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>LINE ID</th>
                        <th>สถานะการสมัคร</th>
                        <th style="width: 140px;">วันที่สมัคร</th>
                        <th style="width: 100px; text-align: center;">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($admissions_list) > 0): ?>
                        <?php foreach ($admissions_list as $adm): ?>
                            <tr>
                                <td>#<?php echo $adm['id']; ?></td>
                                <td><strong><?php echo htmlspecialchars($adm['student_name']); ?></strong></td>
                                <td><?php echo htmlspecialchars($adm['grade_level']); ?></td>
                                <td>
                                    <a href="tel:<?php echo htmlspecialchars($adm['parent_phone']); ?>" style="color: var(--primary-green); font-weight: 600; text-decoration: none;">
                                        <i class="fa-solid fa-phone"></i> <?php echo htmlspecialchars($adm['parent_phone']); ?>
                                    </a>
                                </td>
                                <td><?php echo !empty($adm['parent_line']) ? htmlspecialchars($adm['parent_line']) : '-'; ?></td>
                                <td>
                                    <form method="POST" style="margin: 0;">
                                        <input type="hidden" name="action" value="update_status">
                                        <input type="hidden" name="adm_id" value="<?php echo $adm['id']; ?>">
                                        <select name="status" class="status-select status-<?php echo $adm['status']; ?>" onchange="this.form.submit()">
                                            <option value="pending" <?php echo $adm['status'] === 'pending' ? 'selected' : ''; ?>>รอดำเนินการ</option>
                                            <option value="contacted" <?php echo $adm['status'] === 'contacted' ? 'selected' : ''; ?>>ติดต่อแล้ว</option>
                                            <option value="approved" <?php echo $adm['status'] === 'approved' ? 'selected' : ''; ?>>ยืนยันสิทธิ์แล้ว</option>
                                            <option value="rejected" <?php echo $adm['status'] === 'rejected' ? 'selected' : ''; ?>>สละสิทธิ์/ไม่ผ่าน</option>
                                        </select>
                                    </form>
                                </td>
                                <td><?php echo date('d/m/Y H:i', strtotime($adm['created_at'])); ?></td>
                                <td style="text-align: center;">
                                    <a href="admissions_manage.php?delete=<?php echo $adm['id']; ?>" class="btn-del" onclick="return confirm('ต้องการลบข้อมูลผู้สมัครรายนี้หรือไม่?')">
                                        <i class="fa-solid fa-trash-can"></i> ลบ
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8" style="text-align: center; color: var(--text-sub); padding: 30px;">ไม่พบข้อมูลผู้สมัครเรียนในเงื่อนไขที่เลือก</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
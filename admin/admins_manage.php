<?php
require_once 'config.php';
checkAuth();

// ตรวจสอบสิทธิ์ Superadmin
$is_superadmin = (
    (isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'superadmin') ||
    (isset($_SESSION['admin_user']) && $_SESSION['admin_user'] === 'admin')
);

if (!$is_superadmin) {
    header("Location: dashboard.php");
    exit;
}

$msg = '';
$error = '';

// เพิ่มสมาชิก Admin ใหม่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_admin') {
    $username = trim($_POST['username'] ?? '');
    $fullname = trim($_POST['fullname'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role     = trim($_POST['role'] ?? 'admin');

    if (!empty($username) && !empty($fullname) && !empty($password)) {
        // เช็คว่า Username ซ้ำไหม
        $stmtCheck = $conn->prepare("SELECT id FROM admins WHERE username = ?");
        $stmtCheck->execute([$username]);
        if ($stmtCheck->rowCount() > 0) {
            $error = "ชื่อผู้ใช้นี้ (Username) มีอยู่ในระบบแล้ว กรุณาใช้ชื่ออื่น";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO admins (username, password, fullname, role) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $hash, $fullname, $role]);
            $msg = "เพิ่มผู้ดูแลระบบเรียบร้อยแล้ว";
        }
    } else {
        $error = "กรุณากรอกข้อมูลให้ครบทุกช่อง";
    }
}

// ลบสมาชิก Admin (ป้องกันไม่ให้ลบตัวเอง)
if (isset($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    if ($del_id === intval($_SESSION['admin_id'])) {
        $error = "คุณไม่สามารถลบบัญชีของตัวเองที่กำลังใช้งานอยู่ได้";
    } else {
        $stmt = $conn->prepare("DELETE FROM admins WHERE id = ?");
        $stmt->execute([$del_id]);
        header("Location: admins_manage.php");
        exit;
    }
}

// ดึงรายการ Admin ทั้งหมด
$admins_list = $conn->query("SELECT * FROM admins ORDER BY id ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการสมาชิกผู้ดูแลระบบ | SuperAdmin โรงเรียนมารีวิทย์ ชัยนาท</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <main>
        <h2>จัดการสมาชิกผู้ดูแลระบบ (Admin Users Management)</h2>

        <?php if (!empty($msg)): ?>
            <div class="alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo $msg; ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert-error"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Form Add New Admin -->
        <div class="card">
            <h3><i class="fa-solid fa-user-plus"></i> เพิ่มผู้ดูแลระบบคนใหม่</h3>
            <form method="POST">
                <input type="hidden" name="action" value="add_admin">
                <div class="form-grid">
                    <div class="form-group">
                        <label>ชื่อผู้ใช้งาน (Username) *</label>
                        <input type="text" name="username" placeholder="เช่น teacher_jane" required>
                    </div>
                    <div class="form-group">
                        <label>ชื่อ-นามสกุล จริง *</label>
                        <input type="text" name="fullname" placeholder="เช่น น.ส.เจนจิรา มีสุข" required>
                    </div>
                    <div class="form-group">
                        <label>รหัสผ่านเข้าใช้งาน *</label>
                        <input type="password" name="password" placeholder="กำหนดรหัสผ่าน" required>
                    </div>
                    <div class="form-group">
                        <label>ระดับสิทธิ์ *</label>
                        <select name="role">
                            <option value="admin">Admin (ผู้ดูแลทั่วไป)</option>
                            <option value="superadmin">SuperAdmin (ผู้ดูแลระบบสูงสุด)</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn-submit"><i class="fa-solid fa-plus"></i> บันทึกและสร้างบัญชี</button>
            </form>
        </div>

        <!-- Admins Table List -->
        <div class="card">
            <h3><i class="fa-solid fa-users-gear"></i> รายชื่อผู้ดูแลระบบทั้งหมด (<?php echo count($admins_list); ?> คน)</h3>
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>ชื่อผู้ใช้งาน (Username)</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th style="width: 140px; text-align: center;">ระดับสิทธิ์</th>
                        <th style="width: 160px;">วันที่สร้างบัญชี</th>
                        <th style="width: 90px; text-align: center;">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins_list as $user): ?>
                        <?php 
                            // เช็คและกำหนดค่าสิทธิ์ให้อัตโนมัติหากใน DB เป็นค่าว่าง
                            $userRole = !empty($user['role']) ? strtolower($user['role']) : ($user['username'] === 'admin' ? 'superadmin' : 'admin');
                        ?>
                        <tr>
                            <td>#<?php echo $user['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($user['username']); ?></strong></td>
                            <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                            <td style="text-align: center;">
                                <span class="badge-role <?php echo ($userRole === 'superadmin') ? 'role-superadmin' : 'role-admin'; ?>">
                                    <?php echo strtoupper($userRole); ?>
                                </span>
                            </td>
                            <td><?php echo date('d/m/Y H:i', strtotime($user['created_at'])); ?></td>
                            <td style="text-align: center;">
                                <?php if ($user['id'] != $_SESSION['admin_id']): ?>
                                    <a href="admins_manage.php?delete=<?php echo $user['id']; ?>" class="btn-del" onclick="return confirm('ยืนยันว่าต้องการลบบัญชีผู้ใช้นี้ใช่หรือไม่?')">
                                        <i class="fa-solid fa-trash-can"></i> ลบ
                                    </a>
                                <?php else: ?>
                                    <span style="font-size: 0.78rem; color: var(--text-sub); font-weight: 500;">กำลังใช้งาน</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
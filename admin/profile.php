<?php
require_once 'config.php';
checkAuth();

$msg = '';
$error = '';

$admin_id = $_SESSION['admin_id'];

// บันทึกการเปลี่ยนรหัสผ่าน
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_profile') {
    $fullname = trim($_POST['fullname'] ?? '');
    $old_pass = trim($_POST['old_password'] ?? '');
    $new_pass = trim($_POST['new_password'] ?? '');
    $confirm_pass = trim($_POST['confirm_password'] ?? '');

    // ดึงข้อมูลแอดมินปัจจุบัน
    $stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
    $stmt->execute([$admin_id]);
    $current_admin = $stmt->fetch();

    if (!empty($fullname)) {
        // อัปเดตชื่อผู้ใช้งาน
        $updateName = $conn->prepare("UPDATE admins SET fullname = ? WHERE id = ?");
        $updateName->execute([$fullname, $admin_id]);
        $_SESSION['admin_name'] = $fullname;
        $msg = "อัปเดตข้อมูลส่วนตัวเรียบร้อยแล้ว";

        // กรณีต้องการเปลี่ยนรหัสผ่านด้วย
        if (!empty($old_pass) || !empty($new_pass)) {
            if (password_verify($old_pass, $current_admin['password'])) {
                if (strlen($new_pass) >= 6) {
                    if ($new_pass === $confirm_pass) {
                        $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
                        $updatePass = $conn->prepare("UPDATE admins SET password = ? WHERE id = ?");
                        $updatePass->execute([$new_hash, $admin_id]);
                        $msg = "เปลี่ยนรหัสผ่านสำเร็จเรียบร้อยแล้ว";
                    } else {
                        $error = "รหัสผ่านใหม่และการยืนยันรหัสผ่านไม่ตรงกัน";
                    }
                } else {
                    $error = "รหัสผ่านใหม่ต้องมีความยาวอย่างน้อย 6 ตัวอักษร";
                }
            } else {
                $error = "รหัสผ่านปัจจุบันไม่ถูกต้อง";
            }
        }
    } else {
        $error = "กรุณากรอกชื่อ-นามสกุล";
    }
}

// ดึงข้อมูลล่าสุดมาแสดง
$stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าบัญชีผู้ใช้ | Admin โรงเรียนมารีวิทย์ ชัยนาท</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <main>
       <div class="profile-wrapper" style="max-width: 600px; margin: 0 auto;">
            
            <div class="page-title-box">
                <h2>ตั้งค่าบัญชีผู้ใช้งาน</h2>
                <p>จัดการข้อมูลส่วนตัวและเปลี่ยนรหัสผ่านเพื่อความปลอดภัย</p>
            </div>

            <?php if (!empty($msg)): ?>
                <div class="alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo $msg; ?></div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert-error"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?></div>
            <?php endif; ?>

            <div class="card">
                <div class="profile-avatar-circle">
                    <i class="fa-solid fa-user-shield"></i>
                </div>

                <form method="POST">
                    <input type="hidden" name="action" value="update_profile">

                    <div class="form-group">
                        <label><i class="fa-solid fa-id-badge"></i> ชื่อผู้ใช้งาน (Username)</label>
                        <input type="text" value="<?php echo htmlspecialchars($admin['username']); ?>" disabled>
                        <small style="color: var(--text-sub); font-size: 0.78rem;">* สิทธิ์ระดับ: <?php echo htmlspecialchars($admin['role']); ?> (ไม่สามารถเปลี่ยน Username ได้)</small>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-user-tag"></i> ชื่อ-นามสกุล ที่แสดงในระบบ *</label>
                        <input type="text" name="fullname" value="<?php echo htmlspecialchars($admin['fullname']); ?>" required>
                    </div>

                    <div class="divider"></div>
                    <h4 style="color: var(--primary-green); margin-bottom: 14px; font-size: 1.05rem;">
                        <i class="fa-solid fa-key"></i> เปลี่ยนรหัสผ่านเข้าสู่ระบบ
                    </h4>

                    <div class="form-group">
                        <label>รหัสผ่านปัจจุบัน</label>
                        <input type="password" name="old_password" placeholder="กรอกรหัสผ่านเดิมเพื่อยืนยัน">
                    </div>

                    <div class="form-group">
                        <label>รหัสผ่านใหม่ (อย่างน้อย 6 ตัวอักษร)</label>
                        <input type="password" name="new_password" placeholder="กรอกรหัสผ่านใหม่">
                    </div>

                    <div class="form-group">
                        <label>ยืนยันรหัสผ่านใหม่อีกครั้ง</label>
                        <input type="password" name="confirm_password" placeholder="พิมพ์รหัสผ่านใหม่อีกครั้ง">
                    </div>

                   <div style="text-align: center; margin-top: 20px;">
                        <button type="submit" class="btn-submit" style="padding: 12px 36px;">
                        <i class="fa-solid fa-floppy-disk"></i> บันทึกการเปลี่ยนแปลง
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>

</body>
</html>
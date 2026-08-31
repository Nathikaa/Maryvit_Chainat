<?php
$current_admin_page = basename($_SERVER['PHP_SELF']);

// ให้สิทธิ์ถ้าเป็น role 'superadmin' หรือถ้า username คือ 'admin'
$is_superadmin = (
    (isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'superadmin') ||
    (isset($_SESSION['admin_user']) && $_SESSION['admin_user'] === 'admin')
);
?>
<!-- Reusable Admin Sidebar -->
<aside>
    <div class="side-brand">
        <div class="side-emblem">M</div>
        <div class="side-brand-title">
            <h3>โรงเรียนมารีวิทย์ชัยนาท</h3>
            <span>Admin Management</span>
        </div>
    </div>

    <nav class="side-nav">
        <a href="dashboard.php" class="nav-link-btn <?php echo ($current_admin_page === 'dashboard.php') ? 'active' : ''; ?>">
            <i class="fa-solid fa-chart-pie"></i> ภาพรวม (Dashboard)
        </a>
        <a href="news_manage.php" class="nav-link-btn <?php echo ($current_admin_page === 'news_manage.php') ? 'active' : ''; ?>">
            <i class="fa-solid fa-newspaper"></i> จัดการข่าวสาร & กิจกรรม
        </a>
        <a href="admissions_manage.php" class="nav-link-btn <?php echo ($current_admin_page === 'admissions_manage.php') ? 'active' : ''; ?>">
            <i class="fa-solid fa-user-graduate"></i> ข้อมูลผู้สมัครเรียน
        </a>
        <a href="tickets_manage.php" class="nav-link-btn <?php echo ($current_admin_page === 'tickets_manage.php') ? 'active' : ''; ?>">
            <i class="fa-solid fa-headset"></i> เรื่องติดต่อสอบถาม
        </a>

        <!-- แสดงเฉพาะ Superadmin -->
        <?php if ($is_superadmin): ?>
        <a href="admins_manage.php" class="nav-link-btn <?php echo ($current_admin_page === 'admins_manage.php') ? 'active' : ''; ?>">
            <i class="fa-solid fa-users-gear"></i> จัดการสมาชิก Admin
        </a>
        <?php endif; ?>

        <a href="profile.php" class="nav-link-btn <?php echo ($current_admin_page === 'profile.php') ? 'active' : ''; ?>">
            <i class="fa-solid fa-user-gear"></i> ตั้งค่าบัญชี
        </a>

        <a href="../index.php" target="_blank" class="nav-link-btn">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> ไปที่หน้าเว็บจริง
        </a>
        <a href="logout.php" class="nav-link-btn btn-logout" style="color: #fca5a5; margin-top: auto;">
            <i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ
        </a>
    </nav>
</aside>
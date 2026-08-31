<?php
require_once 'config.php';
checkAuth();

// ดึงสถิติต่างๆ
$news_count = $conn->query("SELECT COUNT(*) FROM news")->fetchColumn();
$admissions_pending = $conn->query("SELECT COUNT(*) FROM admissions WHERE status = 'pending'")->fetchColumn();
$tickets_new = $conn->query("SELECT COUNT(*) FROM contact_tickets WHERE status = 'new'")->fetchColumn();

// ดึงข้อมูล 5 รายการล่าสุด
$latest_tickets = $conn->query("SELECT * FROM contact_tickets ORDER BY id DESC LIMIT 5")->fetchAll();
$latest_admissions = $conn->query("SELECT * FROM admissions ORDER BY id DESC LIMIT 5")->fetchAll();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แดชบอร์ด | ระบบจัดการข้อมูล โรงเรียนมารีวิทย์ชัยนาท</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">    
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <main>
        <div class="top-header">
            <div>
                <h2>แผงควบคุมระบบ (Dashboard)</h2>
                <p>ยินดีต้อนรับเข้าสู่ระบบจัดการข้อมูล โรงเรียนมารีวิทย์ชัยนาท</p>
            </div>
          <div class="user-profile-box" style="display: flex; align-items: center; gap: 12px; background: #fff; padding: 8px 18px; border-radius: 30px; box-shadow: var(--shadow-sm); border: 1px solid #e5e7eb;">
    <i class="fa-solid fa-circle-user fa-2xl" style="color: var(--primary-green);"></i>
    <div>
        <div style="font-weight: 700; font-size: 0.95rem; color: var(--text-main);">
            <?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'ผู้ดูแลระบบ'); ?>
        </div>
        <div style="font-size: 0.78rem; color: var(--text-sub);">
            สถานะ: 
            <?php 
                $role_check = strtolower(trim($_SESSION['admin_role'] ?? 'admin'));
                if ($role_check === 'superadmin'): 
            ?>
                <strong style="color: #0284c7; background: #e0f2fe; padding: 2px 8px; border-radius: 12px;">SuperAdmin</strong>
            <?php else: ?>
                <strong style="color: #475569; background: #f1f5f9; padding: 2px 8px; border-radius: 12px;">Admin</strong>
            <?php endif; ?>
        </div>
    </div>
</div>
        </div>

        <!-- 3 สถิติภาพรวม -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--light-green); color: var(--primary-green);">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <div class="stat-info">
                    <span>ข่าวและกิจกรรมทั้งหมด</span>
                    <h3><?php echo $news_count; ?> <small style="font-size: 0.9rem; font-weight: 400;">รายการ</small></h3>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div class="stat-info">
                    <span>ใบสมัครเรียนที่รอดำเนินการ</span>
                    <h3><?php echo $admissions_pending; ?> <small style="font-size: 0.9rem; font-weight: 400;">คน</small></h3>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #fee2e2; color: #dc2626;">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div class="stat-info">
                    <span>เรื่องติดต่อใหม่ที่ยังไม่ได้ตอบ</span>
                    <h3><?php echo $tickets_new; ?> <small style="font-size: 0.9rem; font-weight: 400;">เคส</small></h3>
                </div>
            </div>
        </div>

        <!-- กล่องข้อมูล 2 ฝั่ง -->
        <div class="dashboard-grid">
            <!-- ฝั่งซ้าย: เรื่องติดต่อสอบถาม -->
            <div class="data-card">
                <div class="data-card-head">
                    <h4><i class="fa-solid fa-bell"></i> เรื่องติดต่อสอบถามล่าสุด</h4>
                    <a href="tickets_manage.php" style="font-size: 0.8rem; color: var(--primary-green); text-decoration: none; font-weight: 600;">ดูทั้งหมด <i class="fa-solid fa-chevron-right"></i></a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>หัวข้อ</th>
                            <th>ผู้ติดต่อ</th>
                            <th style="text-align: center;">ความเร่งด่วน</th>
                            <th style="text-align: right;">เวลา</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($latest_tickets) > 0): ?>
                            <?php foreach ($latest_tickets as $ticket): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($ticket['topic']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($ticket['sender_name']); ?></td>
                                    <td style="text-align: center;">
                                        <?php 
                                            $uClass = 'badge-normal';
                                            if ($ticket['urgency'] === 'Urgent') $uClass = 'badge-urgent';
                                            elseif ($ticket['urgency'] === 'Fast') $uClass = 'badge-fast';
                                        ?>
                                        <span class="badge-pill <?php echo $uClass; ?>"><?php echo htmlspecialchars($ticket['urgency']); ?></span>
                                    </td>
                                    <td style="text-align: right; color: var(--text-sub); font-size: 0.8rem;"><?php echo date('d/m/y H:i', strtotime($ticket['created_at'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" style="text-align: center; color: var(--text-sub); padding: 20px;">ยังไม่มีเรื่องติดต่อใหม่</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- ฝั่งขวา: ผู้สมัครเรียนออนไลน์ล่าสุด (ขยายกว้างและจัดบรรทัดใหม่) -->
            <div class="data-card">
                <div class="data-card-head">
                    <h4><i class="fa-solid fa-file-signature"></i> ผู้สมัครเรียนออนไลน์ล่าสุด</h4>
                    <a href="admissions_manage.php" style="font-size: 0.8rem; color: var(--primary-green); text-decoration: none; font-weight: 600;">ดูทั้งหมด <i class="fa-solid fa-chevron-right"></i></a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ชื่อนักเรียน</th>
                            <th>ระดับชั้น</th>
                            <th>เบอร์ผู้ปกครอง</th>
                            <th style="text-align: center;">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($latest_admissions) > 0): ?>
                            <?php foreach ($latest_admissions as $adm): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($adm['student_name']); ?></strong></td>
                                    <td style="color: var(--text-sub); font-size: 0.84rem;"><?php echo htmlspecialchars($adm['grade_level']); ?></td>
                                    <td style="white-space: nowrap;">
                                        <a href="tel:<?php echo htmlspecialchars($adm['parent_phone']); ?>" style="color: var(--primary-green); text-decoration: none; font-weight: 600;">
                                            <i class="fa-solid fa-phone" style="font-size: 0.75rem;"></i> <?php echo htmlspecialchars($adm['parent_phone']); ?>
                                        </a>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                            $stClass = 'status-pending';
                                            $stLabel = 'รอดำเนินการ';
                                            if ($adm['status'] === 'contacted') { $stClass = 'status-contacted'; $stLabel = 'ติดต่อแล้ว'; }
                                            elseif ($adm['status'] === 'approved') { $stClass = 'status-approved'; $stLabel = 'ยืนยันสิทธิ์'; }
                                            elseif ($adm['status'] === 'rejected') { $stClass = 'status-rejected'; $stLabel = 'สละสิทธิ์'; }
                                        ?>
                                        <span class="status-badge <?php echo $stClass; ?>"><?php echo $stLabel; ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" style="text-align: center; color: var(--text-sub); padding: 20px;">ยังไม่มีผู้สมัครเรียนใหม่</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>
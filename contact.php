<?php 
// 1. โหลด config และเชื่อมต่อฐานข้อมูลก่อนส่ง Output ใดๆ
require_once 'admin/config.php';

$pageTitle = "ติดต่อเรา | โรงเรียนมารีวิทย์ชัยนาท (Maryvit Chainat School)";
$currentPage = "contact";

$ticketSuccess = false;
$ticketCode = '';

// 2. ประมวลผลฟอร์มติดต่อสอบถาม
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_ticket') {
    $topic        = trim($_POST['topic'] ?? 'General');
    $urgency      = trim($_POST['urgency'] ?? 'Normal');
    $sender_name  = trim($_POST['sender_name'] ?? '');
    $sender_phone = trim($_POST['sender_phone'] ?? '');
    $sender_email = trim($_POST['sender_email'] ?? '');
    $sender_line  = trim($_POST['sender_line'] ?? '');
    $message      = trim($_POST['message'] ?? '');

    if (!empty($sender_name) && !empty($sender_phone) && !empty($message)) {
        $ticketCode = 'MV-' . date('Y') . '-CH' . rand(1000, 9999);
        try {
            $stmt = $conn->prepare("INSERT INTO contact_tickets (ticket_code, topic, urgency, sender_name, sender_phone, sender_email, sender_line, message, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'new')");
            $stmt->execute([$ticketCode, $topic, $urgency, $sender_name, $sender_phone, $sender_email, $sender_line, $message]);
            $ticketSuccess = true;
        } catch (PDOException $e) {
            // Log Error
        }
    }
}

// 3. เรียกใช้ Header ของหน้าเว็บ
include 'header.php'; 
?>


<!-- Header Banner -->
<section class="page-header">
    <div class="container">
        <div class="header-content">
            <div class="header-badge"><i class="fa-solid fa-headset"></i> Direct Priority Support & Helpdesk</div>
            <h2>ติดต่อสอบถาม <span>ฝ่ายบริการข้อมูล</span></h2>
            <p>ช่องทางติดต่อด่วน พร้อมระบบส่งต่อเรื่องตรงถึงฝ่ายที่เกี่ยวข้อง เพื่อการตอบกลับที่รวดเร็วและได้ผลลัพธ์แน่นอน</p>
            <div class="breadcrumb">
                <a href="index.php"><i class="fa-solid fa-house"></i> หน้าแรก</a>
                <span>/</span>
                <span>ติดต่อเรา</span>
            </div>
        </div>
    </div>
</section>

<!-- Main Contact Grid -->
<section class="contact-section">
    <div class="container">
        <div class="contact-grid">

            <!-- Left Column: Smart Interactive Terminal Form -->
            <div class="terminal-card">
                <div class="status-header-bar">
                    <div class="live-status-pill">
                        <span class="pulse-dot"></span>
                        <span>ระบบออนไลน์ · ตอบกลับเฉลี่ย &lt; 2 ชม.</span>
                    </div>
                    <div class="ticket-id" id="ticketIdDisplay">
                        <?php echo $ticketSuccess ? 'TICKET CREATED: #' . $ticketCode : 'TICKET ID: #MV-' . date('Y') . '-ONLINE'; ?>
                    </div>
                </div>

                <h3 class="terminal-form-title">ส่งเรื่องติดต่อตรงถึงเจ้าหน้าที่</h3>
                <p class="terminal-form-desc">เลือกแผนกและระดับความด่วน เพื่อให้ฝ่ายที่รับผิดชอบติดต่อกลับได้ตรงประเด็นที่สุด</p>

                <form method="POST">
                    <input type="hidden" name="action" value="submit_ticket">
                    <input type="hidden" name="topic" id="selectedTopic" value="Admissions">

                    <!-- 1. Topic Chips Selector -->
                    <span class="chip-group-label"><i class="fa-solid fa-tags" style="color: var(--primary-green);"></i> 1. เรื่องที่ต้องการติดต่อสอบถาม *</span>
                    <div class="chips-container" id="chipContainer">
                        <button type="button" class="chip-btn active" data-topic="Admissions">🎓 สอบถามการรับสมัคร / ค่าเทอม</button>
                        <button type="button" class="chip-btn" data-topic="Academic">📚 หลักสูตรการเรียน / ห้องเรียน IEP</button>
                        <button type="button" class="chip-btn" data-topic="Schoology">💻 ระบบ Schoology / บัญชีนักเรียน</button>
                        <button type="button" class="chip-btn" data-topic="Transport">🚌 บริการรถรับ-ส่ง / สวัสดิการ</button>
                        <button type="button" class="chip-btn" data-topic="General">💬 ติดต่อธุรการ / เรื่องอื่น ๆ</button>
                    </div>

                    <!-- 2. Urgency Selector -->
                    <span class="chip-group-label"><i class="fa-solid fa-stopwatch" style="color: var(--primary-green);"></i> 2. ระดับความเร่งด่วน *</span>
                    <div class="urgency-grid">
                        <label class="urgency-card selected" onclick="selectUrgency(this)">
                            <input type="radio" name="urgency" value="Normal" checked>
                            <div class="urgency-text">ปกติ (1-2 วัน)</div>
                        </label>
                        <label class="urgency-card" onclick="selectUrgency(this)">
                            <input type="radio" name="urgency" value="Fast">
                            <div class="urgency-text">ด่วน (ภายใน 24 ชม.)</div>
                        </label>
                        <label class="urgency-card" onclick="selectUrgency(this)">
                            <input type="radio" name="urgency" value="Urgent">
                            <div class="urgency-text">ด่วนมาก (ติดต่อทันที)</div>
                        </label>
                    </div>

                    <!-- 3. Sender Info -->
                    <div class="form-row">
                        <div>
                            <label><i class="fa-solid fa-user"></i> ชื่อ-นามสกุล ผู้ติดต่อ *</label>
                            <input type="text" name="sender_name" class="form-input" placeholder="เช่น คุณสมชาย รักเรียน" required>
                        </div>
                        <div>
                            <label><i class="fa-solid fa-phone"></i> เบอร์โทรศัพท์ติดต่อกลับ *</label>
                            <input type="tel" name="sender_phone" class="form-input" placeholder="08X-XXX-XXXX" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div>
                            <label><i class="fa-solid fa-envelope"></i> อีเมล</label>
                            <input type="email" name="sender_email" class="form-input" placeholder="example@email.com">
                        </div>
                        <div>
                            <label><i class="fa-brands fa-line"></i> LINE ID</label>
                            <input type="text" name="sender_line" class="form-input" placeholder="LINE ID เพื่อให้เจ้าหน้าที่ทักกลับ">
                        </div>
                    </div>

                    <!-- 4. Detail Message -->
                    <div class="form-group">
                        <label><i class="fa-solid fa-comment-dots"></i> รายละเอียดข้อความ / สิ่งที่ต้องการสอบถาม *</label>
                        <textarea name="message" class="form-textarea" rows="4" placeholder="ระบุรายละเอียดที่ต้องการให้เจ้าหน้าที่ดำเนินการ..." required></textarea>
                    </div>

                    <button type="submit" class="btn-dispatch">
                        <i class="fa-solid fa-paper-plane"></i> ส่งข้อมูลตรงถึงเจ้าหน้าที่ฝ่ายงาน
                    </button>

                    <div class="trust-guarantee">
                        <i class="fa-solid fa-shield-halved" style="color: var(--primary-green);"></i> ข้อมูลของท่านจะถูกส่งตรงเข้าสู่ระบบเคสของโรงเรียนมารีวิทย์ ชัยนาท อย่างปลอดภัย
                    </div>
                </form>
            </div>

            <!-- Right Column: Direct Department Info & Map -->
            <div class="info-column">
                <div class="dept-card">
                    <div class="dept-header">
                        <div class="dept-icon"><i class="fa-solid fa-file-signature"></i></div>
                        <div class="dept-title">
                            <h4>ฝ่ายทะเบียน & รับสมัครนักเรียน</h4>
                            <span>Admissions & Registrar Office</span>
                        </div>
                    </div>
                    <div class="dept-detail-item"><i class="fa-solid fa-phone"></i> <span>056-411-XXX ต่อ 101, 102</span></div>
                    <div class="dept-detail-item"><i class="fa-solid fa-clock"></i> <span>จันทร์ - ศุกร์: 07.30 - 17.00 น.</span></div>
                    <div class="dept-detail-item"><i class="fa-solid fa-envelope"></i> <span>admission@maryvit-chainat.ac.th</span></div>
                </div>

                <div class="dept-card">
                    <div class="dept-header">
                        <div class="dept-icon"><i class="fa-solid fa-laptop-file"></i></div>
                        <div class="dept-title">
                            <h4>ฝ่ายวิชาการ & ระบบ Schoology</h4>
                            <span>Academic Affairs & IT Support</span>
                        </div>
                    </div>
                    <div class="dept-detail-item"><i class="fa-solid fa-phone"></i> <span>056-411-XXX ต่อ 105</span></div>
                    <div class="dept-detail-item"><i class="fa-solid fa-envelope"></i> <span>it-support@maryvit-chainat.ac.th</span></div>
                </div>

                <div class="map-card">
                    <div class="map-card-header">
                        <h5><i class="fa-solid fa-map-location-dot"></i> ที่ตั้งสถานศึกษา</h5>
                        <a href="https://maps.google.com" target="_blank" rel="noopener noreferrer" style="font-size: 0.8rem; color: var(--primary-green); font-weight: 600;"><i class="fa-solid fa-diamond-turn-right"></i> ดูบน Google Maps</a>
                    </div>
                    <div class="map-container">
                        <div style="text-align: center; color: var(--text-sub);">
                            <i class="fa-solid fa-school-flag" style="font-size: 2.5rem; color: var(--primary-green); margin-bottom: 8px;"></i>
                            <p style="font-weight: 700; color: var(--primary-green);">โรงเรียนมารีวิทย์ ชัยนาท</p>
                            <p style="font-size: 0.85rem;">อำเภอเมืองชัยนาท จังหวัดชัยนาท 17000</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Toast Alert เมื่อส่งเรื่องสำเร็จ -->
<div class="toast-msg" id="toastMsg" style="<?php echo $ticketSuccess ? 'display: flex;' : ''; ?>">
    <i class="fa-solid fa-circle-check fa-2xl"></i>
    <div>
        <strong>ส่งเรื่องติดต่อสำเร็จ! (รหัส <?php echo $ticketCode; ?>)</strong>
        <p style="font-size: 0.85rem; margin-top: 2px;">เจ้าหน้าที่แผนกที่เกี่ยวข้องได้รับเรื่องแล้ว และจะติดต่อกลับตามเวลาที่กำหนด</p>
    </div>
</div>

<script>
    const chipBtns = document.querySelectorAll('.chip-btn');
    const topicInput = document.getElementById('selectedTopic');

    chipBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            chipBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            if (topicInput) topicInput.value = btn.getAttribute('data-topic');
        });
    });

    function selectUrgency(element) {
        document.querySelectorAll('.urgency-card').forEach(card => card.classList.remove('selected'));
        element.classList.add('selected');
        const radio = element.querySelector('input[type="radio"]');
        if (radio) radio.checked = true;
    }

    <?php if ($ticketSuccess): ?>
    setTimeout(() => {
        const toast = document.getElementById('toastMsg');
        if (toast) toast.style.display = 'none';
    }, 5000);
    <?php endif; ?>
</script>

<?php include 'footer.php'; ?>
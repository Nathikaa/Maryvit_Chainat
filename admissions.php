<?php 
require_once 'admin/config.php'; // 1. ดึงฐานข้อมูลและเริ่ม Session ก่อนอันดับแรก

$pageTitle = "รับสมัครนักเรียนใหม่ 2569 | โรงเรียนมารีวิทย์ ชัยนาท (Maryvit Chainat School)";
$currentPage = "admissions";

$applySuccess = false;
$applyError = '';

// 2. ประมวลผลฟอร์มก่อนส่ง HTML Header
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_admission') {
    $student_name = trim($_POST['student_name'] ?? '');
    $grade_level  = trim($_POST['grade_level'] ?? '');
    $parent_phone = trim($_POST['parent_phone'] ?? '');
    $parent_line  = trim($_POST['parent_line'] ?? '');

    if (!empty($student_name) && !empty($grade_level) && !empty($parent_phone)) {
        try {
            $stmt = $conn->prepare("INSERT INTO admissions (student_name, grade_level, parent_phone, parent_line, status) VALUES (?, ?, ?, ?, 'pending')");
            $stmt->execute([$student_name, $grade_level, $parent_phone, $parent_line]);
            $applySuccess = true;
        } catch (PDOException $e) {
            $applyError = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่อีกครั้ง";
        }
    } else {
        $applyError = "กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน";
    }
}

include 'header.php'; // 3. โหลด Header และ HTML หลังจากประมวลผลเสร็จแล้ว
?>


<!-- Hero Section & Real Form -->
<section class="admission-hero">
    <div class="container">
        <div class="hero-left-content">
            <div class="admission-badge"><i class="fa-solid fa-fire"></i> เปิดรับสมัครนักเรียนใหม่ ปีการศึกษา 2569</div>
            <h2>Ready to Shape <br>Your <span>Future?</span></h2>
            <p>ที่นี่... ไม่ได้สอนแค่ในตำรา แต่พาคุณไปคว้าสิ่งที่ฝัน ปลดล็อกศักยภาพในแบบที่คุณเป็น กับสภาพแวดล้อมที่พร้อมซัพพอร์ตทุกความชอบและไอเดียใหม่ ๆ</p>
            <div class="hero-cta-btns">
                <a href="#apply-form" class="btn-gold-cta"><i class="fa-solid fa-file-pen"></i> กรอกใบสมัครออนไลน์ทันที</a>
                <a href="about.php" class="btn-ghost-cta"><i class="fa-solid fa-eye"></i> ส่องบรรยากาศโรงเรียน</a>
            </div>
        </div>

        <!-- Quick Apply Card -->
        <div class="quick-register-card" id="apply-form">
            <div class="card-header-tag">
                <h4>ลงทะเบียนสมัครเรียน</h4>
                <p>กรอกข้อมูลเบื้องต้นเพื่อรับสิทธิพิเศษและทุนการศึกษา</p>
            </div>

            <?php if (!empty($applyError)): ?>
                <div style="background: #fee2e2; color: #dc2626; padding: 10px; border-radius: 8px; margin-bottom: 12px; font-size: 0.85rem;">
                    <i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($applyError); ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="action" value="submit_admission">
                <div class="form-group">
                    <label for="student-name"><i class="fa-solid fa-user"></i> ชื่อ-นามสกุล นักเรียน *</label>
                    <input type="text" name="student_name" id="student-name" class="form-control" placeholder="เช่น ด.ช. ภูมิใจ รักเรียน" required>
                </div>

                <div class="form-group">
                    <label for="student-grade"><i class="fa-solid fa-layer-group"></i> เลือกระดับชั้นที่ต้องการสมัคร *</label>
                    <select name="grade_level" id="student-grade" class="form-control" required>
                        <option value="">-- กรุณาเลือกระดับชั้น --</option>
                        <option value="แผนกปฐมวัย (เตรียมอนุบาล - อ.3)">แผนกปฐมวัย (เตรียมอนุบาล - อ.3)</option>
                        <option value="แผนกประถมศึกษา (ป.1 - ป.6)">แผนกประถมศึกษา (ป.1 - ป.6)</option>
                        <option value="แผนกมัธยมศึกษาตอนต้น (ม.1 - ม.3)">แผนกมัธยมศึกษาตอนต้น (ม.1 - ม.3)</option>
                        <option value="แผนกมัธยมศึกษาตอนปลาย (ม.4 - ม.6)">แผนกมัธยมศึกษาตอนปลาย (ม.4 - ม.6)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="parent-phone"><i class="fa-solid fa-phone"></i> เบอร์โทรศัพท์ผู้ปกครอง *</label>
                    <input type="tel" name="parent_phone" id="parent-phone" class="form-control" placeholder="08X-XXX-XXXX" required>
                </div>

                <div class="form-group">
                    <label for="parent-line"><i class="fa-brands fa-line"></i> LINE ID ผู้ปกครอง</label>
                    <input type="text" name="parent_line" id="parent-line" class="form-control" placeholder="LINE ID เพื่อรับผลการสมัคร">
                </div>

                <button type="submit" class="btn-submit-form"><i class="fa-solid fa-paper-plane"></i> ส่งข้อมูลสมัครเรียน</button>
            </form>
        </div>
    </div>
</section>

<!-- Why Choose Maryvit -->
<section class="why-section">
    <div class="container">
        <div class="section-center-head">
            <h3>ทำไมต้องเริ่มต้นก้าวต่อไปที่มารีวิทย์?</h3>
            <p>สัมผัสประสบการณ์การเรียนรู้ที่แตกต่าง เพื่อความพร้อมสู่โลกอนาคต</p>
        </div>

        <div class="feature-grid">
            <div class="feature-box">
                <div class="feature-icon-badge"><i class="fa-solid fa-compass-drafting"></i></div>
                <h4>Learn What You Love</h4>
                <p>หลักสูตรทันสมัย เลือกโฟกัสสายที่ใช่ ไม่ว่าจะเป็น วิทยาศาสตร์-สุขภาพ, AI & Tech, ภาษาธุรกิจสากล หรือศิลปะดนตรี</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon-badge"><i class="fa-solid fa-earth-asia"></i></div>
                <h4>Native English Mastery</h4>
                <p>เรียนภาษาอังกฤษกับคุณครูเจ้าของภาษา Native Speakers ทุกวัน พูดได้อย่างเป็นธรรมชาติและมั่นใจในเวทีระดับสากล</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon-badge"><i class="fa-solid fa-rocket"></i></div>
                <h4>Space for Creators</h4>
                <p>ห้องปฏิบัติการวิทยาศาสตร์ทันสมัย, ศูนย์การเรียนรู้ Coding & Robotics, สระว่ายน้ำ และสนามกีฬามาตรฐานครบครัน</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon-badge"><i class="fa-solid fa-shield-heart"></i></div>
                <h4>Character & Discipline</h4>
                <p>บ่มเพาะคุณธรรม จริยธรรม และระเบียบวินัยตามอัตลักษณ์มารีวิทย์ หล่อหลอมให้เป็นผู้นำที่มีจิตสาธารณะ</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon-badge"><i class="fa-solid fa-award"></i></div>
                <h4>Smart Scholarship</h4>
                <p>มีทุนการศึกษาสำหรับนักเรียนเรียนดี ทุนโควตานักกีฬา และส่วนลดพิเศษสำหรับพี่น้องครอบครัวเดียวกัน</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon-badge"><i class="fa-solid fa-people-roof"></i></div>
                <h4>Warm Maryvit Family</h4>
                <p>เครือข่ายครอบครัวที่อบอุ่น คุณครูดูแลเอาใจใส่ใกล้ชิด พร้อมระบบติดตามการเรียนการสอนออนไลน์ Schoology</p>
            </div>
        </div>
    </div>
</section>

<!-- 4 ขั้นตอนการสมัครเรียน -->
<section class="workflow-section">
    <div class="container">
        <div class="section-center-head">
            <h3>เส้นทางสู่การเป็นครอบครัวมารีวิทย์</h3>
            <p>4 ขั้นตอนง่าย ๆ ในการสมัครเข้าศึกษาต่อ</p>
        </div>

        <div class="workflow-grid">
            <div class="step-card">
                <div class="step-number">1</div>
                <h4>กรอกใบสมัคร</h4>
                <p>กรอกข้อมูลผ่านระบบออนไลน์ หรือเดินทางมาสมัครด้วยตนเองที่ห้องธุรการโรงเรียน</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h4>นัดสัมภาษณ์ & ทดสอบ</h4>
                <p>พูดคุยแลกเปลี่ยนแบบเป็นกันเอง เพื่อทำความรู้จักเป้าหมายและความถนัดของนักเรียน</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h4>ประกาศผลการคัดเลือก</h4>
                <p>ตรวจสอบรายชื่อผู้ผ่านการคัดเลือกและรับรหัสประจำตัวนักเรียนผ่าน SMS / LINE</p>
            </div>
            <div class="step-card">
                <div class="step-number">4</div>
                <h4>มอบตัว & รับอุปกรณ์</h4>
                <p>ยืนยันสิทธิ์ มอบตัวนักเรียน รับเครื่องแบบและหนังสือเรียน พร้อมเปิดเทอมอย่างมั่นใจ</p>
            </div>
        </div>
    </div>
</section>

<!-- ทุนการศึกษาและสิทธิพิเศษ -->
<section class="scholarship-section">
    <div class="container">
        <div class="section-center-head">
            <h3>ทุนการศึกษา & สิทธิพิเศษ ประจำปีการศึกษา 2569</h3>
            <p>สนับสนุนทุกความฝันของเยาวชนคนเก่ง</p>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ประเภททุน / สิทธิประโยชน์</th>
                        <th>ระดับชั้น</th>
                        <th>เกณฑ์การรับทุน</th>
                        <th>สิทธิพิเศษ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>ทุนเพชรมารีวิทย์ (เรียนดีเด่น)</strong></td>
                        <td>ประถม - มัธยม</td>
                        <td>เกรดเฉลี่ยสะสม 3.75 ขึ้นไป หรือสอบได้คะแนนสูงสุด</td>
                        <td><span class="badge-pill-green">ยกเว้นค่าเล่าเรียน 100%</span></td>
                    </tr>
                    <tr>
                        <td><strong>ทุนส่งเสริมความเป็นเลิศด้านภาษา</strong></td>
                        <td>มัธยมศึกษา</td>
                        <td>มีผลคะแนน CEFR หรือผ่านการทดสอบภาษาอังกฤษยอดเยี่ยม</td>
                        <td><span class="badge-pill-green">ยกเว้นค่าบำรุงหลักสูตร IEP 50%</span></td>
                    </tr>
                    <tr>
                        <td><strong>ทุนโควตานักกีฬา & ดนตรีดีเด่น</strong></td>
                        <td>ทุกระดับชั้น</td>
                        <td>มีประวัติรางวัลการแข่งขันระดับจังหวัดหรือระดับประเทศ</td>
                        <td><span class="badge-pill-green">รับทุนพัฒนาศักยภาพพิเศษ</span></td>
                    </tr>
                    <tr>
                        <td><strong>สิทธิพิเศษพี่น้องเรียนร่วมกัน (Sibling Discount)</strong></td>
                        <td>ทุกระดับชั้น</td>
                        <td>มีพี่น้องเข้าศึกษาในเครือมารีวิทย์พร้อมกัน</td>
                        <td><span class="badge-pill-green">ส่วนลดค่าธรรมเนียมพิเศษ</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- FAQ Accordion -->
<section class="faq-section">
    <div class="container">
        <div class="section-center-head">
            <h3>คำถามที่พบบ่อย (FAQ)</h3>
            <p>ข้อสงสัยเกี่ยวกับเกณฑ์การรับสมัครและเอกสารที่ต้องใช้</p>
        </div>

        <div class="faq-accordion">
            <div class="faq-item">
                <button class="faq-header" onclick="toggleFaq(this)">
                    <span>1. เอกสารที่ต้องใช้ในการสมัครเรียนมีอะไรบ้าง?</span>
                    <i class="fa-solid fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-body">
                    สำเนาสูติบัตรนักเรียน, สำเนาทะเบียนบ้านและบัตรประชาชนของนักเรียนและผู้ปกครอง, ใบรับรองผลการเรียน (ปพ.1) จากโรงเรียนเดิม และรูปถ่ายขนาด 1.5 นิ้ว จำนวน 2 รูป
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-header" onclick="toggleFaq(this)">
                    <span>2. นักเรียนที่ไม่มีพื้นฐานภาษาอังกฤษ สามารถเข้าเรียนได้ไหม?</span>
                    <i class="fa-solid fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-body">
                    สามารถเข้าเรียนได้ครับ ทางโรงเรียนมีคอร์สปรับพื้นฐาน (Bridge Program) และมีคุณครูคอยดูแลประกบอย่างใกล้ชิด เพื่อสร้างความมั่นใจก่อนเปิดภาคเรียนจริง
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-header" onclick="toggleFaq(this)">
                    <span>3. ทางโรงเรียนมีบริการรถรับ-ส่งนักเรียนหรือไม่?</span>
                    <i class="fa-solid fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-body">
                    มีบริการรถตู้รับ-ส่งนักเรียนที่ได้มาตรฐานความปลอดภัย ครอบคลุมพื้นที่อำเภอเมืองชัยนาท และอำเภอใกล้เคียง พร้อมระบบ GPS และครูประจำรถดูแลตลอดเส้นทาง
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Toast Alert เมื่อส่งสำเร็จ -->
<div class="toast-msg" id="toastMsg" style="<?php echo $applySuccess ? 'display: flex;' : ''; ?>">
    <i class="fa-solid fa-circle-check fa-2xl"></i>
    <div>
        <strong>ลงทะเบียนสำเร็จ!</strong>
        <p style="font-size: 0.85rem; margin-top: 2px;">เจ้าหน้าที่ฝ่ายทะเบียนได้รับข้อมูลแล้ว และจะติดต่อกลับภายใน 24 ชม.</p>
    </div>
</div>

<script>
    function toggleFaq(btn) {
        const item = btn.parentElement;
        item.classList.toggle('open');
    }

    <?php if ($applySuccess): ?>
    setTimeout(() => {
        const toast = document.getElementById('toastMsg');
        if (toast) toast.style.display = 'none';
    }, 4500);
    <?php endif; ?>
</script>

<?php include 'footer.php'; ?>
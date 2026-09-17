<?php 

require_once 'admin/config.php';

$pageTitle = "โรงเรียนมารีวิทย์ชัยนาท | Maryvit Chainat School";
$currentPage = "home";


$stmt_news = $conn->query("SELECT * FROM news ORDER BY id DESC LIMIT 3");
$latest_news = $stmt_news->fetchAll();


$cat_names = [
    'general'  => 'ประชาสัมพันธ์',
    'academic' => 'วิชาการ',
    'activity' => 'ภาพกิจกรรม',
    'pride'    => 'ความภาคภูมิใจ'
];

$cat_gradients = [
    'general'  => 'linear-gradient(45deg, #0B6623, #15803d)',
    'academic' => 'linear-gradient(45deg, #b45309, #f59e0b)',
    'activity' => 'linear-gradient(45deg, #7c3aed, #a855f7)',
    'pride'    => 'linear-gradient(45deg, #1e3a8a, #3b82f6)'
];

$cat_icons = [
    'general'  => 'fa-school',
    'academic' => 'fa-language',
    'activity' => 'fa-volleyball',
    'pride'    => 'fa-award'
];


include 'header.php'; 
?>
<section class="hero" id="home">
    <div class="container">
        <div class="hero-left">
            <div class="hero-tag"><i class="fa-solid fa-robot"></i> ก้าวล้ำทุกการเรียนรู้ด้วยภาษาและ AI</div>
            <h2 class="hero-title">ยินดีต้อนรับสู่ <br><span>โรงเรียนมารีวิทย์ชัยนาท</span></h2>
            <p class="hero-subtitle">เปิดสอนระดับเตรียมอนุบาล - ประถมศึกษาปีที่ 6 มุ่งพัฒนาผู้เรียนสู่ศักยภาพระดับสากล เสริมทักษะภาษาและเทคโนโลยี AI ควบคู่คุณธรรมและระเบียบวินัย</p>
            <div class="hero-actions">
                <a href="admissions.php" class="btn-gold"><i class="fa-solid fa-file-signature"></i> สมัครเรียน ปีการศึกษา 2569</a>
                <a href="tel:0806436135" class="btn-outline-white"><i class="fa-solid fa-phone"></i> โทร. 080-643-6135</a>
            </div>
        </div>
    </div>
</section>


<div class="quick-section">
    <div class="container">
        <div class="quick-grid">
            <a href="admissions.php" class="quick-card">
                <div class="quick-icon-circle"><i class="fa-solid fa-file-pen"></i></div>
                <h3>สมัครเรียนออนไลน์</h3>
                <p>ปีการศึกษา 2569</p>
            </a>
            <a href="curriculum.php" class="quick-card">
                <div class="quick-icon-circle"><i class="fa-solid fa-laptop-code"></i></div>
                <h3>หลักสูตร & AI App</h3>
                <p>การเรียนรู้ดิจิทัลสากล</p>
            </a>
            <a href="about.php" class="quick-card">
                <div class="quick-icon-circle"><i class="fa-solid fa-school"></i></div>
                <h3>รู้จักมารีวิทย์</h3>
                <p>ประวัติและอัตลักษณ์</p>
            </a>
            <a href="contact.php" class="quick-card">
                <div class="quick-icon-circle"><i class="fa-solid fa-headset"></i></div>
                <h3>ติดต่อสอบถาม</h3>
                <p>แผนกธุรการและฝ่ายงาน</p>
            </a>
        </div>
    </div>
</div>

<!-- 5. News & Announcements (Dynamic จาก Database) -->
<section class="section-padding" id="news">
    <div class="container">
        <div class="section-header">
            <div class="section-title">
                <h3>ข่าวประชาสัมพันธ์ & กิจกรรม</h3>
                <p>ติดตามข่าวสาร ความเคลื่อนไหว และภาพบรรยากาศในโรงเรียน</p>
            </div>
            <a href="news.php" class="link-view-all">ดูข่าวทั้งหมด <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="news-grid">
            <?php if (count($latest_news) > 0): ?>
                <?php foreach ($latest_news as $news): ?>
                    <?php 
                        $catKey = $news['category'] ?? 'general';
                        $catLabel = $cat_names[$catKey] ?? 'ประชาสัมพันธ์';
                        $bgGrad = $cat_gradients[$catKey] ?? $cat_gradients['general'];
                        $iconClass = $cat_icons[$catKey] ?? 'fa-school';
                    ?>
                    <div class="news-card">
                        <?php if (!empty($news['image']) && file_exists('uploads/news/' . $news['image'])): ?>
                            <div class="news-banner" style="background-image: url('uploads/news/<?php echo htmlspecialchars($news['image']); ?>'); background-size: cover; background-position: center;">
                                <span class="news-date"><i class="fa-regular fa-clock"></i> <?php echo date('d M Y', strtotime($news['created_at'])); ?></span>
                            </div>
                        <?php else: ?>
                            <div class="news-banner" style="background: <?php echo $bgGrad; ?>;">
                                <i class="fa-solid <?php echo $iconClass; ?> fa-3x"></i>
                                <span class="news-date"><i class="fa-regular fa-clock"></i> <?php echo date('d M Y', strtotime($news['created_at'])); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="news-content">
                            <span class="news-cat"><?php echo htmlspecialchars($catLabel); ?></span>
                            <h4 class="news-heading"><?php echo htmlspecialchars($news['title']); ?></h4>
                            <p class="news-detail"><?php echo htmlspecialchars($news['detail']); ?></p>
                            <div class="news-meta">
                                <span><i class="fa-regular fa-eye"></i> <?php echo intval($news['views']); ?> ครั้ง</span>
                                <a href="news.php" style="color: var(--primary-green);">อ่านต่อ <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="news-card">
                    <div class="news-banner" style="background: linear-gradient(45deg, #0B6623, #15803d);">
                        <i class="fa-solid fa-school fa-3x"></i>
                        <span class="news-date"><i class="fa-regular fa-clock"></i> ล่าสุด</span>
                    </div>
                    <div class="news-content">
                        <span class="news-cat">ประชาสัมพันธ์</span>
                        <h4 class="news-heading">เปิดรับสมัครนักเรียนใหม่ ปีการศึกษา 2569</h4>
                        <p class="news-detail">เปิดรับสมัครระดับเตรียมอนุบาล ถึง ประถมศึกษาปีที่ 6 ก้าวล้ำทุกการเรียนรู้ด้วยภาษาและเทคโนโลยี</p>
                        <div class="news-meta">
                            <span>โรงเรียนมารีวิทย์</span>
                            <a href="admissions.php" style="color: var(--primary-green);">สมัครเรียน <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- 6. Curriculum Highlights -->
<section class="programs-wrap" id="curriculum">
    <div class="container">
        <div class="section-header" style="border-color: rgba(11,102,35,0.2);">
            <div class="section-title">
                <h3>ระดับชั้นและหลักสูตรการศึกษา</h3>
                <p>พัฒนาผู้เรียนอย่างรอบด้าน ทั้งด้านภาษา วิทยาศาสตร์ เทคโนโลยี และจิตใจ</p>
            </div>
        </div>

        <div class="program-cards">
            <div class="curriculum-card">
                <div class="curriculum-icon"><i class="fa-solid fa-shapes"></i></div>
                <h4>แผนกปฐมวัย (อนุบาล)</h4>
                <p>ส่งเสริมพัฒนาการทั้ง 4 ด้าน ผ่านกิจกรรม Play-based Learning และปูพื้นฐานภาษาอังกฤษเบื้องต้น</p>
            </div>
            <div class="curriculum-card">
                <div class="curriculum-icon"><i class="fa-solid fa-book-open"></i></div>
                <h4>แผนกประถมศึกษา</h4>
                <p>สร้างพื้นฐานวิชาการที่แข็งแกร่ง เน้นการคิดวิเคราะห์ และทักษะการใช้ภาษาเพื่อการสื่อสาร</p>
            </div>
            <div class="curriculum-card">
                <div class="curriculum-icon"><i class="fa-solid fa-robot"></i></div>
                <h4>เทคโนโลยี AI & Coding</h4>
                <p>ปูพื้นฐานกระบวนการคิดเชิงคำนวณ เสริมสร้างทักษะดิจิทัลยุคใหม่ผ่านเครื่องมือและ AI App</p>
            </div>
            <div class="curriculum-card">
                <div class="curriculum-icon"><i class="fa-solid fa-globe"></i></div>
                <h4>ภาษาต่างประเทศ</h4>
                <p>จัดการเรียนการสอนภาษาอังกฤษและภาษาจีน โดยคุณครูชาวต่างชาติเจ้าของภาษา (Native Speakers)</p>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
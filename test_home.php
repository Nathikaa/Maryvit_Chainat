<?php
// 1. เชื่อมต่อฐานข้อมูลก่อนส่ง Output ใดๆ
require_once 'admin/config.php';

$pageTitle = "ทดสอบหน้าแรก | Maryvit Chainat School";
$currentPage = "test_home";

// 2. ดึง 4 ข่าวล่าสุดจากฐานข้อมูล
$stmt_news = $conn->query("SELECT * FROM news ORDER BY id DESC LIMIT 4");
$latest_news = $stmt_news->fetchAll();


// 3. โหลด Header ของหน้าเว็บ
include 'header.php'; ?>


<section id="test_home">
    <div class="test_hero">
        <!-- ภาพพื้นหลังแบบสไลด์ -->
        <div class="hero-bg-slider" id="imageSlider">
            <div class="slider-track">
                <img src="assets/images/image1.jpg">
                <img src="assets/images/image2.jpg">
                <img src="assets/images/image3.jpg">
            </div>
            <!-- ชั้นสีทับภาพเพื่อให้อ่านข้อความง่าย -->
            <div class="hero-overlay"></div>
            <button class="slider-prev" type="button" aria-label="previous">&#10094;
            </button>
            <button class="slider-next" type="button" aria-label="next">&#10095;
            </button>

            <div class="slider-dots"></div>
        </div>
        <!-- เนื้อหาด้านหน้าภาพ -->
        <div class="container">
            <div class="hero-left">
                <div class="hero-tag">
                    <i class="fa-solid fa-award"></i>
                    มุ่งมั่นสู่ความเป็นเลิศ ควบคู่คุณธรรม
                </div>

                <h2 class="hero-title">
                    ยินดีต้อนรับสู่ <br>
                    <span>โรงเรียนมารีวิทย์ชัยนาท</span>
                </h2>

                <p class="hero-subtitle">
                    พัฒนาผู้เรียนสู่ศักยภาพระดับสากล เสริมทักษะภาษาอังกฤษ
                    และเทคโนโลยี ปลูกฝังระเบียบวินัยและจริยธรรม
                    ภายใต้มาตรฐานเครือโรงเรียนมารีวิทย์
                </p>

                <div class="hero-actions">
                    <a href="admissions.php" class="btn-gold">
                        <i class="fa-solid fa-file-signature"></i>
                        สมัครเรียน ปีการศึกษา 2569
                    </a>

                    <a href="about.php" class="btn-outline-white">
                        <i class="fa-solid fa-circle-play"></i>
                        วิดีโอแนะนำโรงเรียน
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="quick-section_home">

            <div class="quick-grid_two">
                <a href="#" class="quick-card ">
                    <div class="quick-icon-circle scale-in-center"><i class="fa-solid fa-calendar-days"></i></div>
                    <h3>ปฏิทินการศึกษา</h3>
                    <p>กำหนดการและวันสำคัญ</p>
                </a>
                <a href="#" class="quick-card">
                    <div class="quick-icon-circle scale-in-center"><i class="fa-solid fa-laptop-code"></i></div>
                    <h3>Schoology Online</h3>
                    <p>ระบบการเรียนการสอน</p>
                </a>
                <a href="#" class="quick-card ">
                    <div class="quick-icon-circle scale-in-center"><i class="fa-solid fa-clipboard-check"></i></div>
                    <h3>ตรวจผลการเรียน</h3>
                    <p>ระบบรายงานผลสอบ GPA</p>
                </a>
                <a href="#" class="quick-card">
                    <div class="quick-icon-circle scale-in-center"><i class="fa-solid fa-bus"></i></div>
                    <h3>บริการและสวัสดิการ</h3>
                    <p>รถรับส่ง, ค่าเทอม, เครื่องแบบ</p>
                </a>
            </div>
            <div class="hero-announcement">
                <div class="ann-head">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span>ข่าวประกาศด่วน</span>
                </div>
                <div class="ann-list-item fade-in-right">
                    <span class="ann-badge">รับสมัคร</span>
                    <div>
                        <strong>เปิดรับสมัครนักเรียนใหม่ ปีการศึกษา 2569</strong>
                        <p style="font-size: 16px; color: #6b7280;">ระดับปฐมวัย - มัธยมศึกษาตอนปลาย</p>
                    </div>
                </div>
                <div class="ann-list-item fade-in-right">
                    <span class="ann-badge">กำหนดการ</span>
                    <div>
                        <strong>ปฐมนิเทศผู้ปกครองและนักเรียนใหม่</strong>
                        <p style="font-size: 16px; color: #6b7280;">ณ หอประชุมใหญ่โรงเรียนมารีวิทย์ ชัยนาท</p>
                    </div>
                </div>
                <div class="ann-list-item fade-in-right">
                    <span class="ann-badge">ผลงาน</span>
                    <div>
                        <strong>ยินดีกับนักเรียนที่คว้ารางวัลโอลิมปิกวิชาการ</strong>
                        <p style="font-size: 16px; color: #6b7280;">การแข่งขันคณิตศาสตร์และวิทยาศาสตร์ระดับภาค</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. News & Announcements (Dynamic จาก Database) -->

<section class="news-masonry-section bg-section" id="news">
    <div class="container">
        <div class="section-header">
            <div class="section-title">
                <h3>ข่าวประชาสัมพันธ์ & กิจกรรม</h3>
                <p>ติดตามข่าวสาร ความเคลื่อนไหว และภาพบรรยากาศในโรงเรียน</p>
            </div>

            <a href="news.php" class="link-view-all">
                ดูข่าวทั้งหมด <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="container">
        <?php if (!empty($latest_news)): ?>

            <?php $newsGroups = array_chunk($latest_news, 4); ?>

            <?php foreach ($newsGroups as $group): ?>
                <div class="news-masonry-grid">

                    <?php foreach ($group as $index => $news): ?>
                        <?php
                        $catKey = $news['category'] ?? 'general';
                        $catLabel = $cat_names[$catKey] ?? 'ประชาสัมพันธ์';

                        $title = $news['title'] ?? 'ไม่มีหัวข้อข่าว';
                        $detail = $news['detail'] ?? '';
                        $image = trim($news['image_path'] ?? '');
                        $views = intval($news['views'] ?? 0);
                        $newsId = intval($news['id'] ?? 0);

                        $cardClass = match ($index) {
                            0 => 'news-masonry-large-left',
                            1 => 'news-masonry-small-top',
                            2 => 'news-masonry-small-bottom',
                            3 => 'news-masonry-large-right',
                        };

                        $dateText = !empty($news['created_at'])
                            ? date('d M Y', strtotime($news['created_at']))
                            : 'ไม่ระบุวันที่';
                        ?>

                        <article class="news-masonry-card fade-in-right <?= $cardClass ?>">

                            <!-- ภาพข่าว -->
                            <?php if ($image !== ''): ?>
                                <img
                                    src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>"
                                    alt="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>"
                                    class="news-masonry-image"
                                    loading="lazy">
                            <?php else: ?>
                                <div class="news-masonry-placeholder">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                            <?php endif; ?>

                            <!-- ไล่สีทับภาพ -->
                            <div class="news-masonry-overlay"></div>

                            <!-- วันที่ข่าว -->
                            <div class="news-masonry-date">
                                <i class="fa-regular fa-clock"></i>
                                <span><?= htmlspecialchars($dateText, ENT_QUOTES, 'UTF-8') ?></span>
                            </div>

                            <!-- รายละเอียดข่าวทุกการ์ด -->
                            <div class="news-masonry-content">

                                <span class="news-masonry-category">
                                    <?= htmlspecialchars($catLabel, ENT_QUOTES, 'UTF-8') ?>
                                </span>

                                <h4 class="news-masonry-title">
                                    <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>
                                </h4>

                                <p class="news-masonry-detail">
                                    <?= htmlspecialchars($detail, ENT_QUOTES, 'UTF-8') ?>
                                </p>

                                <div class="news-masonry-footer">
                                    <span class="news-masonry-views">
                                        <i class="fa-regular fa-eye"></i>
                                        <?= $views ?> ครั้ง
                                    </span>

                                    <a
                                        href="news.php?id=<?= $newsId ?>"
                                        class="news-masonry-button">
                                        อ่านเพิ่มเติม
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>

                            </div>

                        </article>

                    <?php endforeach; ?>

                </div>
            <?php endforeach; ?>

        <?php else: ?>

            <div class="news-masonry-empty">
                <i class="fa-regular fa-newspaper"></i>
                <p>ยังไม่มีข่าวประชาสัมพันธ์</p>
            </div>

        <?php endif; ?>

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
    </div>

    <div class="programs_f container" aria-label="ระดับชั้นและหลักสูตรการศึกษา">

        <!-- ตราโรงเรียนตรงกลาง -->
        <div class="hub ">
            <img src="assets/images/logo.png" alt="ตราโรงเรียน Maryvit Chainat School">
        </div>

        <!-- แผนกปฐมวัย (บนซ้าย) -->
        <article class="program program--tl">
            <div class="program__text">
                <h2>แผนกปฐมวัย</h2>
                <p>
                    ส่งเสริมพัฒนาการทั้ง 4 ด้าน <br>
                    ผ่านกิจกรรม Play-based Learning <br>
                    และปูพื้นฐานภาษาอังกฤษเบื้องต้น
                </p>
            </div>
            <figure class="program__image scale-in-center ">
                <!-- ใส่รูปจริงแทน: <img src="assets/kindergarten.jpg" alt="แผนกปฐมวัย"> -->
                <img src="assets/images/image4.jpg" alt="แผนกปฐมวัย">
            </figure>
        </article>

        <!-- แผนกประถมศึกษา (บนขวา) -->
        <article class="program program--tr">
            <figure class="program__image scale-in-center">
                <img src="assets/images/image5.jpg" alt="แผนกประถมศึกษา">
            </figure>
            <div class="program__text">
                <h2>แผนกประถมศึกษา</h2>
                <p>
                    สร้างพื้นฐานวิชาการที่แข็งแกร่ง <br>
                    เน้นการคิดวิเคราะห์ <br>
                    และทักษะการใช้ภาษาเพื่อการสื่อสาร
                </p>
            </div>
        </article>

        <!-- แผนกมัธยมศึกษา (ล่างซ้าย) -->
        <article class="program program--bl">
            <div class="program__text">
                <h2>แผนกมัธยมศึกษา</h2>
                <p>
                    เตรียมนักเรียนสู่มหาวิทยาลัยชั้นนำ <br>
                    เน้น IEP (Intensive English) <br>
                    และแผนการเรียนวิทย์-คณิต/ภาษา
                </p>
            </div>
            <figure class="program__image scale-in-center">
                <img src="assets/images/image6.jpg" alt="แผนกมัธยมศึกษา">
            </figure>
        </article>

        <!-- ภาษาต่างประเทศ (ล่างขวา) -->
        <article class="program program--br">
            <figure class="program__image scale-in-center">
                <img src="assets/images/image7.png" alt="ภาษาต่างประเทศ">
            </figure>
            <div class="program__text">
                <h2>ภาษาต่างประเทศ</h2>
                <p>
                    จัดการเรียนการสอนภาษาอังกฤษและ <br>
                    ภาษาจีน <br>
                    โดยคุณครูชาวต่างชาติเจ้าของภาษา <br>
                    (Native Speakers)
                </p>
            </div>
        </article>
    </div>

</section>
<script src="assets/js/main.js"></script>
<script src="assets/js/new_home.js"></script>

<?php include 'footer.php'; ?>
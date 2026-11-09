<?php
$pageTitle = "เกี่ยวกับเรา | โรงเรียนมารีวิทย์ชัยนาท (Maryvit Chainat School)";
$currentPage = "about";
include 'header.php';
?>
<style>
    /* ========================================
   1. GLOBAL VARIABLES
    ======================================== */
    :root {
        --page: #e6e6e6;
        --stage: #ffffff;
        --card: #f5f5f5;

        --wave: url('assets/images/wave-header.svg');
        --gold: #FCD34D;

        --ab-overlap: max(7vw, 52px);
        box-sizing: border-box;
    }

    /* ========================================
   2. TOP HERO / WAVE
    ======================================== */
    .ab-hero {
        position: relative;
        z-index: 2;
        margin-top: calc(-1 * var(--ab-overlap));
        width: 100%;
        aspect-ratio: 1558 / 511;
        min-height: 330px;
        background: var(--wave) center / cover no-repeat;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
        padding:
            calc(var(--ab-overlap) * .9) 20px calc(var(--ab-overlap) * .9 + max(3.6vw, 36px));
        pointer-events: none;
    }

    .ab-hero>* {
        position: relative;
        z-index: 1;
        max-width: 100%;
        pointer-events: auto;
    }

    /* ===== Gallery Filter ===== */
    .gallery-filter {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        margin: 35px 0;
    }

    .filter-btn {
        min-width: 195px;
        height: 56px;
        padding: 0 25px;
        border: 2px solid var(--primary-green);
        border-radius: 50px;
        background: var(--white);
        color: var(--primary-green);
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
    }

    .filter-btn:hover {
        background: var(--light-green);
        border-color: var(--accent-green);
        color: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: var(--shadow-sm);
    }

    .filter-btn.active {
        background: var(--primary-green);
        border-color: var(--primary-green);
        color: var(--white);
        box-shadow: var(--shadow-md);
    }

    .filter-btn:focus-visible {
        outline: 3px solid var(--accent-gold);
        outline-offset: 4px;
    }

    /* Animation ตอนกรองภาพ */
    .gallery-card {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .gallery-card.filter-hidden {
        display: none;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .gallery-filter {
            gap: 10px;
            margin: 25px 0;
            padding: 0 15px;
        }

        .filter-btn {
            min-width: calc(50% - 5px);
            height: 48px;
            padding: 0 8px;
            font-size: 13px;
        }
    }

    /* ===== ประวัติโรงเรียน ===== */
    .history-header {
        gap: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 35px;
        padding-bottom: 15px;
    }

    .section-content {
        position: relative;
        isolation: isolate;
    }

    .section-content img {
        width: 100%;
        height: auto;
        display: block;

    }

    :root {
        --gr: #2E863C;
        --gr-d: #1f6a2d;
        --gold: #FCD34D;
        --ab-ink: #1f2937;
        --ab-mute: #5b6472
    }

    /* ========================================
   ABOUT CARDS
    ======================================== */

    .ab-wrap {
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .ab-pils {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 40px;
        padding-top: 90px;
        padding-bottom: 45px;
    }

    /* การ์ด */
    .ab-card {
        position: relative;
        background: #fff;
        color: var(--ab-ink);
        border-radius: 20px;
        padding: 88px 25px 35px;
        text-align: center;
        min-height: 315px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .12);
        transition: transform .3s ease, box-shadow .3s ease;
    }

    /* วงกลมไอคอน */
    .ab-card-icon {
        position: absolute;
        top: -72px;
        left: 50%;
        transform: translateX(-50%);
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: linear-gradient(135deg, #26752e, #4eae49);
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        box-shadow: 0 8px 12px rgba(0, 0, 0, .25);
        z-index: 2;
    }

    /* สัญลักษณ์ภายในวงกลม */
    .ab-card-icon i {
        font-size: 55px;
        color: #fff;
    }

    /* หัวข้อ */
    .ab-card h3 {
        font-family: 'Prompt', sans-serif;
        color: var(--gr);
        font-size: 1.65rem;
        font-weight: 700;
        line-height: 1.4;
        margin: 0 0 18px;
    }

    /* รายละเอียด */
    .ab-card p {
        font-family: 'Prompt', sans-serif;
        font-size: 1rem;
        line-height: 1.75;
        color: #333;
        margin: 0;
    }

    /* พื้นหลังส่วนการ์ด */
    .ab-band {
        background: linear-gradient(180deg,
                #f3f6f3 0%,
                #2e863c 100%);
        color: #fff;
        padding: 0;
    }


    /* Tablet */
    @media (max-width: 900px) {
        .ab-pils {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 90px 25px;
        }
    }

    /* Mobile */
    @media (max-width: 576px) {
        .ab-pils {
            grid-template-columns: 1fr;
            gap: 90px;
            padding: 90px 25px 50px;
        }

        .ab-card {
            min-height: 300px;
            padding: 88px 22px 30px;
        }

        .ab-card-icon {
            width: 125px;
            height: 125px;
            top: -63px;
        }

        .ab-card-icon i {
            font-size: 48px;
        }

        .ab-card h3 {
            font-size: 1.5rem;
        }

        .ab-card p {
            font-size: .95rem;
        }
    }

    /* ========================================
   3. IMAGE WALL
    ======================================== */
    .wrap {
        position: relative;
        z-index: 1;

        width: 100%;
        max-width: none;
        margin: 0;
        padding: 0;

        container-type: inline-size;
        box-sizing: border-box;
    }

    .stage {
        --u: calc(100cqw / 1558);

        position: relative;
        width: 100%;
        aspect-ratio: 1558 / 508;
        overflow: hidden;
    }

    /* ภาพหลักตรงกลาง */
    .center {
        position: absolute;

        left: calc(410 * var(--u));
        top: calc(27 * var(--u));

        width: calc(738 * var(--u));
        height: calc(449 * var(--u));

        border-radius: calc(16 * var(--u));

        background: var(--card) center / cover no-repeat;

        box-shadow:
            calc(2 * var(--u)) calc(4 * var(--u)) calc(7 * var(--u)) rgba(0, 0, 0, .3);

        z-index: 2;
    }

    /* คอลัมน์ภาพเล็ก 4 คอลัมน์ */
    .col {
        position: absolute;
        top: 0;
        left: calc(var(--x) * var(--u));

        width: calc(228 * var(--u));
        height: 100%;
    }

    .track {
        will-change: transform;
    }

    /* การ์ดภาพเล็ก */
    .card {
        height: calc(var(--h) * var(--u));
        margin-bottom: calc(26 * var(--u));

        border-radius: calc(16 * var(--u));

        background: var(--card) center / cover no-repeat;

        box-shadow:
            calc(2 * var(--u)) calc(4 * var(--u)) calc(6 * var(--u)) rgba(0, 0, 0, .3);
    }

    .card:focus-visible {
        outline: 3px solid #fff;
        outline-offset: 3px;
    }

    /* ========================================
   4. GALLERY SECTION
    ======================================== */
    .gallery-section {
        width: 100%;
        padding: 60px 4%;
        background: #f8fafc;
    }

    .gallery-heading {
        text-align: center;
        margin-bottom: 35px;
    }

    .gallery-heading h2 {
        color: #0B6623;
        font-size: 2rem;
        font-weight: 700;
    }

    .gallery-heading p {
        color: #6b7280;
        margin-top: 8px;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
        width: 100%;
    }

    /* ========================================
   5. GALLERY CARD
    ======================================== */
    .gallery-card {
        position: relative;
        overflow: hidden;

        border-radius: 16px;
        background: #fff;

        box-shadow: 0 5px 18px rgba(0, 0, 0, .09);

        cursor: pointer;
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .gallery-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, .15);
    }

    .gallery-card img {
        display: block;
        width: 100%;
        height: 250px;

        object-fit: cover;

        transition: transform .5s ease;
    }

    .gallery-card:hover img {
        transform: scale(1.08);
    }

    .gallery-card-content {
        padding: 16px 18px;
    }

    .gallery-card-content h3 {
        font-size: 1rem;
        color: #0B6623;
        margin-bottom: 5px;
    }

    .gallery-card-content p {
        font-size: .85rem;
        color: #6b7280;
    }

    /* Overlay */
    .gallery-overlay {
        position: absolute;
        inset: 0;

        display: flex;
        justify-content: center;
        align-items: center;

        background: rgba(6, 64, 22, .45);

        opacity: 0;
        transition: opacity .3s ease;
    }

    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-overlay i {
        color: white;
        font-size: 2rem;
    }

    /* ========================================
   6. GALLERY SCROLL ANIMATION
    ======================================== */
    @keyframes gallery-slide-in {
        from {
            scale: .85;
            rotate: calc(var(--side, 1) * (5deg * var(--amp, 1)));
        }

        to {
            scale: 1;
            rotate: 0deg;
        }
    }

    @supports (animation-timeline: view()) {
        @media (prefers-reduced-motion: no-preference) {
            .gallery-card-animation {
                animation: gallery-slide-in linear both;
                animation-timeline: view();
                animation-range: cover 0% contain 15%;
            }
        }
    }

    /* ค่าเริ่มต้น */
    .gallery-grid>.gallery-card-animation:nth-child(2n + 1) {
        transform-origin: 25vw 100%;
        --side: -1;
    }

    .gallery-grid>.gallery-card-animation:nth-child(2n) {
        transform-origin: -25vw 100%;
        --side: 1;
    }

    /* Tablet และ Desktop */
    @media (min-width: 720px) {
        .gallery-grid>.gallery-card-animation:nth-child(4n + 1) {
            transform-origin: 50vw 100%;
            --side: -1;
            --amp: 2;
        }

        .gallery-grid>.gallery-card-animation:nth-child(4n + 2) {
            transform-origin: 25vw 100%;
            --side: -1;
        }

        .gallery-grid>.gallery-card-animation:nth-child(4n + 3) {
            transform-origin: -25vw 100%;
            --side: 1;
        }

        .gallery-grid>.gallery-card-animation:nth-child(4n) {
            transform-origin: -50vw 100%;
            --side: 1;
            --amp: 2;
        }
    }

    /* หน้าจอขนาดใหญ่ */
    @media (min-width: 1200px) {
        .gallery-grid>.gallery-card-animation:nth-child(6n + 1) {
            transform-origin: 75vw 100%;
            --side: -1;
            --amp: 3;
        }

        .gallery-grid>.gallery-card-animation:nth-child(6n + 2) {
            transform-origin: 50vw 100%;
            --side: -1;
            --amp: 2;
        }

        .gallery-grid>.gallery-card-animation:nth-child(6n + 3) {
            transform-origin: 25vw 100%;
            --side: -1;
        }

        .gallery-grid>.gallery-card-animation:nth-child(6n + 4) {
            transform-origin: -25vw 100%;
            --side: 1;
        }

        .gallery-grid>.gallery-card-animation:nth-child(6n + 5) {
            transform-origin: -50vw 100%;
            --side: 1;
            --amp: 2;
        }

        .gallery-grid>.gallery-card-animation:nth-child(6n) {
            transform-origin: -75vw 100%;
            --side: 1;
            --amp: 3;
        }
    }

    /* จอขนาดใหญ่มาก */
    @media (min-width: 1920px) {
        .gallery-grid>.gallery-card-animation:nth-child(8n + 1) {
            transform-origin: 100vw 100%;
            --side: -1;
            --amp: 4;
        }

        .gallery-grid>.gallery-card-animation:nth-child(8n + 2) {
            transform-origin: 75vw 100%;
            --side: -1;
            --amp: 3;
        }

        .gallery-grid>.gallery-card-animation:nth-child(8n + 3) {
            transform-origin: 50vw 100%;
            --side: -1;
            --amp: 2;
        }

        .gallery-grid>.gallery-card-animation:nth-child(8n + 4) {
            transform-origin: 25vw 100%;
            --side: -1;
        }

        .gallery-grid>.gallery-card-animation:nth-child(8n + 5) {
            transform-origin: -25vw 100%;
            --side: 1;
        }

        .gallery-grid>.gallery-card-animation:nth-child(8n + 6) {
            transform-origin: -50vw 100%;
            --side: 1;
            --amp: 2;
        }

        .gallery-grid>.gallery-card-animation:nth-child(8n + 7) {
            transform-origin: -75vw 100%;
            --side: 1;
            --amp: 3;
        }

        .gallery-grid>.gallery-card-animation:nth-child(8n) {
            transform-origin: -100vw 100%;
            --side: 1;
            --amp: 4;
        }
    }

    /* ========================================
   7. GALLERY LIGHTBOX
    ======================================== */
    .gallery-lightbox {
        position: fixed;
        inset: 0;
        z-index: 9999;

        display: none;
        justify-content: center;
        align-items: center;

        padding: 30px;
        background: rgba(0, 0, 0, .9);
    }

    .gallery-lightbox.active {
        display: flex;
    }

    .gallery-lightbox img {
        max-width: 90%;
        max-height: 85vh;

        object-fit: contain;
        border-radius: 10px;
    }

    .gallery-close {
        position: absolute;
        top: 20px;
        right: 30px;

        color: white;
        font-size: 35px;

        cursor: pointer;
        background: none;
        border: none;
    }

    /* ========================================
   8. RESPONSIVE
    ======================================== */

    /* Tablet */
    @media (max-width: 992px) {
        .gallery-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    /* Mobile */
    @media (max-width: 576px) {
        .gallery-section {
            padding: 40px 5%;
        }

        .gallery-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .gallery-card img {
            height: 230px;
        }
    }

    /* ========================================
   9. VISION & MISSION
    ======================================== */

    .ab-sec {
        padding: clamp(40px, 6vw, 80px) 0;
        font-family: 'Sarabun', 'Prompt', sans-serif;
        color: var(--ab-ink);
    }

    /* หัวข้อหลัก */
    .ab-h {
        font-family: 'Prompt', sans-serif;
        font-size: clamp(1.6rem, 3.4vw, 2.4rem);
        font-weight: 700;
        color: var(--gr);
        line-height: 1.25;
        border-left: 8px solid #f59e0b;
        padding-left: 14px;
        margin-bottom: 32px;
    }

    /* โครงสร้างสองคอลัมน์ */
    .ab-mission {
        display: grid;
        grid-template-columns: .8fr 1.2fr;
        gap: clamp(24px, 4vw, 56px);
        align-items: start;
    }

    /* กลุ่มการ์ดด้านขวา */
    .ab-stack {
        display: grid;
        gap: 26px;
    }

    /* การ์ดแต่ละรายการ */
    .ab-row {
        display: flex;
        gap: 20px;
        align-items: center;
        background: #fff;
        border-radius: 24px;
        padding: 22px 28px;
        box-shadow: 0 6px 0 #237a62,
            0 12px 24px rgba(0, 0, 0, .10);
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .ab-row:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 0 #237a62,
            0 16px 28px rgba(0, 0, 0, .13);
    }

    /* ไอคอน */
    .ab-ico {
        position: relative;
        flex: 0 0 76px;
        width: 76px;
        height: 76px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gr-d), #3aa64b);
        /* border: 4px solid #fff; */
        color: #fff;
        display: grid;
        place-items: center;
        box-shadow: 0 5px 12px rgba(0, 0, 0, .18);
    }

    /* หัวข้อในการ์ด */
    .ab-row h3 {
        font-family: 'Prompt', sans-serif;
        color: var(--gr);
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0 0 8px;
    }

    /* เนื้อหา */
    .ab-row p,
    .ab-row li {
        font-size: 1rem;
        line-height: 1.7;
        color: #374151;
    }

    .ab-row p {
        margin: 0;
    }

    .ab-row ul {
        padding-left: 20px;
        margin: 0;
    }

    .ab-row li::marker {
        color: #f59e0b;
    }

    /* ภาพประกอบ */
    .ab-ph {
        position: relative;
        margin: 0;
        aspect-ratio: 4 / 5;
        overflow: hidden;
        border-radius: 20px;
        background: repeating-linear-gradient(135deg,
                #1d5a33 0 14px,
                #226a3b 14px 28px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, .12);
    }

    .ab-ph img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }

    /* ข้อความกรณีไม่มีรูป */
    .ab-ph figcaption {
        position: absolute;
        inset: 0;
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 16px;
        text-align: center;
        color: #d6efdc;
        font-size: .85rem;
    }

    .ab-ph.no-image figcaption {
        display: flex;
    }

    .ab-ph figcaption b {
        background: rgba(0, 0, 0, .3);
        padding: 2px 10px;
        border-radius: 99px;
        font-size: .78rem;
    }

    /* ========================================
   10. VISION & MISSION RESPONSIVE
    ======================================== */

    /* Tablet */
    @media (max-width: 900px) {
        .ab-mission {
            grid-template-columns: 1fr;
        }

        .ab-ph {
            max-width: 520px;
            width: 100%;
            margin: 0 auto;
        }
    }

    /* Mobile */
    @media (max-width: 520px) {
        .ab-row {
            flex-direction: column;
            text-align: center;
            border-radius: 24px;
            padding: 25px 20px;
        }

        .ab-row ul {
            text-align: left;
        }

        .ab-row h3 {
            font-size: 1.2rem;
        }

        .ab-row p,
        .ab-row li {
            font-size: .95rem;
        }
    }

    /* ===== About: History Section ===== */

    .ab-sec {
        padding: clamp(40px, 6vw, 80px) 0;
        font-family: 'Sarabun', 'Prompt', sans-serif;
        color: var(--ab-ink);
    }

    .ab-wrap {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .ab-hist {
        display: grid;
        grid-template-columns: 1.3fr 1fr;
        gap: clamp(24px, 5vw, 64px);
        align-items: center;
    }

    .ab-h {
        font-family: 'Prompt', sans-serif;
        font-size: clamp(1.6rem, 3.4vw, 2.4rem);
        font-weight: 700;
        color: var(--gr);
        line-height: 1.25;
        border-left: 8px solid #f59e0b;
        padding-left: 14px;
        margin-bottom: 18px;
    }

    .ab-hist p {
        line-height: 1.85;
        font-size: 1.05rem;
        margin-bottom: 14px;
    }

    .ab-quote {
        background: #eaf6ed;
        border-left: 5px solid var(--gr);
        padding: 16px 20px;
        border-radius: 0 12px 12px 0;
        color: var(--gr-d);
        font-weight: 500;
        line-height: 1.7;
        margin: 18px 0;
    }

    .ab-emb {
        text-align: center;
    }

    .ab-emb img {
        width: min(300px, 70%);
        height: auto;
    }

    .ab-emb h3 {
        font-family: 'Prompt', sans-serif;
        color: var(--gr);
        margin: 12px 0 6px;
        font-size: 1.3rem;
    }

    .ab-emb p {
        color: var(--ab-mute);
        font-size: .95rem;
        line-height: 1.6;
    }

    .ab-colors {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        margin-top: 14px;
        font-size: .95rem;
    }

    .ab-colors i {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: var(--gr);
        display: inline-block;
    }

    .ab-colors i:first-child {
        background: #fff;
        border: 2px solid #cbd5d0;
    }

    /* ===== Responsive ===== */

    @media (max-width: 900px) {
        .ab-hist {
            grid-template-columns: 1fr;
        }

        .ab-emb {
            margin-top: 15px;
        }
    }

    @media (max-width: 520px) {
        .ab-hist p {
            font-size: .95rem;
        }

        .ab-h {
            font-size: 1.6rem;
        }

        .ab-emb img {
            width: min(260px, 75%);
        }
    }
</style>
<section class="ab-band" style="margin: 0 auto;">
    <!-- ===== Image Wall: คงโครงสร้างเดิม ===== -->
    <div class="wrap">
        <div class="stage" id="stage">
            <div
                class="center"
                id="center"
                role="img"
                aria-label="ภาพที่เลือก"
                loading="lazy"
                onerror="this.parentElement.classList.add('no-image');this.remove()">
            </div>
        </div>
    </div>
</section>

<section class="ab-hero">
    <div>
        <a href="test_index.php">
            <icon class="fas fa-home"></icon> หน้าแรก
        </a> / <a href="test_about.php" class="active" style="color: var(--gold); font-weight: bold;">เกี่ยวกับเรา</a>
    </div>
    <div class="hero-title" style="margin-top: 10px;">
        <h2>รู้จัก <span>โรงเรียนมารีวิทย์ชัยนาท</span></h2>
    </div>
    <p>สถาบันการศึกษาในเครือมารีวิทย์ มุ่งสร้างสรรค์เยาวชนให้มีความรู้ มีวินัย มีคุณธรรม จริยธรรม</p>
    <p>ควบคู่ทักษะภาษาและเทคโนโลยีเพื่อก้าวสู่สากล</p>
</section>

<!-- ===== ประวัติและความเป็นมา ===== -->
<section class="ab-sec">
    <div class="ab-wrap ab-hist">

        <!-- ฝั่งซ้าย: เนื้อหา -->
        <div>
            <h2 class="ab-h">ประวัติและความเป็นมา</h2>

            <p>
                <b>โรงเรียนมารีวิทย์ ชัยนาท</b>
                เป็นส่วนหนึ่งของเครือข่ายสถานศึกษาเอกชนคาทอลิกชั้นนำ
                "เครือโรงเรียนมารีวิทย์" ซึ่งมีจุดเริ่มต้นและศูนย์กลางแห่งความสำเร็จอยู่ที่
                โรงเรียนมารีวิทย์ พัทยา และขยายสาขาสู่ สัตหีบ, บ่อวิน, ระยอง และ ชัยนาท
            </p>

            <div class="ab-quote">
                <i class="fa-solid fa-quote-left"></i>
                "การเรียนรู้ไม่ใช่เพียงการสะสมความรู้ แต่ต้องปลูกฝังจริยธรรมและความรับผิดชอบในตนเอง
                วินัยคือรากฐานสำคัญของการพัฒนาอย่างยั่งยืน"
            </div>

            <p>
                <b>โรงเรียนมารีวิทย์ ชัยนาท</b>
                ก่อตั้งขึ้นเพื่อส่งต่อมาตรฐานการศึกษาชั้นเลิศสู่เยาวชนในลุ่มน้ำเจ้าพระยาและภาคกลาง
                โดยนำหลักสูตรเข้มข้น นวัตกรรมการเรียนการสอนที่ทันสมัย
                ตลอดจนบุคลากรผู้ทรงคุณวุฒิ มาหล่อหลอมนักเรียนให้เป็นคนเก่ง คนดี และมีความสุข
            </p>
        </div>

        <!-- ฝั่งขวา: ตราสัญลักษณ์ -->
        <div class="ab-emb">
            <img
                src="assets/images/logo.png"
                alt="ตราสัญลักษณ์โรงเรียนมารีวิทย์ชัยนาท"
                loading="lazy"
                onerror="this.style.display='none'">

            <h3>ตราสัญลักษณ์ของเรา</h3>

            <p>
                สะท้อนเอกลักษณ์ ความสามัคคี และแนวทางคุณธรรม
                ตามแบบพระแม่มารี
            </p>

            <div class="ab-colors">
                <i></i>
                <i></i>
                <span>สีประจำโรงเรียน: ขาว – เขียว</span>
            </div>
        </div>

    </div>
</section>

<section class="bg-section" style="padding-top: 90px; padding-bottom: 90px;">
    <div class="ab-wrap ab-pils">

        <div class="ab-card">
            <div class="ab-card-icon">
                <i class="fas fa-book"></i>
            </div>
            <h3>ปรัชญาและ<br>อัตลักษณ์มารีวิทย์</h3>
            <p>"ความรู้ คู่คุณธรรม นำวินัย"
                จัดการศึกษาอย่างสมดุล
                บ่มเพาะสติปัญญาและจิตใจตามแนวทางคุณธรรม
                เพื่อสร้างผู้นำรุ่นใหม่ที่พร้อมพัฒนาสังคม
            </p>
        </div>

        <div class="ab-card">
            <div class="ab-card-icon">
                <i class="fas fa-globe"></i>
            </div>
            <h3>Global Mindset</h3>
            <p>เรียนภาษาอังกฤษและภาษาจีนกับครูต่างชาติ Native Speakers ตั้งแต่วัยเยาว์</p>
        </div>

        <div class="ab-card">
            <div class="ab-card-icon">
                <i class="fas fa-laptop"></i>
            </div>
            <h3>Digital Learning</h3>
            <p>ระบบ Schoology, จอ Interactive Screen และการเรียนรู้แบบ Project Approach</p>
        </div>
    </div>
</section>

<section class="ab-sec">
    <div class="ab-wrap">

        <h2 class="ab-h">
            วิสัยทัศน์ <span style="color:#f59e0b">&amp;</span> พันธกิจองค์กร
        </h2>

        <div class="ab-mission">

            <!-- ภาพประกอบด้านซ้าย -->
            <figure class="ab-ph">
                <img
                    src="assets/images/about-mission.jpg"
                    alt="ภาพกิจกรรมของโรงเรียน"
                    loading="lazy"
                    onerror="this.parentElement.classList.add('no-image');this.remove()">

                <figcaption>
                    <b>about-mission.jpg</b>
                    ภาพนักเรียนและครูในกิจกรรมของโรงเรียน
                </figcaption>
            </figure>

            <!-- เนื้อหาด้านขวา -->
            <div class="ab-stack">

                <!-- Vision -->
                <div class="ab-row">
                    <icon class="ab-ico">
                        <i class="fas fa-compass"></i>
                    </icon>
                    <div>
                        <h3>วิสัยทัศน์ (Vision)</h3>
                        <p>
                            เป็นองค์กรแห่งการเรียนรู้ มุ่งสู่ความเป็นเลิศด้านวิชาการ
                            ปลูกฝังระเบียบวินัย เชิดชูคุณธรรม และเตรียมนักเรียน
                            ให้พร้อมรับการเปลี่ยนแปลงของโลกยุคใหม่อย่างสง่างาม
                        </p>
                    </div>
                </div>

                <!-- Core Values -->
                <div class="ab-row">
                    <icon class="ab-ico">
                        <i class="fas fa-bullseye"></i>
                    </icon>
                    <div>
                        <h3>ค่านิยมหลัก (Core Values)</h3>
                        <ul>
                            <li>Academic Excellence: ความเป็นเลิศทางวิชาการ</li>
                            <li>Discipline &amp; Integrity: มีวินัยและซื่อสัตย์สุจริต</li>
                            <li>Innovation: ส่งเสริมนวัตกรรมและความคิดสร้างสรรค์</li>
                            <li>Global Perspective: ทัศนคติระดับสากล</li>
                        </ul>
                    </div>
                </div>

                <!-- Mission -->
                <div class="ab-row">
                    <icon class="ab-ico">
                        <i class="fas fa-bullseye"></i>
                    </icon>

                    <div>
                        <h3>พันธกิจ (Mission)</h3>
                        <ul>
                            <li>ยกระดับหลักสูตรวิชาการ ภาษาต่างประเทศ และ STEM</li>
                            <li>นำเทคโนโลยีสารสนเทศและ e-Learning มาใช้เต็มรูปแบบ</li>
                            <li>ปลูกฝังคุณลักษณะ "วิชาดี มีวินัย ใฝ่คุณธรรม"</li>
                            <li>ส่งเสริมความร่วมมือระหว่างโรงเรียน ครอบครัว และชุมชน</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<div>
    <img src="assets/images/wave-bottom.svg" alt="เส้นคลื่นด้านล่าง" style="width: 100%; display: block; margin-top: -1px;">
</div>

<section class="gallery-section">

    <div class="gallery-heading">
        <h2>ภาพกิจกรรมและบรรยากาศโรงเรียน</h2>
        <p>ประมวลภาพความทรงจำและกิจกรรมต่าง ๆ ของโรงเรียนมารีวิทย์ชัยนาท</p>
    </div>

    <div class="gallery-filter">
        <button class="filter-btn active" data-filter="all">ทั้งหมด</button>
        <button class="filter-btn" data-filter="academic">วิชาการ & ภาษา</button>
        <button class="filter-btn" data-filter="activity">กีฬา & กิจกรรม</button>
        <button class="filter-btn" data-filter="atmosphere">บรรยากาศโรงเรียน</button>
    </div>

    <div class="gallery-grid">

        <!-- บรรยากาศโรงเรียน -->
        <div class="gallery-card gallery-card-animation" data-category="atmosphere" onclick="openGallery(this)">
            <img src="assets/images/image1.jpg" alt="ภาพกิจกรรมโรงเรียน">
            <div class="gallery-overlay">
                <i class="fa-solid fa-magnifying-glass-plus"></i>
            </div>
            <div class="gallery-card-content">
                <h3>บรรยากาศโรงเรียน</h3>
                <p>ภาพบรรยากาศภายในโรงเรียนมารีวิทย์ชัยนาท</p>
            </div>
        </div>

        <!-- วิชาการ & ภาษา -->
        <div class="gallery-card gallery-card-animation" data-category="academic" onclick="openGallery(this)">
            <img src="assets/images/image4.jpg" alt="กิจกรรมโรงเรียน">
            <div class="gallery-overlay">
                <i class="fa-solid fa-magnifying-glass-plus"></i>
            </div>
            <div class="gallery-card-content">
                <h3>กิจกรรมการเรียนรู้</h3>
                <p>ส่งเสริมประสบการณ์และทักษะของนักเรียน</p>
            </div>
        </div>

        <!-- กีฬา & กิจกรรม -->
        <div class="gallery-card gallery-card-animation" data-category="activity" onclick="openGallery(this)">
            <img src="assets/images/image5.jpg" alt="ภาพกิจกรรม">
            <div class="gallery-overlay">
                <i class="fa-solid fa-magnifying-glass-plus"></i>
            </div>
            <div class="gallery-card-content">
                <h3>กิจกรรมภายในโรงเรียน</h3>
                <p>ภาพกิจกรรมและความประทับใจ</p>
            </div>
        </div>

        <!-- บรรยากาศโรงเรียน -->
        <div class="gallery-card gallery-card-animation" data-category="atmosphere" onclick="openGallery(this)">
            <img src="assets/images/image6.jpg" alt="ภาพนักเรียน">
            <div class="gallery-overlay">
                <i class="fa-solid fa-magnifying-glass-plus"></i>
            </div>
            <div class="gallery-card-content">
                <h3>ชีวิตในรั้วโรงเรียน</h3>
                <p>การเรียนรู้และการใช้ชีวิตร่วมกัน</p>
            </div>
        </div>

        <!-- กีฬา & กิจกรรม -->
        <div class="gallery-card gallery-card-animation" data-category="activity" onclick="openGallery(this)">
            <img src="assets/images/image7.jpg" alt="ภาพกิจกรรม">
            <div class="gallery-overlay">
                <i class="fa-solid fa-magnifying-glass-plus"></i>
            </div>
            <div class="gallery-card-content">
                <h3>กิจกรรมพัฒนาผู้เรียน</h3>
                <p>เสริมสร้างศักยภาพและความสามารถ</p>
            </div>
        </div>

        <!-- กีฬา & กิจกรรม -->
        <div class="gallery-card gallery-card-animation" data-category="activity" onclick="openGallery(this)">
            <img src="assets/images/image8.jpg" alt="ภาพโรงเรียน">
            <div class="gallery-overlay">
                <i class="fa-solid fa-magnifying-glass-plus"></i>
            </div>
            <div class="gallery-card-content">
                <h3>ความภาคภูมิใจ</h3>
                <p>ความทรงจำและความสำเร็จของนักเรียน</p>
            </div>
        </div>

        <!-- บรรยากาศโรงเรียน -->
        <div class="gallery-card gallery-card-animation" data-category="atmosphere" onclick="openGallery(this)">
            <img src="assets/images/image9.jpg" alt="ภาพกิจกรรม">
            <div class="gallery-overlay">
                <i class="fa-solid fa-magnifying-glass-plus"></i>
            </div>
            <div class="gallery-card-content">
                <h3>ภาพแห่งความประทับใจ</h3>
                <p>อีกหนึ่งความทรงจำที่สวยงาม</p>
            </div>
        </div>

    </div>
</section>


<!-- Image Lightbox -->
<div class="gallery-lightbox" id="galleryLightbox"
    onclick="closeGallery(event)">

    <button class="gallery-close"
        onclick="closeGallery(event)"
        aria-label="ปิดภาพ">
        &times;
    </button>

    <img id="galleryPreview" src="" alt="ภาพขนาดใหญ่">

</div>

<script src="assets/js/main.js"></script>
<script>
    // ===== 1) รายการรูปภาพ =====
    const IMAGES = [
        "assets/images/image1.jpg",
        "assets/images/image4.jpg",
        "assets/images/image5.jpg",
        "assets/images/image6.jpg",
        "assets/images/image7.jpg",
        "assets/images/image8.jpg",
        "assets/images/image9.jpg",
    ];

    // ===== 2) ตำแหน่งและความเร็วของคอลัมน์ =====
    // คงค่าเดิมทั้งหมด ไม่เปลี่ยนตำแหน่งการ์ด
    const COLS = [{
            x: -106,
            speed: 34,
            start: 49,
            heights: [297, 297, 297, 297]
        },
        {
            x: 152,
            speed: 26,
            start: 199,
            heights: [297, 297, 297, 297]
        },
        {
            x: 1178,
            speed: 30,
            start: 189,
            heights: [297, 297, 297, 297]
        },
        {
            x: 1436,
            speed: 38,
            start: 28,
            heights: [297, 297, 297, 297]
        }
    ];

    const stage = document.getElementById("stage");
    const center = document.getElementById("center");
    const REF_W = 1558;

    // สร้างภาพตัวอย่างเมื่อยังไม่ได้ใส่รูปจริง
    function placeholder(i) {
        const h = (i * 47) % 360;

        const svg = `
            <svg xmlns="http://www.w3.org/2000/svg" width="600" height="600">
                <defs>
                    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0" stop-color="hsl(${h},70%,62%)"/>
                        <stop offset="1" stop-color="hsl(${(h + 50) % 360},70%,40%)"/>
                    </linearGradient>
                </defs>
                <rect width="600" height="600" fill="url(#g)"/>
                <text x="300" y="340" font-size="160"
                     fill="#fff"
                    fill-opacity=".85" text-anchor="middle">${i + 1}</text>
            </svg>`;

        return "data:image/svg+xml;charset=utf-8," + encodeURIComponent(svg);
    }

    const srcOf = i =>
        IMAGES.length ? IMAGES[i % IMAGES.length] : placeholder(i);

    // ===== 3) เปลี่ยนภาพหลักเมื่อคลิกการ์ด =====
    function show(src) {
        center.style.backgroundImage = `url("${src}")`;

        if (typeof center.animate === "function") {
            center.animate(
                [{
                    opacity: 0.4
                }, {
                    opacity: 1
                }], {
                    duration: 250
                }
            );
        }
    }

    show(srcOf(0));

    // ===== 4) สร้างคอลัมน์และทำซ้ำ 2 ชุด =====
    const cols = COLS.map((c, ci) => {
        const col = document.createElement("div");
        col.className = "col";
        col.style.setProperty("--x", c.x);

        const track = document.createElement("div");
        track.className = "track";
        col.appendChild(track);

        for (let copy = 0; copy < 2; copy++) {
            c.heights.forEach((h, k) => {
                const src = srcOf(ci * c.heights.length + k + 1);

                const card = document.createElement("div");
                card.className = "card";
                card.tabIndex = 0;
                card.setAttribute("role", "button");
                card.setAttribute("aria-label", "เลือกภาพ");

                card.style.setProperty("--h", h);
                card.style.backgroundImage = `url("${src}")`;
                track.appendChild(card);
            });
        }

        stage.appendChild(col);

        return {
            ...c,
            track,
            n: c.heights.length,
            pos: c.start,
            setH: 1
        };
    });

    // ===== 5) วัดระยะของชุดภาพ =====
    function measure() {
        const u = stage.clientWidth / REF_W;

        if (!u) return;

        cols.forEach(c => {
            const kids = c.track.children;

            c.setH =
                (kids[c.n].offsetTop - kids[0].offsetTop) / u;

            if (!Number.isFinite(c.setH) || c.setH <= 0) {
                c.setH = 1;
            }

            c.pos %= c.setH;
        });
    }

    const resizeObserver = new ResizeObserver(measure);
    resizeObserver.observe(stage);
    measure();

    // ===== 6) เลื่อนขึ้นและวนซ้ำ =====
    let last = performance.now();

    function tick(now) {
        const dt = Math.min((now - last) / 1000, 0.1);
        last = now;

        const u = stage.clientWidth / REF_W;

        cols.forEach(c => {
            c.pos = (c.pos + c.speed * dt) % c.setH;

            c.track.style.transform =
                `translate3d(0, ${-c.pos * u}px, 0)`;
        });

        requestAnimationFrame(tick);
    }

    if (matchMedia("(prefers-reduced-motion: reduce)").matches) {
        cols.forEach(c => {
            c.track.style.transform =
                `translate3d(0, ${-c.pos * stage.clientWidth / REF_W}px, 0)`;
        });
    } else {
        requestAnimationFrame(tick);
    }
</script>
<script>
    // ===== Gallery Lightbox =====
    function openGallery(card) {
        const image = card.querySelector("img");
        const lightbox = document.getElementById("galleryLightbox");
        const preview = document.getElementById("galleryPreview");

        if (!image || !lightbox || !preview) return;

        preview.src = image.src;
        preview.alt = image.alt;

        lightbox.classList.add("active");
        document.body.style.overflow = "hidden";
    }

    function closeGallery(event) {
        const lightbox = document.getElementById("galleryLightbox");

        if (
            event.target === lightbox ||
            event.target.closest(".gallery-close")
        ) {
            lightbox.classList.remove("active");
            document.body.style.overflow = "";
        }
    }

    // ปิดภาพด้วยปุ่ม ESC
    document.addEventListener("keydown", function(event) {
        if (event.key === "Escape") {
            document.getElementById("galleryLightbox")
                .classList.remove("active");

            document.body.style.overflow = "";
        }
    });
</script>
<script>
    // ===== Gallery Filter =====
    document.addEventListener("DOMContentLoaded", function() {

        const filterButtons = document.querySelectorAll(".filter-btn");
        const galleryCards = document.querySelectorAll(".gallery-card");

        filterButtons.forEach(button => {

            button.addEventListener("click", function() {

                const filterValue = this.dataset.filter;

                // เปลี่ยนสถานะปุ่ม
                filterButtons.forEach(btn => {
                    btn.classList.remove("active");
                });

                this.classList.add("active");

                // กรองรูปภาพ
                galleryCards.forEach(card => {

                    const category = card.dataset.category;

                    if (filterValue === "all" || category === filterValue) {
                        card.classList.remove("filter-hidden");
                    } else {
                        card.classList.add("filter-hidden");
                    }

                });

            });

        });

    });
</script>
<?php include 'footer.php'; ?>
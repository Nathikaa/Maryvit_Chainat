/**
 * Frontend Global Scripts - Maryvit Chainat School
 */

// 1. Mobile Menu Toggle & Back to Top (Header & Footer)
document.addEventListener('DOMContentLoaded', () => {
    // Mobile Navigation Menu Toggle
    const toggleBtn = document.getElementById('mobile-toggle-btn');
    const navList = document.getElementById('nav-list');
    if (toggleBtn && navList) {
        toggleBtn.addEventListener('click', () => {
            navList.classList.toggle('active');
        });
    }

    // Back to Top Button & Scroll Progress Indicator
    const backToTopBtn = document.getElementById('backToTopBtn');
    const progressCircle = document.getElementById('scrollProgress');
    const circumference = 2 * Math.PI * 20;

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;

        if (backToTopBtn) {
            if (scrollTop > 300) {
                backToTopBtn.style.opacity = '1';
                backToTopBtn.style.visibility = 'visible';
                backToTopBtn.style.transform = 'translateY(0) scale(1)';
            } else {
                backToTopBtn.style.opacity = '0';
                backToTopBtn.style.visibility = 'hidden';
                backToTopBtn.style.transform = 'translateY(20px) scale(0.9)';
            }
        }

        if (docHeight > 0 && progressCircle) {
            const scrollPercent = scrollTop / docHeight;
            const offset = circumference - (scrollPercent * circumference);
            progressCircle.style.strokeDashoffset = offset;
        }
    });

    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Smooth Scroll for Internal Anchor Links (index.php)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId !== '#') {
                const targetEl = document.querySelector(targetId);
                if (targetEl) {
                    e.preventDefault();
                    targetEl.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // Contact Form Topic Selector Chips (contact.php)
    const chipBtns = document.querySelectorAll('.chip-btn');
    const topicInput = document.getElementById('selectedTopic');
    chipBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            chipBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            if (topicInput) topicInput.value = btn.getAttribute('data-topic');
        });
    });

    // Lightbox Modal Outside Click Listener (about.php)
    window.addEventListener('click', (e) => {
        const modal = document.getElementById('lightbox-modal');
        if (e.target === modal) {
            closeLightbox();
        }
    });

    // Auto-hide Toast Notification (admissions.php & contact.php)
    const toast = document.getElementById('toastMsg');
    if (toast && toast.style.display !== 'none' && toast.style.display !== '') {
        setTimeout(() => {
            toast.style.display = 'none';
        }, 5000);
    }
});

// 2. Gallery & Lightbox Functions (about.php)
function filterGallery(category) {
    const buttons = document.querySelectorAll('.filter-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    if (window.event && window.event.target) {
        window.event.target.classList.add('active');
    }

    const items = document.querySelectorAll('.photo-item');
    items.forEach(item => {
        if (category === 'all' || item.getAttribute('data-category') === category) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

function openLightbox(title, desc, bgGradient, iconClass) {
    const modal = document.getElementById('lightbox-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalDesc = document.getElementById('modal-desc');
    const modalBanner = document.getElementById('modal-banner');
    const modalIcon = document.getElementById('modal-icon');

    if (modal && modalTitle && modalDesc && modalBanner && modalIcon) {
        modalTitle.innerText = title;
        modalDesc.innerText = desc;
        modalBanner.style.background = bgGradient;
        modalIcon.className = `fa-solid ${iconClass} fa-4x`;
        modal.classList.add('active');
    }
}

function closeLightbox() {
    const modal = document.getElementById('lightbox-modal');
    if (modal) {
        modal.classList.remove('active');
    }
}

// 3. Tab Switching Function (curriculum.php)
function openTab(evt, tabId) {
    const tabPanes = document.querySelectorAll('.tab-pane');
    tabPanes.forEach(pane => pane.classList.remove('active'));

    const tabButtons = document.querySelectorAll('.tab-btn');
    tabButtons.forEach(btn => btn.classList.remove('active'));

    const activeTarget = document.getElementById(tabId);
    if (activeTarget) {
        activeTarget.classList.add('active');
    }
    if (evt && evt.currentTarget) {
        evt.currentTarget.classList.add('active');
    }
}

// 4. FAQ Accordion Toggle (admissions.php)
function toggleFaq(btn) {
    const item = btn.parentElement;
    if (item) {
        item.classList.toggle('open');
    }
}

// 5. Urgency Selection (contact.php)
function selectUrgency(element) {
    document.querySelectorAll('.urgency-card').forEach(card => card.classList.remove('selected'));
    element.classList.add('selected');
    const radio = element.querySelector('input[type="radio"]');
    if (radio) radio.checked = true;
}

// 6. News Filter & Search Functions (news.php)
function filterNews(category) {
    const buttons = document.querySelectorAll('.cat-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    if (window.event && window.event.target) {
        window.event.target.classList.add('active');
    }

    const cards = document.querySelectorAll('.news-card');
    cards.forEach(card => {
        if (category === 'all' || card.getAttribute('data-category') === category) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

function searchNews() {
    const inputEl = document.getElementById('newsSearch');
    if (!inputEl) return;
    const input = inputEl.value.toLowerCase();
    const cards = document.querySelectorAll('.news-card');

    cards.forEach(card => {
        const titleEl = card.querySelector('.news-heading');
        const detailEl = card.querySelector('.news-detail');
        const title = titleEl ? titleEl.innerText.toLowerCase() : '';
        const detail = detailEl ? detailEl.innerText.toLowerCase() : '';

        if (title.includes(input) || detail.includes(input)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}
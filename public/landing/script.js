// Ultra-simple script to ensure video plays on click
document.addEventListener('DOMContentLoaded', () => {
    const noticeModal = document.getElementById('temporaryNoticeModal');
    const closeNoticeModal = () => {
        if (!noticeModal) return;
        noticeModal.classList.remove('is-open');
        noticeModal.setAttribute('aria-hidden', 'true');
        document.body.style.removeProperty('overflow');
    };

    if (noticeModal) {
        noticeModal.classList.add('is-open');
        noticeModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        noticeModal.querySelectorAll('[data-close-notice]').forEach((element) => {
            element.addEventListener('click', closeNoticeModal);
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') closeNoticeModal();
        });
    }

    const doctorsTrack = document.getElementById('doctorsTrack');
    const doctorsPrev = document.querySelector('[data-doctors-prev]');
    const doctorsNext = document.querySelector('[data-doctors-next]');
    const getDoctorStep = () => {
        const firstCard = doctorsTrack ? doctorsTrack.querySelector('.doctor-card') : null;
        if (!firstCard) return 320;
        const cardWidth = firstCard.getBoundingClientRect().width;
        return cardWidth + 18;
    };

    if (doctorsTrack && doctorsPrev && doctorsNext) {
        doctorsPrev.addEventListener('click', () => {
            doctorsTrack.scrollBy({ left: -getDoctorStep(), behavior: 'smooth' });
        });

        doctorsNext.addEventListener('click', () => {
            doctorsTrack.scrollBy({ left: getDoctorStep(), behavior: 'smooth' });
        });
    }

    const videoContainer = document.getElementById('video-container');
    const videoOverlay = document.getElementById('video-overlay');
    const mainVideo = document.getElementById('main-video');

    if (videoContainer) {
        videoContainer.onclick = function() {
            console.log("Video container clicked");
            if (videoOverlay) videoOverlay.style.setProperty('display', 'none', 'important');
            if (mainVideo) {
                mainVideo.style.setProperty('display', 'block', 'important');
                mainVideo.play();
            }
        };
    } else {
        console.error("Video container not found!");
    }

    // Smooth Scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.onclick = function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) target.scrollIntoView({ behavior: 'smooth' });
        };
    });
});

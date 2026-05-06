// Ultra-simple script to ensure video plays on click
document.addEventListener('DOMContentLoaded', () => {
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

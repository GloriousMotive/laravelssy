import videojs from 'video.js';

document.addEventListener('DOMContentLoaded', () => {
    videojs('my-video', {
        controls: true,
        autoplay: false,
        preload: 'auto',
        playbackRates: [0.5, 1, 1.5, 2, 3]
    });
});
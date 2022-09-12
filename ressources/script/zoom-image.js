const elImageToZoom = document.getElementById('image-big-container');
const elWindowImageZoomed = document.querySelector('.window-zoom-image');
const elCloseBtnZoom = document.getElementById('closeZoomBtn');

elImageToZoom.addEventListener('click', () => {
    elWindowImageZoomed.classList.add('window-active');
})

elCloseBtnZoom.addEventListener('click', () => {
    elWindowImageZoomed.classList.remove('window-active');
})
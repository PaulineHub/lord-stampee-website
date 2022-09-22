
export default class ZoomImage {

    constructor() {
       this._elImageToZoom = document.getElementById('image-big-container');
       this._elWindowImageZoomed = document.querySelector('.window-zoom-image');
       this._elCloseBtnZoom = document.getElementById('closeZoomBtn');

       this.init();
    }
    
    init() {
        this._elImageToZoom.addEventListener('click', () => {
            this._elWindowImageZoomed.classList.add('window-active');
        })

        this._elCloseBtnZoom.addEventListener('click', () => {
            this._elWindowImageZoomed.classList.remove('window-active');
        })
    }
    
}

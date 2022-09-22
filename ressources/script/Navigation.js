export default class Navigation {

    constructor() {
        this._elOpenNavBtn = document.getElementById('openNavBtn');
        this._elCloseNavBtn = document.getElementById('closeNavBtn');

        this.init();
    }
    
    init() {

        /* Open when someone clicks on the span element */
        this._elOpenNavBtn.addEventListener('click', () => {
            document.getElementById('myNav').classList.add('show-nav-mobile');
        })

        /* Close when someone clicks on the "x" symbol inside the overlay */
        this._elCloseNavBtn.addEventListener('click', () => {
            document.getElementById('myNav').classList.remove('show-nav-mobile');
        })
    }

    
}



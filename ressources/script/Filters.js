export default class Filters {

    constructor() {
        this._elDevelopBtns = document.querySelectorAll('.filter-chevron-down');
        this._elRetractBtns = document.querySelectorAll('.filter-chevron-up');
        this._elOpenFilterBtn = document.getElementById('openFilterBtn');
        this._elCloseFilterBtn = document.getElementById('closeFilterBtn');

        this.init();
    }
    
    init() {
        this._elRetractBtns.forEach(retractBtn => {
            retractBtn.addEventListener('click', () => {
                let divToToggle = retractBtn.parentElement.nextElementSibling;
                divToToggle.classList.add('list-hidden');
                retractBtn.style.display = 'none';
                retractBtn.nextElementSibling.style.display = 'contents';
            })
        })

        this._elDevelopBtns.forEach(developBtn => {
            developBtn.addEventListener('click', () => {
                let divToToggle = developBtn.parentElement.nextElementSibling;
                divToToggle.classList.remove('list-hidden');
                developBtn.style.display = 'none';
                developBtn.previousElementSibling.style.display = 'contents';
            })
        })

        /* Open when someone clicks on the span element */
        this._elOpenFilterBtn.addEventListener('click', () => {
            document.getElementById('filter-container').classList.add('show-filter-mobile');
            this.addShadow();
        })

        /* Close when someone clicks on the "x" symbol inside the overlay */
        this._elCloseFilterBtn.addEventListener('click', () => {
            document.getElementById('filter-container').classList.remove('show-filter-mobile');
            this.removeShadow();
        })
    }

    addShadow() {
      document.getElementById("sidebar-backdrop").classList.add('sidebar-backdrop-active');
    }

    removeShadow() {
        document.getElementById("sidebar-backdrop").classList.remove('sidebar-backdrop-active');
    }
    
}









/* NAVIGATION */

const toggleBtnsNav = document.querySelectorAll('.dropbtn');

toggleBtnsNav.forEach(toggleBtn => {

    toggleBtn.addEventListener('click', () => {

        let divToToggle = toggleBtn.nextElementSibling;
        let retractBtnNav = toggleBtn.firstElementChild.nextElementSibling;
        let developBtnNav = retractBtnNav.nextElementSibling;

        if(divToToggle.classList.contains('list-hidden')) {
            divToToggle.classList.remove('list-hidden');
            developBtnNav.classList.add('hide-chevron-btn');
            retractBtnNav.classList.add('show-chevron-btn');
        } else {
            divToToggle.classList.add('list-hidden');
            retractBtnNav.classList.remove('show-chevron-btn');
            developBtnNav.classList.remove('hide-chevron-btn');
        }

    })
})


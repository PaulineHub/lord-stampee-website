/* NAVIGATION */

const toggleBtnsNav = document.querySelectorAll('.dropbtn');

toggleBtnsNav.forEach(toggleBtn => {
    toggleBtn.addEventListener('click', () => {
        let divToToggle = toggleBtn.nextElementSibling;
        let retractBtnNav = toggleBtn.firstElementChild.nextElementSibling;
        let developBtnNav = retractBtnNav.nextElementSibling;
        if(divToToggle.classList.contains('list-hidden')) {
            divToToggle.classList.remove('list-hidden');
            developBtnNav.style.display = 'none';
            retractBtnNav.style.display = 'contents';
        } else {
            divToToggle.classList.add('list-hidden');
            retractBtnNav.style.display = 'none';
            developBtnNav.style.display = 'contents';
        }
    })
})


const developBtns = document.querySelectorAll('.filter-chevron-down');
const retractBtns= document.querySelectorAll('.filter-chevron-up');

retractBtns.forEach(retractBtn => {
    retractBtn.addEventListener('click', () => {
        let divToToggle = retractBtn.parentElement.nextElementSibling;
        divToToggle.classList.add('list-hidden');
    })
})
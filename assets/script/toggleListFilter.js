/* FILTER */

const developBtns = document.querySelectorAll('.filter-chevron-down');
const retractBtns= document.querySelectorAll('.filter-chevron-up');

retractBtns.forEach(retractBtn => {
    retractBtn.addEventListener('click', () => {
        let divToToggle = retractBtn.parentElement.nextElementSibling;
        divToToggle.classList.add('list-hidden');
        retractBtn.style.display = 'none';
        retractBtn.nextElementSibling.style.display = 'contents';
    })
})

developBtns.forEach(developBtn => {
    developBtn.addEventListener('click', () => {
        let divToToggle = developBtn.parentElement.nextElementSibling;
        divToToggle.classList.remove('list-hidden');
        developBtn.style.display = 'none';
        developBtn.previousElementSibling.style.display = 'contents';
    })
})



const elBtnFav = document.getElementById('fav-btn');
const elStar = document.getElementById('fa-star');

elBtnFav.addEventListener('click', () => {
    elStar.classList.toggle('fa-regular');
    elStar.classList.toggle('fa-solid');
})
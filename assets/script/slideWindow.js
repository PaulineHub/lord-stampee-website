const elOpenNavBtn = document.getElementById('openNavBtn');
const elCloseNavBtn = document.getElementById('closeNavBtn');
const elOpenFilterBtn = document.getElementById('openFilterBtn');
const elCloseFilterBtn = document.getElementById('closeFilterBtn');

/* NAVIGATION */

/* Open when someone clicks on the span element */
elOpenNavBtn.addEventListener('click', () => {
  document.getElementById('myNav').classList.add('show-nav-mobile');
})

/* Close when someone clicks on the "x" symbol inside the overlay */

elCloseNavBtn.addEventListener('click', () => {
  document.getElementById('myNav').classList.remove('show-nav-mobile');
})

/* FILTERS */

/* Open when someone clicks on the span element */
elOpenFilterBtn.addEventListener('click', () => {
  document.getElementById('filter-container').classList.add('show-filter-mobile');
  addShadow();
})

/* Close when someone clicks on the "x" symbol inside the overlay */
elCloseFilterBtn.addEventListener('click', () => {
  document.getElementById('filter-container').classList.remove('show-filter-mobile');
  removeShadow();
})


/*  FUNCTIONS */

function addShadow() {
    document.getElementById("sidebar-backdrop").classList.add('sidebar-backdrop-active');
}

function removeShadow() {
  document.getElementById("sidebar-backdrop").classList.remove('sidebar-backdrop-active');
}
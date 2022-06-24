const elOpenNavBtn = document.getElementById('openNavBtn');
const elCloseNavBtn = document.getElementById('closeNavBtn');
const elOpenFilterBtn = document.getElementById('openFilterBtn');
const elCloseFilterBtn = document.getElementById('closeFilterBtn');

/* NAVIGATION */

/* Open when someone clicks on the span element */
elOpenNavBtn.addEventListener('click', () => {
  openSideWindow("myNav", "100%");
})

/* Close when someone clicks on the "x" symbol inside the overlay */

elCloseNavBtn.addEventListener('click', () => {
  closeSideWindow("myNav");
})

/* FILTERS */

/* Open when someone clicks on the span element */
elOpenFilterBtn.addEventListener('click', () => {
  document.getElementById("filter-container").style.transform = "translateX(0%)";
  openSideWindow("filter-container", "70%");
  addShadow();
})

/* Close when someone clicks on the "x" symbol inside the overlay */
elCloseFilterBtn.addEventListener('click', () => {
  closeSideWindow("filter-container");
  document.getElementById("filter-container").style.transform = "translateX(-100%)";
  removeShadow();
})


/*  FUNCTIONS */

function openSideWindow(id, percent) {
  document.getElementById(id).style.width = percent;
}

function closeSideWindow(id) {
  document.getElementById(id).style.width = "0%";
}

function addShadow() {
    document.getElementById("sidebar-backdrop").classList.add('sidebar-backdrop-active');
}

function removeShadow() {
  document.getElementById("sidebar-backdrop").classList.remove('sidebar-backdrop-active');
}
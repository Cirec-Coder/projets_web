
// Get elements from DOM
const menuBtn = document.querySelector('.menu-btn');
const menuBtnMobile = document.querySelector('.menu-btn-mobile');
const sidebar = document.querySelector('.sidebar');
const closeBtn = document.querySelector('.close-btn');
const backdrop = document.querySelector('.sidebar-backdrop');
const navbarMenu = document.querySelector('.navbar-menu');

// Initialize AnimateOnScroll
AOS.init();

// Add menu click events
menuBtn.addEventListener('click', sidebarOpen);
menuBtnMobile.addEventListener('click', sidebarOpen);

/**
 * sidebarOpen function 
 */
function sidebarOpen() {
    // change sidebar position
    sidebar.style.right = "0";
    // show backdrop
    backdrop.style.display = "block";
    // show backdrop through a smooth transition
    setTimeout(() => { 
        backdrop.style.opacity = "1";
    }, 50);
    // disable scroll on body
    document.body.classList.add("sidebar-open-body");
}

// add the close button click event
closeBtn.addEventListener("click", () => {
    // change sidebar position
    sidebar.style.right = "-20em";
    // hide backdrop with a smooth transition
    backdrop.style.opacity = "0";
    // hide backdrop after transition is done
    setTimeout(() => { 
        backdrop.style.display = "none";
    }, 300);
    // enable the scroll on body again
    document.body.classList.remove("sidebar-open-body");
});

// custom scroll event (Changing the image)
// Get elements from the DOM
const text = document.querySelector('.roof-text');
const roofImg = document.querySelector('.banner-img');

// add a scroll event to the document
window.addEventListener('scroll', () => {
    // When the text element is animated
    if (text.classList.contains('aos-animate')) {
        // show the second roof image
        roofImg.classList.add('roof-2');
        // when the anmation is removed
    } else {
        roofImg.classList.remove('roof-2');
    }
});






AOS.init({
    duration: 1000, 
    easing: "ease-in-out", 
});
const navbar = document.querySelector('.navigation-onscroll');
let isNavbarVisible = false;
const triggerPoint = 300;
window.addEventListener('scroll', () => {
const scrollPos = window.scrollY;


    if (scrollPos > triggerPoint && !isNavbarVisible) {
        gsap.to(navbar, {
        duration: 0.5,
        y: 0,
        display: "block",
        pointerEvents: 'auto',
        ease: 'power2.out'
    });
    isNavbarVisible = true;
    } else if (scrollPos <= triggerPoint && isNavbarVisible) {
        gsap.to(navbar, {
        duration: 0.3,
        y: -50,
        display: "none",
        pointerEvents: 'none',
        ease: 'power2.in'
        });
    isNavbarVisible = false;
    }
});
    
function disableScroll() {
    document.body.style.overflow = 'hidden';
}

function enableScroll() {
    document.body.style.overflow = 'auto';
}

window.onload = function() {
    setTimeout(function() {
        document.getElementById("loader-wrapper").style.display = "none"; 
        enableScroll()
    }, 2000);
    disableScroll()
};


function updateCircularProgress() {
    let scrollPosition = window.scrollY;
    let documentHeight = document.documentElement.scrollHeight - window.innerHeight;
    let scrollPercentage = (scrollPosition / documentHeight) * 100;
    
    let circle = document.getElementById("progress");
    

    let strokeDashOffset = 220 - (scrollPercentage / 100) * 220;

    circle.style.strokeDashoffset = strokeDashOffset;
}


window.addEventListener("scroll", updateCircularProgress);

const sliderTrack = document.querySelector('.slider-track');
const slides = document.querySelectorAll('.slide');

if (slides.length > 0) {
    let currentIndex = 0;
let isTransitioning = false;

const cloneFirst = slides[0].cloneNode(true);
const cloneLast = slides[slides.length - 1].cloneNode(true);
sliderTrack.appendChild(cloneFirst);
sliderTrack.insertBefore(cloneLast, slides[0]);

function goToSlide(index) {
if (isTransitioning) return;
isTransitioning = true;
currentIndex = index;
sliderTrack.style.transform = `translateX(-${currentIndex * 100}%)`;
}

function nextSlide() {
goToSlide(currentIndex + 1);
}

function prevSlide() {
goToSlide(currentIndex - 1);
}

sliderTrack.addEventListener('transitionend', () => {
isTransitioning = false;

if (currentIndex === slides.length + 1) {
    sliderTrack.style.transition = 'none';
    currentIndex = 1;
    sliderTrack.style.transform = `translateX(-${currentIndex * 100}%)`;
    setTimeout(() => {
    sliderTrack.style.transition = 'transform 0.5s ease-in-out';
    });
}

if (currentIndex === 0) {
    sliderTrack.style.transition = 'none';
    currentIndex = slides.length;
    sliderTrack.style.transform = `translateX(-${currentIndex * 100}%)`;
    setTimeout(() => {
    sliderTrack.style.transition = 'transform 0.5s ease-in-out';
    });
}
});

let autoplay = setInterval(() => {
    nextSlide();
}, 3000);

}



// Second slider starts here


const sliderTrack1 = document.querySelector('.slider-track-1');
const slides1 = document.querySelectorAll('.slide-1');

if (slides1.length > 0) {
    

let currentIndex1 = 0; // Start at original first slide
let isTransitioning1 = false;

// Clone first and last slides for infinite illusion
const cloneFirst1 = slides1[0].cloneNode(true);
const cloneLast1 = slides1[slides1.length - 1].cloneNode(true);
sliderTrack1.appendChild(cloneFirst1);
sliderTrack1.insertBefore(cloneLast1, slides1[0]);

function goToSlide1(index) {
if (isTransitioning1) return;
isTransitioning1 = true;
currentIndex1 = index;
sliderTrack1.style.transform = `translateX(-${currentIndex1 * 100}%)`;
}

function nextSlide1() {
goToSlide1(currentIndex1 + 1);
}

function prevSlide1() {
goToSlide1(currentIndex1 - 1);
}

// Handle transition end to reset position invisibly
sliderTrack1.addEventListener('transitionend', () => {
isTransitioning1 = false;

// If at clone of first slide (index slides.length + 1), jump to real slide 1
if (currentIndex1 === slides1.length + 1) {
    sliderTrack1.style.transition = 'none';
    currentIndex1 = 1;
    sliderTrack1.style.transform = `translateX(-${currentIndex1 * 100}%)`;
    setTimeout(() => {
    sliderTrack1.style.transition = 'transform 0.5s ease-in-out';
    });
}

// If at clone of last slide (index 0), jump to real last slide
if (currentIndex1 === 0) {
    sliderTrack1.style.transition = 'none';
    currentIndex1 = slides1.length;
    sliderTrack1.style.transform = `translateX(-${currentIndex1 * 100}%)`;
    setTimeout(() => {
    sliderTrack1.style.transition = 'transform 0.5s ease-in-out';
    });
}
})

// Auto-play (optional)
let autoplay1 = setInterval(() => {
    nextSlide1();
}, 3000);



// Button event listeners
document.querySelector('.next-btn-1').addEventListener('click', nextSlide1);
document.querySelector('.prev-btn-1').addEventListener('click', prevSlide1);
}


const sliderTrack2 = document.querySelector('.slider-track-2');
const slides2 = document.querySelectorAll('.slide-2');

if (slides2.length > 0) {
    

let currentIndex2 = 0; // Start at original first slide
let isTransitioning2 = false;

// Clone first and last slides for infinite illusion
const cloneFirst2 = slides2[0].cloneNode(true);
const cloneLast2 = slides2[slides2.length - 1].cloneNode(true);
sliderTrack2.appendChild(cloneFirst2);
sliderTrack2.insertBefore(cloneLast2, slides2[0]);

function goToSlide2(index) {
if (isTransitioning2) return;
isTransitioning2 = true;
currentIndex2 = index;
sliderTrack2.style.transform = `translateX(-${currentIndex2 * 100}%)`;
}

function nextSlide2() {
    goToSlide2(currentIndex2 + 1);
}

function prevSlide2() {
    goToSlide2(currentIndex2 - 1);
}

// Handle transition end to reset position invisibly
sliderTrack2.addEventListener('transitionend', () => {
isTransitioning2 = false;

// If at clone of first slide (index slides.length + 1), jump to real slide 1
if (currentIndex2 === slides2.length + 1) {
    sliderTrack2.style.transition = 'none';
    currentIndex2 = 1;
    sliderTrack2.style.transform = `translateX(-${currentIndex2 * 100}%)`;
    setTimeout(() => {
    sliderTrack2.style.transition = 'transform 0.5s ease-in-out';
    });
}

// If at clone of last slide (index 0), jump to real last slide
if (currentIndex2 === 0) {
    sliderTrack2.style.transition = 'none';
    currentIndex2 = slides2.length;
    sliderTrack2.style.transform = `translateX(-${currentIndex2 * 100}%)`;
    setTimeout(() => {
    sliderTrack2.style.transition = 'transform 0.5s ease-in-out';
    });
}
})


let autoplay2 = setInterval(() => {
    nextSlide2();
}, 3000);


document.querySelector('.next-btn-2').addEventListener('click', nextSlide2);
document.querySelector('.prev-btn-2').addEventListener('click', prevSlide2);
}


const modeToggle = document.querySelectorAll('.mode-toggle');
const body = document.body;


let darkMode = localStorage.getItem('darkMode');


if (darkMode === 'true') {
    body.classList.add('dark-mode');
} else {
    body.classList.add('light-mode');
}

modeToggle.forEach((modeToggle)=>{
    modeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        body.classList.toggle('light-mode');
        
    
        darkMode = body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', darkMode);
    });
});

const mdMenu = document.querySelector('.navigation-header #md-nav-menu button');
const mdMenuNestedNav = document.querySelector('.navigation-header .md-nav-menulist ul .nested-nav');
const mdMenuNestedNavMenu = document.querySelector('.navigation-header .md-nav-menulist ul .nested-nav ul');
const onsmdMenuNestedNav = document.querySelector('.navigation-onscroll .md-nav-menulist ul .nested-nav');
const onsmdMenuNestedNavMenu = document.querySelector('.navigation-onscroll .md-nav-menulist ul .nested-nav ul');
const navMenu = document.querySelector('.navigation-header .md-nav-menulist');
const onsmdMenu = document.querySelector('.navigation-onscroll #md-nav-menu button');
const onsnavMenu = document.querySelector('.navigation-onscroll .md-nav-menulist');

mdMenu.addEventListener('click', () => {
    navMenu.classList.toggle('md-nav-open');
    mdMenuNestedNavMenu.classList.remove('md-nestednav-open');
});
mdMenuNestedNav.addEventListener('click', () => {
    mdMenuNestedNavMenu.classList.toggle('md-nestednav-open');
});
onsmdMenu.addEventListener('click', () => {
    onsnavMenu.classList.toggle('md-nav-open');
    onsmdMenuNestedNavMenu.classList.remove('md-nestednav-open');
});
onsmdMenuNestedNav.addEventListener('click', () => {
    onsmdMenuNestedNavMenu.classList.toggle('md-nestednav-open');
});


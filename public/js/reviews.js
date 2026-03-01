const landingTitle = document.querySelector(".landing_title");
const navbar = document.querySelector("nav");
const tagline = document.querySelector(".tagline h3");

const landingImage = document.getElementById(".landing-image");


function animateIntro() {
    setTimeout(() => {
        landingTitle.classList.add("show-landing-title");
    }, 500);

    setTimeout(() => {
        navbar.classList.add("show-navbar");
        tagline.classList.add("show-tagline");
    }, 1500);
}

function shrinkNavBar(entries) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            navbar.classList.remove("shrink");
            landingImage.classList.remove("shrink-image");
        }
        else {
            navbar.classList.add("shrink");
            landingImage.classList.add("shrink-image");
        }
    });
}

const home = document.querySelector(".landing_page");
const observer = new IntersectionObserver(shrinkNavBar, { threshold: 0.7 });
observer.observe(home);
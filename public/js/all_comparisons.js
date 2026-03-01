const imgOne = document.querySelector(".one");
const imgTwo = document.querySelector(".two");
const imgThree = document.querySelector(".three");
const landingTitle = document.querySelector(".landing_title");
const navbar = document.querySelector("nav");
const tagline = document.querySelector(".tagline h3");

function animateIntro() {
    setTimeout(() => {
        imgOne.classList.add("show");
    }, 1500);

    setTimeout(() => {
        imgTwo.classList.add("show");
    }, 1000);

    setTimeout(() => {
        imgThree.classList.add("show");
    }, /*1500*/ 500);

    setTimeout(() => {
        landingTitle.classList.add("show-landing-title");
    }, 2000);

    setTimeout(() => {
        navbar.classList.add("show-navbar");
        tagline.classList.add("show-tagline");
    }, 3000);
}

function shrinkNavBar(entries) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            navbar.classList.remove("shrink");
            imgOne.classList.remove("reverse");
            imgThree.classList.remove("drive-forward");
        }
        else {
            navbar.classList.add("shrink");
            imgOne.classList.add("reverse")
            imgThree.classList.add("drive-forward");
        }
    });
}

const home = document.querySelector(".landing_page");
const observer = new IntersectionObserver(shrinkNavBar, { threshold: 0.7 });
observer.observe(home);

imgOne.addEventListener("hover", () => {
    imgOne.classList.add("drive");
})
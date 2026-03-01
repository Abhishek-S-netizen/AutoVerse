const landingTitle = document.querySelector(".landing_title");
const navbar = document.querySelector("nav");
const tagline = document.querySelector(".tagline");
const landingImage = document.querySelector(".landing_img_wrapper");
const img = landingImage.querySelector("img");
const backImg = document.querySelector(".landing_page");

function animateIntro() {
    landingImage.classList.add("drive");
    backImg.classList.add("unblur");
    setTimeout(() => {
        landingTitle.classList.add("show-landing-title");
        img.classList.add("zoom");
    }, 1500);

    setTimeout(() => {
        navbar.classList.add("show-navbar");
        tagline.classList.add("show-tagline");
    }, 2500);
}

function shrinkNavBar(entries) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            img.classList.remove("shrink");
            navbar.classList.remove("shrink");
        }
        else {
            img.classList.add("shrink");
            navbar.classList.add("shrink");
        }
    });
}

const home = document.querySelector(".landing_page");
const observer = new IntersectionObserver(shrinkNavBar, { threshold: 0.8 });
observer.observe(home);

const topPicksWrapper = document.querySelector(".top-picks-wrapper");
const topPicksSection = document.querySelectorAll(".top-picks-wrapper div");

const popularReviews = document.querySelector(".popular_review");
const popularReviewsSection = document.querySelectorAll(".popular-reviews-wrapper .popular_review");

const featuredRentalsWrapper = document.querySelector(".featured-rentals-wrapper");
const featuredRentalsSection = document.querySelectorAll(".featured-rentals-wrapper div");


function createObserver(elements, className, sectionName) {

    let userLastScrolled = 0;

    function show(entries) {

        let sectionPosition = sectionName.offsetTop;
        let currentUserPosition = window.pageYOffset;
        let scrolledUp = currentUserPosition < userLastScrolled;

        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add(className);
            }

            else {
                if (scrolledUp && currentUserPosition < sectionPosition) {
                    elements.forEach((card) => {
                        card.classList.remove(className);
                    });
                }
            }
        });

        userLastScrolled = currentUserPosition;
    }

    return new IntersectionObserver(show, { threshold: 0.3 });
}

let observer_1 = createObserver(topPicksSection, "show-section", topPicksWrapper);
topPicksSection.forEach(div => observer_1.observe(div));

let observer_2 = createObserver(popularReviewsSection, "show-section", popularReviews);
popularReviewsSection.forEach(div => observer_2.observe(div));

let observer_3 = createObserver(featuredRentalsSection, "show-section", featuredRentalsWrapper);
featuredRentalsSection.forEach(div => observer_3.observe(div));

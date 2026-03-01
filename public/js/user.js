const pageLoader = document.querySelector(".page-loader");
const loadingImage = document.getElementById("loading-image");
const loadingTitle = document.getElementById("loading-title");
const loadingMessage = document.getElementById("loading-message");
const dashboard = document.querySelector(".dashboard-content");
const userID = document.body.dataset.userid;

let loaderKey = `loaderShown_${userID}`;

document.addEventListener("DOMContentLoaded", () => {
    if (!sessionStorage.getItem(loaderKey)) {
        sessionStorage.setItem(loaderKey, true);
        loader();
    }
    else {
        skipLoader();
    }
});

function loader() {
    setTimeout(() => {
        loadingImage.classList.add("drive");
    }, 500);

    setTimeout(() => {
        loadingTitle.classList.add("show-title");
    }, 2000);

    setTimeout(() => {
        loadingMessage.classList.add("show-message");
    }, 3000);

    setTimeout(() => {
        pageLoader.classList.add("change-bg");
    }, 4000);

    setTimeout(() => {
        pageLoader.classList.add("remove-page-loader");
        dashboard.classList.add("show-dashboard");
    }, 5500);
}

function skipLoader() {
    pageLoader.classList.add("remove-page-loader");
    dashboard.classList.add("show-dashboard");
}

function updateClock() {
    const now = new Date();
    const time = now.toLocaleTimeString();
    document.getElementById("clock").innerText = time;
}

setInterval(updateClock, 1000);
updateClock();

const body = document.querySelector("body");
const wishlistCard = document.querySelector(".wishlist_card");
const orderCard = document.querySelector(".order_card");
const profileCard = document.querySelector(".profile_card");
const wishlistCardLink = wishlistCard.querySelector("a");
const orderCardLink = orderCard.querySelector("a");
const cardTitle = document.querySelectorAll(".card_title");
const profileButtons = document.querySelectorAll(".edit-profile-form button");
const themeToggle = document.getElementById("darkModeChecked");

themeToggle.addEventListener("change", () => {
    body.classList.toggle("dark-mode");
    wishlistCard.classList.toggle("dark-mode-wishlist");
    orderCard.classList.toggle("dark-mode-order");
    profileCard.classList.toggle("dark-mode-profile");
    wishlistCardLink.classList.toggle("dark-mode-wishlist-link");
    orderCardLink.classList.toggle("dark-mode-order-link");

    cardTitle.forEach((card_title) => { card_title.classList.toggle("dark-mode-title") });
    profileButtons.forEach(button => button.classList.toggle("dark-mode-button"));
})


function confirmDelete() {
    return confirm("Are you sure you want to delete your account? This is deletion is permanent and cannot be undone");
}
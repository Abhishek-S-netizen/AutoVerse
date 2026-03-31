const pageLoader = document.querySelector(".page-loader");
const loadingImage = document.getElementById("loading-image");
const loadingTitle = document.getElementById("loading-title");
const loadingMessage = document.getElementById("loading-message");
const dashboard = document.querySelector(".dashboard-content");
const userID = document.body.dataset.userid;

/* function changeTheme() {
    const nav = document.querySelector("nav");
    const body = document.querySelector("body");
    const wishlistCard = document.querySelector(".wishlist_card");
    const orderCard = document.querySelectorAll(".order_card");
    const profileCard = document.querySelector(".profile_card");
    const welcomeMessage = document.querySelector(".welcome-message").querySelector("h2");
    const wishlistCardLink = wishlistCard.querySelector("a");
    const orderCardLink = document.querySelectorAll(".order_card a");
    const cardTitle = document.querySelectorAll(".card_title");
    const profileButtons = document.querySelectorAll(".edit-profile-form button");

    nav.classList.toggle("dark-mode-nav");
    body.classList.toggle("dark-mode");
    welcomeMessage.classList.toggle("welcome-message-dark-mode");
    wishlistCard.classList.toggle("dark-mode-wishlist");
    orderCard.forEach(card => { card.classList.toggle("dark-mode-order") });
    profileCard.classList.toggle("dark-mode-profile");
    wishlistCardLink.classList.toggle("dark-mode-wishlist-link");
    orderCardLink.forEach(link => { link.classList.toggle("dark-mode-order-link") });

    cardTitle.forEach((card_title) => { card_title.classList.toggle("dark-mode-title") });
    profileButtons.forEach(button => button.classList.toggle("dark-mode-button"));
}

const themeToggle = document.getElementById("darkModeChecked"); */

let loaderKey = `loaderShown_${userID}`;

document.addEventListener("DOMContentLoaded", () => {
    if (!sessionStorage.getItem(loaderKey)) {
        sessionStorage.setItem(loaderKey, true);
        loader();
    }
    else {
        skipLoader();
    }

    /*if (localStorage.getItem("darkMode") === "true") {
        themeToggle.checked = true;
        changeTheme();
    }*/
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
    const time = now.toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit',
        hour12: false,
    });
    document.getElementById("clock").innerText = time;
}

setInterval(updateClock, 1000);
updateClock();

/* themeToggle.addEventListener("change", () => {
    changeTheme();
    localStorage.setItem("darkMode", themeToggle.checked);
}) */


function confirmDelete() {
    return confirm("Are you sure you want to delete your account? This is deletion is permanent and cannot be undone");
}
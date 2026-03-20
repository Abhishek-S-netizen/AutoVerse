const garage = document.querySelector(".garage");
const carsSection = document.querySelector(".cars");

function showGarage() {
    setTimeout(() => {
        garage.classList.add("show-garage");
    }, 500);

    setTimeout(() => {
        carsSection.classList.add("show-cars");
    }, 1000);
}

function confirmDeletePost() {
    return confirm("Are you sure you want to delete this post? This deletion is permanent and cannot be undone");
}

function confirmDeleteReply() {
    return confirm("Are you sure you want to delete this reply? This deletion is permanent and cannot be undone");
}

function confirmDeleteUser() {
    return confirm("Are you sure you want to delete this user? This deletion is permanent and cannot be undone");
}
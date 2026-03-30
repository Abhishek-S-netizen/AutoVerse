const allReviews = document.querySelector(".all-reviews-wrapper");
const filterForm = document.querySelector(".filter-form-wrapper");

function showReviews() {
    setTimeout(() => {
        filterForm.classList.add("show-filter-form");
    }, 200);

    setTimeout(() => {
        allReviews.classList.add("show");
    }, 500);
}
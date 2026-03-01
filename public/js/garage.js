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
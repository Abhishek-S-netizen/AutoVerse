function showCards() {
    serviceCards = document.querySelectorAll(".service_card");

    serviceCards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add("show_card");
        }, index * 500);
    })
}
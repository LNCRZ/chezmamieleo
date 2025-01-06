document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.getElementById("recipe-carousel");
    const cards = carousel.getElementsByClassName("recipe-card");
    const nextButton = document.getElementById("nextRecipe");
    let currentIndex = 0;

    // Ajoute la classe "active" à la première carte
    cards[currentIndex].classList.add("active");

    nextButton.addEventListener("click", function () {
        // Retirer la classe "active" de la carte actuelle
        cards[currentIndex].classList.remove("active");

        // Passer à la carte suivante
        currentIndex = (currentIndex + 1) % cards.length;

        // Ajouter la classe "active" à la nouvelle carte
        cards[currentIndex].classList.add("active");
    });
});

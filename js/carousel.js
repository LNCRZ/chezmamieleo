document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.getElementById("recipe-carousel");
    const cards = carousel.getElementsByClassName("recipe-card");
    const nextButton = document.getElementById("nextRecipe");
    let currentIndex = 0;

    // Cacher toutes les cartes sauf la première
    for (let i = 1; i < cards.length; i++) {
        cards[i].style.display = 'none';
    }

    nextButton.addEventListener('click', function() {
        cards[currentIndex].style.display = 'none';
        currentIndex = (currentIndex + 1) % cards.length;
        cards[currentIndex].style.display = 'block';
    });
});
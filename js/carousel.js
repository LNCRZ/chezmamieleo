document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM chargé");
    const carousel = document.querySelector(".recipe-carousel");
    console.log("Carousel trouvé:", carousel);
    const cards = document.getElementsByClassName("recipe-card");
    console.log("Nombre de cartes trouvées:", cards.length);
    const nextButton = document.getElementById("nextRecipe");
    let currentIndex = 0;

    // Vérifier s'il y a des cartes dans le carousel
    if (cards.length === 0) {
        console.warn("Aucune carte n'est présente dans le carousel.");
        return; // Arrêter l'exécution si aucune carte
    }

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

    // Ajouter un gestionnaire d'événements pour les liens de recette
    const recipeLinks = document.querySelectorAll('.viewRecipe');
    recipeLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Lien cliqué');
            console.log('href:', this.href);
            console.log('data-recipe-id:', this.dataset.recipeId);
            window.location.href = this.href;
        });
    });
});

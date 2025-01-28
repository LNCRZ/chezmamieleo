document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM chargé");

    // Fonction pour initialiser le carousel
    function initCarousel() {
        const carousel = document.querySelector("#recipe-carousel");
        console.log("Carousel trouvé:", carousel);

        if (carousel) {
            const cards = carousel.querySelectorAll(".recipe-card");
            console.log("Nombre de cartes trouvées:", cards.length);

            if (cards.length > 0) {
                let currentIndex = 0;
                cards[currentIndex].classList.add("active");

                const nextButton = document.getElementById("nextRecipe");
                if (nextButton) {
                    nextButton.addEventListener("click", function () {
                        cards[currentIndex].classList.remove("active");
                        currentIndex = (currentIndex + 1) % cards.length;
                        cards[currentIndex].classList.add("active");
                    });
                } else {
                    console.warn("Bouton 'Recette suivante' non trouvé");
                }
            } else {
                console.warn("Aucune carte n'est présente dans le carousel.");
            }
        } else {
            console.warn("Le carousel n'a pas été trouvé dans le DOM");
        }
    }

    // Fonction pour gérer les liens de recette
    function handleRecipeLinks() {
        const recipeLinks = document.querySelectorAll('.viewRecipe');
        console.log("Nombre de liens de recette trouvés:", recipeLinks.length);

        recipeLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.href;
                const recipeId = this.dataset.recipeId;
                console.log('Redirection vers:', href, 'ID:', recipeId);
                window.location.href = href;
            });
        });
    }

    // Initialiser le carousel et les liens
    initCarousel();
    handleRecipeLinks();
});

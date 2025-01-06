<?php
require_once "./_includes/header.php"; 
require_once "./config/Database.php";

// Récupérer la catégorie sélectionnée dans le formulaire
$filterCategory = isset($_GET['filter_category']) ? $_GET['filter_category'] : '';

try {
    // Si une catégorie est sélectionnée, filtrer les résultats
    if (!empty($filterCategory)) {
        $stmt = $bdd->prepare("SELECT * FROM recipes WHERE categoryRecipe = :category ORDER BY categoryRecipe");
        $stmt->execute(['category' => $filterCategory]);
    } else {
        // Sinon, récupérer toutes les recettes
        $stmt = $bdd->prepare("SELECT * FROM recipes ORDER BY categoryRecipe");
        $stmt->execute();
    }
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
    $results = [];
}
?>
<main>
    <div class="container-filter">
        <!-- Formulaire pour filtrer par catégorie -->
        <form method="GET" action="index.php">
            <label for="filter_category">Filtrer par catégorie :</label>
            <select name="filter_category" id="filter_category">
                <option value="">Toutes</option>
                <option value="apéro" <?= $filterCategory == 'apéro' ? 'selected' : '' ?>>Apéro</option>
                <option value="boisson" <?= $filterCategory == 'boisson' ? 'selected' : '' ?>>Boisson</option>
                <option value="entrée" <?= $filterCategory == 'entrée' ? 'selected' : '' ?>>Entrée</option>
                <option value="plat" <?= $filterCategory == 'plat' ? 'selected' : '' ?>>Plat</option>
                <option value="dessert" <?= $filterCategory == 'dessert' ? 'selected' : '' ?>>Dessert</option>
                <option value="goûter" <?= $filterCategory == 'goûter' ? 'selected' : '' ?>>Goûter</option>
            </select>
            <button type="submit" id="filterBtn">Filtrer</button>
        </form>
    </div>

    <div class="container-accueil">
        <h1 class="title-accueil">Les recettes de Mamie Léo</h1>
        <?php if (empty($results)): ?>
            <p>Aucune recette n'est disponible pour le moment.</p>
        <?php else: ?>
            <div id="recipe-carousel" class="recipe-carousel">
                <?php foreach ($results as $result): ?>
                    <div class="recipe-card">
                        <img 
                            class="carousel-picture" 
                            src="<?= htmlspecialchars($result['picture']) ?: './assets/default.jpg' ?>" 
                            alt="<?= htmlspecialchars($result['nameRecipe']) ?>"
                        >
                        <h2><?= htmlspecialchars($result['nameRecipe']) ?></h2>
                        <p><?= htmlspecialchars($result['categoryRecipe']) ?></p>
                        <a id="viewRecipe" href="recipe.php?id=<?= intval($result['id']) ?>">Voir la recette</a>
                    </div>
                <?php endforeach; ?>
            </div>
            <button id="nextRecipe">Recette suivante</button>
        <?php endif; ?>
    </div>
</main>
<?php
require_once "./_includes/footer.php";
?>
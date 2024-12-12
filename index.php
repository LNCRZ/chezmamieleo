<?php
require_once "./_includes/header.php"; 
require_once "./config/Database.php";


try {
    $stmt = $bdd->prepare("SELECT * FROM recipes");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
    $results = [];
}   
//var_dump($results);

?>
<main class="container">
    <h1>Les recettes de Mamie Léo</h1>
    <?php if (empty($results)): ?>
        <p>Aucune recette n'est disponible pour le moment.</p>
    <?php else: ?>
        <div id="recipe-carousel" class="recipe-carousel">
            <?php foreach ($results as $result): ?>
                <div class="recipe-card">
                    <img 
                        class="recipe-picture" 
                        src="<?= htmlspecialchars($result['picture']) ?: './assets/default.jpg' ?>" 
                        alt="<?= htmlspecialchars($result['nameRecipe']) ?>"
                    >
                    <h2><?= htmlspecialchars($result['nameRecipe']) ?></h2>
                    <p><?= htmlspecialchars($result['description']) ?></p>
                    <a id="viewRecipe" href="recipe.php?id=<?= intval($result['id']) ?>">Voir la recette</a>
                </div>
            <?php endforeach; ?>
        </div>
        <button id="nextRecipe">Recette suivante</button>
    <?php endif; ?>
</main>
<?php
require_once "./_includes/footer.php";

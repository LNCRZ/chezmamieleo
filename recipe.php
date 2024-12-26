<?php
require_once "./_includes/header.php"; 
require_once "./config/Database.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Recette introuvable.</p>";
    require_once "./_includes/footer.php";
    exit;
}

$id = intval($_GET['id']);

try {
    $stmt = $bdd->prepare("SELECT * FROM recipes WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$recipe) {
        echo "<p>Recette introuvable.</p>";
        require_once "./_includes/footer.php";
        exit;
    }
} catch (PDOException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
    require_once "./_includes/footer.php";
    exit;
}
?>
<main class="container">
    <div id="card-recipe" class="card-recipe">
        <h1><?= htmlspecialchars($recipe['nameRecipe']) ?></h1>
        <img 
            class="recipe-picture" 
            src="<?= htmlspecialchars($recipe['picture']) ?: './assets/default.jpg' ?>" 
            alt="<?= htmlspecialchars($recipe['nameRecipe']) ?>"
        >
        <p><strong>Description :</strong> <?= htmlspecialchars($recipe['description']) ?></p>
        <p><strong>Ingrédients :</strong> <?= nl2br(htmlspecialchars($recipe['ingredient'])) ?></p>
        <p><strong>Instructions :</strong> <?= nl2br(htmlspecialchars($recipe['preparation'])) ?></p>
    </div>
    <a href="index.php">Retour à la liste des recettes</a>
</main>
<?php
require_once "./_includes/footer.php";
?>

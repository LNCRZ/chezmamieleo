<?php
require_once './_includes/header.php';
require_once './config/Database.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Recette introuvable.</p>";
    require_once "./_includes/footer.php";
    exit;
}

$id = intval($_GET['id']);

try {
    // Récupération de la recette
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

// Mise à jour de la recette
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nameRecipe = $_POST['nameRecipe'] ?? '';
    $description = $_POST['description'] ?? '';
    $ingredient = $_POST['ingredient'] ?? '';
    $preparation = $_POST['preparation'] ?? '';

    try {
        $updateStmt = $bdd->prepare("
            UPDATE recipes 
            SET nameRecipe = :nameRecipe, description = :description, ingredient = :ingredient, preparation = :preparation 
            WHERE id = :id
        ");
        $updateStmt->bindParam(':nameRecipe', $nameRecipe, PDO::PARAM_STR);
        $updateStmt->bindParam(':description', $description, PDO::PARAM_STR);
        $updateStmt->bindParam(':ingredient', $ingredient, PDO::PARAM_STR);
        $updateStmt->bindParam(':preparation', $preparation, PDO::PARAM_STR);
        $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $updateStmt->execute();

        echo "<p>Recette mise à jour avec succès !</p>";
        echo "<a href='recipe.php?id=$id'>Voir la recette</a>";
        require_once "./_includes/footer.php";
        exit;
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}
?>
<main class="container">
    <h1>Modifier la recette : <?= htmlspecialchars($recipe['nameRecipe']) ?></h1>
    <form method="POST" class="recipe-form">
        <label for="nameRecipe">Nom de la recette :</label>
        <input type="text" id="nameRecipe" name="nameRecipe" value="<?= htmlspecialchars($recipe['nameRecipe']) ?>" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($recipe['description']) ?></textarea>

        <label for="ingredient">Ingrédients :</label>
        <textarea id="ingredient" name="ingredient" required><?= htmlspecialchars($recipe['ingredient']) ?></textarea>

        <label for="preparation">Instructions :</label>
        <textarea id="preparation" name="preparation" required><?= htmlspecialchars($recipe['preparation']) ?></textarea>

        <button type="submit">Enregistrer les modifications</button>
    </form>
    <a href="recipe.php?id=<?= $id ?>">Annuler</a>
</main>
<?php
require_once "./_includes/footer.php";
?>
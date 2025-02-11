<?php
session_start();

require_once './_includes/header.php';
require_once './config/Database.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour accéder à cette page.";
    header("Location: login.php");
    exit;
}

// Vérifiez si le rôle est défini
if (!isset($_SESSION['role'])) {
    echo "Votre rôle n'est pas défini. Veuillez vous reconnecter.";
    session_destroy();
    header("Location: login.php");
    exit;
}

// Accès sécurisé à l'ID utilisateur
$userId = $_SESSION['user_id'];

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
<main class="container-recipe">
    <div id="card-recipe" class="card-recipe">
        <h1><?= htmlspecialchars($recipe['nameRecipe']) ?></h1>
        <h2><?= htmlspecialchars($recipe['categoryRecipe']) ?></h2>
        <img 
            class="recipe-picture" 
            src="<?= htmlspecialchars($recipe['picture']) ?: './assets/default.jpg' ?>" 
            alt="<?= htmlspecialchars($recipe['nameRecipe']) ?>"
        >
        <p><strong>Description :</strong> <?= htmlspecialchars($recipe['description']) ?></p>
        <p><strong>Ingrédients :</strong> <?= nl2br(htmlspecialchars($recipe['ingredient'])) ?></p>
        <p><strong>Instructions :</strong> <?= nl2br(htmlspecialchars($recipe['preparation'])) ?></p>

        <div class="buttons">
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <form method="POST" action="edit_recipe.php">
                    <input type="hidden" name="recipe_id" value="<?= $recipe['id'] ?>">
                    <button type="submit" class="btn modify">Modifier</button>
                </form>
                <form method="POST" action="delete_recipe.php" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?');">
                    <input type="hidden" name="recipe_id" value="<?= $recipe['id'] ?>">
                    <button type="submit" class="btn delete">Supprimer</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <a href="index.php" class="btn">Retour à la liste des recettes</a>
</main>
<?php
require_once "./_includes/footer.php";
?>

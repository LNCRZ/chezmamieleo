<?php
require_once "./_includes/header.php"; 
require_once "./config/Database.php";
require_once "./_includes/footer.php";

$sql = "SELECT * FROM recipes";
$req = $bdd->query($sql);
$results = $req->fetchAll(PDO::FETCH_ASSOC);    
// var_dump($results);
?>
<main class="container">
    <h1>Les recettes de Mamie Léo</h1>
    <div class="recipe-slider">
        <div class="slider">
            <?php foreach($results as $result): ?>
                <div class="recipe-card">
                    <img class="recipe-picture" src="<?= $result['picture'] ?>" alt="<?= $result['nameRecipe'] ?>">
                    <h2><?= $result['nameRecipe'] ?></h2>
                    <p><?= $result['description'] ?></p>
                    <a href="recipe.php?id=<?= $result['id'] ?>">Voir la recette</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</main>
<?php
require_once "./_includes/footer.php";
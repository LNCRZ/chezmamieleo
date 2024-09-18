<?php
require_once "./_includes/header.php"; 
require_once "./config/Database.php";

$sql = "SELECT * FROM recipes";
$req = $bdd->query($sql);
$results = $req->fetchAll(PDO::FETCH_ASSOC);    
var_dump($results);
?>

<h1>Les recettes de Mamie Léo</h1>

<?php foreach($results as $result): ?>
    <div class="recipe-card">
        <img src="<?= $result['image'] ?>" alt="<?= $result['nameRecipe'] ?>">
        <h2><?= $result['nameRecipe'] ?></h2>
        <p><?= $result['description'] ?></p>
        <a href="recipe.php?id=<?= $result['id'] ?>">Voir la recette</a>
    </div>
<?php endforeach; ?>

<?php
require_once "./_includes/footer.php";
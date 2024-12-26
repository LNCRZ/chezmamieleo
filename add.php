<?php 
require_once "./_includes/header.php";
require_once "./config/Database.php";
?>
<div class="container">
    <h1>Ajouter une nouvelle recette</h1>
    <div class="recipe-form">

    <form action="src/insert.php" method="POST">
        <input type="text" name="nameRecipe" placeholder="Nom de la recette" required>
        <textarea name="ingredient" placeholder="Ingrédients" required></textarea>
        <textarea name="preparation" placeholder="Préparation" required></textarea>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="text" name="author" placeholder="Auteur" required>
        <input type="text" name="picture" placeholder="URL de l'image">
        <input type="submit" value="Ajouter la recette">
    </form>
    </div>
</div>

<?php
require_once "./_includes/footer.php";
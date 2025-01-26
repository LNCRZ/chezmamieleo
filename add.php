<?php 
session_start();

require_once "./_includes/header.php";
require_once "./config/Database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
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
        <label>Catégorie :</label><br>
            <input type="radio" name="categoryRecipe" value="apero"> Apéro<br>
            <input type="radio" name="categoryRecipe" value="boisson"> Boisson<br>
            <input type="radio" name="categoryRecipe" value="entree"> Entrée<br>
            <input type="radio" name="categoryRecipe" value="plat"> Plat<br>
            <input type="radio" name="categoryRecipe" value="dessert"> Dessert<br>
            <input type="radio" name="categoryRecipe" value="gouter"> Goûter<br>
        <input type="submit" value="Ajouter la recette">
    </form>
    </div>
</div>

<?php
require_once "./_includes/footer.php";
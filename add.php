<?php 
require_once "./_includes/header.php";
require_once "./config/Database.php";
?>

<h1>Ajouter une nouvelle recette</h1>

<form action="src/insert.php" method="POST">
    <input type="text" name="nameRecipe" placeholder="Nom de la recette">
    <input type="text" name="ingredient" placeholder="Ingredients">
    <textarea name="preparation" placeholder="Préparation" value=""></textarea>
    <textarea name="description" placeholder="Description" value=""></textarea>
    <input type="text" name="author" placeholder="Auteur">
    <input type="text" name="picture" placeholder="Image">
    <input type="submit" value="Ajouter">
</form>
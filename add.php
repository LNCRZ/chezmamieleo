<?php 
require_once "./_includes/header.php";
require_once "./config/Database.php";
?>

<h1>Ajouter une nouvelle recette</h1>

<form action="src/insert.php" method="POST">
    <input type="text" name="nameRecipe" placeholder="Nom de la recette">
    <input type="text" name="ingredient" placeholder="Ingredients">
    <input type="text" name="preparation" placeholder="Préparation">
    <input type="text" name="description" placeholder="Description">
    <input type="text" name="author" placeholder="Auteur">
    <input type="text" name="picture" placeholder="Image">
    <input type="submit" value="Ajouter">
</form>
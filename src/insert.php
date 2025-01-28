<?php
require_once '../config/Database.php';

$nameRecipe = htmlspecialchars($_POST['nameRecipe']);
$ingredient = htmlspecialchars($_POST['ingredient']);
$preparation = htmlspecialchars($_POST['preparation']);
$description = htmlspecialchars($_POST['description']);
$author = htmlspecialchars($_POST['author']);
$picture = htmlspecialchars($_POST['picture']);
$categoryRecipe = htmlspecialchars($_POST['categoryRecipe']);

echo $nameRecipe ." ". $ingredient ." ". $preparation ." ". $description ." ". $author ." ". $picture ." ". $categoryRecipe;

$sql = "INSERT INTO recipes (nameRecipe, ingredient, preparation, description, author, picture, categoryRecipe) VALUES (:nameRecipe, :ingredient, :preparation, :description, :author, :picture, :categoryRecipe)";
$stmt = $bdd->prepare($sql);
$stmt->execute([
    'nameRecipe' => $nameRecipe,
    'ingredient' => $ingredient,
    'preparation' => $preparation,
    'description' => $description,
    'author' => $author,
    'picture' => $picture,
    'categoryRecipe' => $categoryRecipe
]);

header('Location: ../index.php');
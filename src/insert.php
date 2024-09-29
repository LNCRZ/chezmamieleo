<?php
require_once '../config/Database.php';

$nameRecipe = htmlspecialchars($_POST['nameRecipe']);
$ingredient = htmlspecialchars($_POST['ingredient']);
$preparation = htmlspecialchars($_POST['preparation']);
$description = htmlspecialchars($_POST['description']);
$author = htmlspecialchars($_POST['author']);
$picture = htmlspecialchars($_POST['picture']);

echo $nameRecipe ." ". $ingredient ." ". $preparation ." ". $description ." ". $author ." ". $picture;

$bdd = new PDO('mysql:host=188.165.47.99;dbname=amrvagll_chezmamieleo', 'amrvagll_chezmamieleo', 'JLjvyfGsE+j]');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "INSERT INTO recipes (nameRecipe, ingredient, preparation, description, author, picture) VALUES (:nameRecipe, :ingredient, :preparation, :description, :author, :picture)";
$query = $bdd->prepare($sql);
$query->execute([
    'nameRecipe' => $nameRecipe,
    'ingredient' => $ingredient,
    'preparation' => $preparation,
    'description' => $description,
    'author' => $author,
    'picture' => $picture
]);

header('Location: ../index.php');
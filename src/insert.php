<?php
require_once '../config/Database.php';

$nameRecipe = htmlspecialchars($_POST['nameRecipe']);
$ingredient = htmlspecialchars($_POST['ingredient']);
$preparation = htmlspecialchars($_POST['preparation']);
$description = htmlspecialchars($_POST['description']);
$author = htmlspecialchars($_POST['author']);
$picture = htmlspecialchars($_POST['picture']);


echo $nameRecipe ." ". $ingredient ." ". $preparation ." ". $description ." ". $author ." ". $picture;
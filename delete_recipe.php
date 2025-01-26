<?php
session_start();

require_once 'config/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie si l'utilisateur est admin
    if ($_SESSION['role'] !== 'admin') {
        die("Vous n'avez pas les droits pour supprimer cette recette.");
    }

    $recipeId = intval($_POST['recipe_id']);

    // Suppression de la recette
    $stmt = $bdd->prepare("DELETE FROM recipes WHERE id = :id");
    $stmt->execute(['id' => $recipeId]);

    header("Location: index.php?message=Recette supprimée avec succès");
    exit;
}
?>
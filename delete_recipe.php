<?php
require_once './config/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        echo "<p>ID de recette invalide.</p>";
        exit;
    }

    $id = intval($_POST['id']);

    try {
        $stmt = $bdd->prepare("DELETE FROM recipes WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo "<p>Recette supprimée avec succès.</p>";
        echo "<a href='index.php'>Retour à la liste des recettes</a>";
        exit;
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
        exit;
    }
}
?>
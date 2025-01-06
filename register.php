<?php
require_once "./_includes/header.php";
require_once "./config/Database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);

    try {
        $stmt = $bdd->prepare("INSERT INTO users (username, email, passwd) VALUES (:username, :email, :passwd)");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'passwd' => $passwd
        ]);
        echo "Inscription réussie !";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

?>

<main class="container-register">
    <div class="card-register">
        <h1>Inscription</h1>
        <form method="POST" action="register.php">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" name="username" id="username" required>
            
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
            
            <label for="passwd">Mot de passe :</label>
            <input type="passwd" name="passwd" id="passwd" required>
            
            <button type="submit">S'inscrire</button>
        </form>
        <a href="login.php">Se connecter</a>
    </div>
</main> 

<?php
require_once "./_includes/footer.php";
?>
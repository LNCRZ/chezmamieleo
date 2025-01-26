<?php 
session_start();

require_once "./_includes/header.php";
require_once "./config/Database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    try {
        $stmt = $bdd->prepare("SELECT * FROM users WHERE username = :username OR email = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($passwd, $user['passwd'])) {
            // Connexion réussie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: souvenirs.php");
            exit;
        } else {
            // Connexion échouée
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<main class="container-login">
    <div class="card-login">
        <h1>Connexion</h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label for="username">Email :</label>
            <input type="text" name="username" id="username" required>
            
            <label for="passwd">Mot de passe :</label>
            <input type="passwd" name="passwd" id="passwd" required>
            
            <button type="submit">Se connecter</button>
        </form>
        <a href="register.php">S'inscrire</a>
    </div>
</main>

<?php 
require_once "./_includes/footer.php";

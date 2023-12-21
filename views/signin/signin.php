<?php
if (isset($_SESSION['role'])) {
    header('Location:index.php?page=home');
}
$title = 'Connexion';
ob_start();
?>

<main>
    <h1>Formulaire de connexion</h1>
    <?php
    if (isset($errorFindUser)) {
        echo ("<p>$errorFindUser</p>");
    }
    if (isset($errorMail)) {
        echo ("<p>$errorMail</p>");
    }
    ?>
    <form action="index.php?page=signin&action=login" method="POST">
        <div>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" />
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" />
        </div>

        <button>Se connecter</button>
    </form>
</main>

<?php
$content = ob_get_clean();
require_once('views/template.php');
?>
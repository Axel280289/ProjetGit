<!-- 
    Que doit voir chaque type d'utilisateur ?
    - Utilisateur classic : Logo, Accueil, Connexion
    - Utilisateur classic connecté : Logo, Accueil, Déconnexion
    - Utilisateur admin connecté : Logo, Accueil, Gestion, Déconnexion

    Pour savoir si un utilisateur est connecté on peut vérifier si
    la variable $_SESSION['role'] existe, cette variable est créé au moment
    de la connexion

    Ensuite il ne reste plus qu'à savoir si l'utilisateur connecté est un
    administrateur ou un simple membre pour cela on vérifie la valeur de
    la variable $_SESSION['role'] qui vaut 0 pour un membre classic et 1 pour
    un membre admin.
-->
<header>
    <nav>
        <ul>
            <li><a href="index.php?page=home">Logo</a></li>
            <li><a href="index.php?page=home">Accueil</a></li>
            <?php if (!isset($_SESSION['role'])) : ?>
                <li><a href="index.php?page=signin">Connexion</a></li>
            <?php else : ?>
                <?php if ($_SESSION['role'] == '1') : ?>
                    <li><a href="index.php?page=management">Gestion</a></li>
                <?php endif; ?>
                <li>
                    <form action="index.php?action=disconnect" method="POST">
                        <button>Déconnexion</button>
                    </form>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    /*
            Dans une architecture MVC tous les liens commencent depuis le "dossier racine" du projet
            on parle de racine car on appel aussi l'organisation d'un projet une "arborescence" on gros
            il faut voir votre projet comme un arbre dont les sous-dossiers et fichiers sont les 
            sous-racines. 

            Le dossier dit "racine" est le dossier qui englobe tout votre projet, ici il s'appel "mvc"
            donc on commence toujours nos liens en se basant sur le fait qu'il débute toujours à la racine.

            Dans un projet classic on aurai écrit pour ici "../public/styles/style.css" mais comme on commence
            toujours depuis la racine on écrit directement "public/styles/styles.css"
        */
    ?>
    <link rel="stylesheet" href="public/styles/style.css">
    <title>Site - <?php echo ($title); ?></title>
</head>

<body>
    <div class="container">
        <?php require_once('views/widgets/header.php'); ?>
        <?php echo ($content); ?>
        <?php require_once('views/widgets/footer.php'); ?>
    </div>

    <script src="public/scripts/app.js"></script>
</body>

</html>
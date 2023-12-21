<?php
/* Lorsque la fonction qui fait appel à cette View, en l'occurence home() pour cette view
        La variable $title présente dans la template va être remplacé par la valeur qui lui
        est assigné ici.
    */
$title = 'Accueil';

/*  
        La fonction ob_start() va analyser tout le code qui la suit jusqu'à ce que la fonction
        ob_get_clean() apparaisse, puis va stocker toute son analyse dans cette méthode.
    */
ob_start();
?>

<main>
    <h1>Bienvenue sur le site</h1>
    <?php
    /* 
            Si un utilisateur s'est connecté
            une donnée a été créée et stocké dans
            la superglobal $_SESSION
            
            ici si l'index "lastname" existe 
            dans $_SESSION
        */
    if (isset($_SESSION['lastname'])) :
    ?>
        <!-- 
            Si il existe on affiche un message personnalisé 
            Si aucun utilisateur n'est connecté
            l'utilisateur ne vera aucun message
        -->
        <h2>Bonjour <?php echo ($_SESSION['lastname'] . ' ' . $_SESSION['firstname']); ?></h2>
    <?php endif; ?>
</main>

<?php
/*  
        En arrivant à ce niveau la fonction ob_start au fini d'analyser le contenu et stockera son
        analyse dans la fonction ob_get_clean, cette dernière sera ensuite transféré dans la variable
        $content qui lorsque la fonction home() sera appelé, remplacement la variable $content présente
        dans la template par le contenu qui a été stocké.
    */
$content = ob_get_clean();
require_once('views/template.php');
?>
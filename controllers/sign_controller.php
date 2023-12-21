<?php
require_once('models/Sign.php');

function signin()
{
    require_once('views/signin/signin.php');
}

function login()
{
    /*  
            La fonction login est exécuter lorsque l'on se rend
            à l'adresse index.php?page=signin&action=login

            En validant le formulaire de connection on accède
            à ce chemin qui est présent dans l'attribut action de
            la balise form

            La méthode POST est utilisé, les données sont donc
            envoyés dans la superglobale $_POST

            Ici nous somme dans le controlleur c'est donc
            lui qui va "controller" les données qui sont envoyées
            depuis le formulaire
        */
    try {
        /* 
                On verifie si $_POST['email'] existe
                donc si le formulaire a été validé 
            */
        if (isset($_POST['email'])) {
            /* 
                    Si il existe on peut commencer le controle de nos données 
                    
                    On commence par sécuriser les données qui ont été envoyées
                    avec les fonction trim(), strip_tags() et htmlspecialchars()
                */
            $mail = htmlspecialchars(strip_tags(trim($_POST['email'])));
            $password = htmlspecialchars(strip_tags(trim($_POST['password'])));

            /* Les données ont été sécurisées, on peut continuer le controle de nos données
                    avec ici la fonction filter_var() qui va s'occuper
                    de vérifier si l'email est un email valide
                */
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                /* 
                        Si l'email est valide je crée
                        un nouvel objet à partir du model Sign
                        
                        On fait ensuite appel à la méthode signin
                        qui reçoit en paramètre l'email que l'utilisateur
                        a saisie dans le formulaire

                        La méthode signin fait elle même appel à la méthode
                        verifUser du model User qui reçoit également en paramètre
                        l'email

                        Cette dernière méthode va récupérer des données en vérifiant si
                        l'un des utilisateur possède l'email saisie.

                        Si c'est le cas $user contiendra un tableau associatif contenant
                        toutes les informations de l'utilisateur qui possède l'email.

                    */
                $sign = new Sign();
                $user = $sign->signin($mail);

                /* Si un utilisateur a été trouvé, count envera une valeur supérieure à 0 */
                if (is_array($user) && count($user) > 0) {
                    /* 
                            Un utilisateur a été trouvé, on peut maintenant
                            vérifier le mot de passe qui a été saisie avec la 
                            fonction password_verify qui va vérifier si le mot
                            de passe saisie correspond au mot de passe hashé
                            trouvé dans la base de données.
                        */
                    $verifPassword = password_verify($password, $user['password']);

                    /* Si le mot de passe correspond on peut créer la session de l'utilisateur
                            en créant des éléments dans la superglobale $_SESSION qui contiend
                            tout ce qui est en rapport avec la session de l'utilisateur
                        */
                    if ($verifPassword) {
                        /* 
                                On stocke ici le nom et le prénom
                                afin de les récupérer et les utiliser
                                sur la page home pour afficher un
                                message personnalisé.
                            */
                        $_SESSION['lastname'] = $user['lastname'];
                        $_SESSION['firstname'] = $user['firstname'];

                        /* 
                                On stocke également la donnée role qui
                                va permettre d'afficher certains éléments
                                selon si l'utilisateur est un simple utilisateur
                                ou un administrateur 
                            */
                        $_SESSION['role'] = $user['roleuser'];

                        /* Lorsque la session est créée, on redirige l'utilisateur vers l'accueil */
                        header('Location:index.php?page=home');
                    } else {
                        /* Si le mot de passe saisie ne correspond 
                                pas au mot de passe stocké dans la base de
                                données  
                            */
                        $errorFindUser = 'Email ou Mot de passe incorrect';
                        require_once('views/signin/signin.php');
                    }
                } else {
                    /* Si aucun utilisateur n'a été trouvé */
                    $errorFindUser = 'Email ou Mot de passe incorrect';
                    require_once('views/signin/signin.php');
                }
            } else {
                /* Si l'email n'est pas valide */
                $errorMail = "Email invalide";
                require_once('views/signin/signin.php');
            }
        }
    } catch (Exception $error) {
        echo ('Erreur Sign Login : ' . $error);
    }
}

function disconnect()
{
    /* 
            Pour permettre à un utilisateur de se déconnecter 
            on utilise la fonction session_destroy() pour mettre
            fin à la session
        */
    session_destroy();

    /* On redirige ensuite l'utilisateur vers la page d'accueil */
    header('Location:index.php?page=home');
}

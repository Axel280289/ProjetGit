<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
        Lorsque l'on a besoin de créer un système d'authentification
        on insert la fonction session_start() au début de notre code
        avant tout code HTML

        Dans le MVC, l'index.php est le routeur, en fonction de tel ou tel
        route que l'on a définit il va exécuter une fonction
        qui fera appel au HTML il faut donc mettre la fonction session_start();
        avant l'ensemble des conditions if.
    */
session_start();
/* 
        L'architecture Model-View-Controller (MVC) permet de séparer le côté requête, le côté logique et le côté visuel
        d'un site.

        Le côté requête est désigné par le Model qui va s'occuper uniquement d'effectuer des requêtes SQL vers la 
        base de données pour récupérer les données dont on aurai besoins (PHP/SQL)

        Le côté visuel est désigné par la View qui va contenir uniquement le code permettant à l'utilisateur d'avoir 
        une interface avec laquelle interragir (HTML/PHP). 
            La View contiendra plus spécifiquement le contenu principale de la page, elle sera couplé à ce que l'on 
            appel une Template (ou un Layout) qui va contenir la structure de base d'une page HTML. (HTML/JS/CSS/PHP)

        Le côté logique est désigné par le Controller qui va contenir et "contrôller" toutes les informations envoyées 
        depuis la Vue via les formulaires avant de faire les requêtes présent dans le Model, ou "contrôller" les données 
        récupérées depuis les requête du Model pour pouvoir les transmettre à la View qui les affichera, Le Controller 
        sert donc de pont entre le Model et la View. (PHP)

        Quand un site est hébergé sur un serveur, celui-ci recherche en premier lieux le fichier nommé index.php.
        Ce dernier correspond en générale à la page d'accueil du site. Dans une architecture MVC, l'index correspond à ce
        que l'on appel un "Router", c'est lui qui va permettre à l'utilisateur de passer d'une page à l'autre grâce à des
        url préconçues par le développeur (index.php?page=home) basé sur un système de paramètre présent dans l'url (page=home)

        Lorsque un formulaire en méthode GET envoie ses données, celle-ci sont envoyées dans l'url et sont ensuite récupérées
        via la superglobale $_GET, c'est sur ce principe que les url sont construites, en mettant des paramètres dans l'url, on
        peut les récupérer via la superglobale et diriger notre utilisateur en fonction de ses paramètres.

        En fonction des paramètres récupérés, on va diriger l'utiliseur grâce à des fonctions présentes dans les controllers.
        C'est ces fonctions qui feront appelles aux différentes Views à afficher en fonction des paramètres de l'url.
    
    */

/* Dans un site, il y a généralement plusieurs controllers selon l'action qui doit être fait ou la page que l'on souhaite
        afficher, pour éviter d'avoir à tous les appeler et afin d'avoir un code plus "propre", ils ont tous été au préalable 
        appelés dans un controller principale qui s'appel ici 'main_controller'.
    */
require_once('controllers/main_controller.php');

/* Je vérifie si le paramètre page existe (index.php?page)*/
if (isset($_GET['page'])) {
    /* 
            Si le paramètre page existe, je vérifie la valeur de ce paramètre (index.php?page=xxx) 
            selon la valeur de ce paramètre j'appelle la fonction correspondante
        */
    if ($_GET['page'] === 'home') {

        home();
    } else if ($_GET['page'] === 'signin') {
        /* 
                Dans certains pages, il se peut qu'il est des actions à faire 
                c'est le cas de la page de connexion où un formulaire permet à
                l'utilisateur de se connecter, on prévoie donc un paramètre action
                avec ici la valeur login, qui va faire appel à une fonction du même nom
            */
        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'login') {
                login();
            } else {
                signin();
            }
        } else {
            signin();
        }
    } else {
        /* 
                Il se peut que certains malin, pourraient avoir l'idée de saisir une valeur inapproprié
                il faut donc tenir compte du cas où soit le paramètre n'a aucune valeur, soit la valeur ne 
                correspond à aucune de celles qui ont été pré-enregistrées.

                Ici pour ces deux cas de figure, on redirige vers l'accueil.
            */
        home();
    }
} else {
    /* 
            Si le paramètre page n'est pas présent 
            on vérifie si le paramètre action est présent
        */
    if (isset($_GET['action'])) {
        /* 
                Si la valeur du paramètre action vaut "disconnect"  
                je fait appel à la fonction disconnect() que l'on trouve
                dans le sign_controller
            */
        if ($_GET['action'] === 'disconnect') {
            disconnect();
        } else {
            /* 
                    Dans le cas où le paramètre action est présent
                    mais n'a aucune valeur 
                */
            home();
        }
    } else {
        /* Dans le cas où le paramètre action n'est pas présent */
        home();
    }
}


    /*
        Version optimisé
        -----------------------------------------------------------------------------

        getPage($_GET['page']);

        function getPage($page) {
            if(isset($page)) {
                switch($page) {
                    case 'home' : home(); break;
                    case 'signin' : getAction($_GET['action'], 'signin'); break;
                    default: home();
                }
            } else {
                home();
            }
        }

        function getAction($action, $page) {
            if(isset($action)) {
                switch($action) {
                    case 'disconnect' : disconnect(); break;
                    case 'login' : login(); break;
                    default : $page();
                }
            } else {
                page();
            }
        }
    */
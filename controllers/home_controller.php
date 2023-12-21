c<?php

    /* 
    Le controller est l'élément qui va faire le pont entre le model et la views
    on fait donc appel au model au début du controller et ensuite la view à afficher 
    est appelée dans les différentes fonction du controller.

    les fonction du Controller vont contenir et "contrôller" toutes les informations envoyées 
    depuis la View via les formulaires avant de faire les requêtes présent dans le Model, 
    ou "contrôller" les données récupérées depuis les requêtes du Model pour pouvoir les transmettre 
    à la View qui les affichera.

*/
    require_once('models/Home.php');

    function home()
    {
        require_once('views/home/home.php');
    }

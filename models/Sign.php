<?php

require_once('models/Users.php');

/* 
        Pour rappel "final" indique qu'il est le dernier de sa ligner et qu'il ne pourra pas avoir
        d'héritiers 
    */
final class Sign extends Users
{

    /* 
            On se trouve dans le model Sign qui
            qui va s'occuper de gérer tout ce qui
            est connexion (signin/login), inscription (signup)
            et déconnexion (logout/disconnect)
        */

    /* 
            On crée ici une méthode signin en accès
            public pour y avoir accès depuis l'extérieure 
            du model

            Cette méthode va recevoir en paramètre 
            un email
        */
    public function signin($mail)
    {
        /* 
                Le model Sign est l'enfant du model User
                ce dernier possède une méthode verifUser qui
                est en protected, Sign peut donc accéder à 
                cette méthode

                On crée une variable $user qui
                va faire appel à la méthode verifUser
                qui prend en paramètre un mail, on lui transfère
                donc notre paramètre $mail reçu dans la methode signin

                La variable $user va recevoir des données
                on effectue un return pour la méthode signin
                retourne le contenu de la variable $user
            */
        $user = $this->verifUser($mail);
        return $user;
    }
}

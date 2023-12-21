<?php

require_once('models/Database.php');

class Users extends Database
{

    /* 
            On crée une méthode verifUser qui va recevoir
            un mail en paramètre, la méthode ne doit pas 
            être accessible depui l'extérieure, mais doit rester
            accessible pour ces enfants, on utilise
            donc le mot clé protected au moment
            de la création de la méthode.
        */
    protected function verifUser($mail)
    {
        /* 
                Le model Users est l'enfant du model
                Database, Users a donc accès aux méthodes
                créé dans le model Database

                on fait donc appel ici à la méthode connect()
                qui permet de connecter notre projet à la base de données
                à partir de là on va pouvoir créer et exécuter diverses requêtes
                SQL pour Créer, Lire, Modifier ou Supprimer des données 
            */
        $db = $this->connect();

        /* 
                Pour vérifier si un utilisateur existe en fonction d'un mail 
                On utilise 
                "SELECT *" pour sélectionner toutes les informations
                "FROM users" contenues dans la table users
                "WHERE mail = :mail" on récupère les lignes où l'email correspondra
                à un "paramètre nommé", ":mail".
                Les "paramètres nommés" sont utilisés lorsque l'on "prépare" une requête
            */
        $requestVerifUser = "SELECT * FROM users WHERE mail = :mail";

        /* 
                La requête est définit on peut donc la "préparer" se système est utilisé pour
                contrer les "injection SQL" utilisé par les hackeur pour obtenir des informations
                via des requêtes sql
                
                Pour préparer la requête on fait donc appel à la connection de la
                base de donnée $db qui est créé à partir de l'objet PDO et
                depuis cet objet on a accès à la méthode prepare qui prend en paramètre
                la requête à préparer
            */
        $verifUser = $db->prepare($requestVerifUser);

        /*
                La requête est maintenant "préparé" on peut faire appel à la méthode
                bindParam de PDO pour faire correspondre le "paramètre nommé" :mail 
                au paramètre que la méthode verifUser va recevoir, $mail 
            */
        $verifUser->bindParam(':mail', $mail);

        /* Il ne reste plus qu'à exécuter notre requête avec la méthode execute() */
        $verifUser->execute();

        /*  
                L'exécution de la requête va dans le cas où le mail est trouvé
                dans la table users, récupérer une la ligne qui contient l'email 
                On utilise ensuite la méthode fetch() pour récupérer ses données
                et les stocker dans une variable
            */
        $user = $verifUser->fetch();

        /* 
                les informations récupérées
                seront stocker sous forme d'un tableau associatif
                
                $user = array(
                    'lastname' => '',
                    'firstname' => '',
                    'mail' => '',
                    'password' => '',
                    'roleuser' => '',
                    'idAddress' => ''
                ) 
                
                on retourne ensuite la variable pour faire
                remonter les données vers une autre variable
            */
        return $user;
    }
}

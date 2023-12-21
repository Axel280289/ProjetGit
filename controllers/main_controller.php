<?php

/* 
        Les controllers doivent être appelés au début du routeur, pour éviter
        d'avoir trop d'appel de controller au début du router (index.php) et 
        avoir un router plus "propre" on appel tous les controllers dans ce 
        controller principale et c'est lui qui sera ensuite appelé dans le
        router.
    */
require_once('controllers/home_controller.php');
require_once('controllers/sign_controller.php');

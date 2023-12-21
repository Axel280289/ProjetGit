-- Créer une base de données
CREATE DATABASE gitemoulin;

-- Créer une TABLE
CREATE TABLE addressusers (
    /* 
        Chaque lignes de données dans une table 
        a besoin d'un identifiant   
        ici l'identifiant sera "idAddress"
        les identifiant de table sont généralement 
        des nombres entier (INT = integer = nombre entier)
        
        Dès qu'une nouvelle adresse sera créée on veut
        que l'identifiant soit généré automatiquement (AUTO_INCREMENT)
        
        l'identifiant est généralement appelé "Clé primaire"
    */
    `idAddress` INT AUTO_INCREMENT,

    /*
        Dans cette table la donnée "street"
        correspond au numéro et au nom de la rue
        il s'agit donc d'une chaîne de caractère
        on va utiliser VARCHAR qui peut contenir du texte
        VARCHAR peut accepter au maximum 255 caractères

        Pour les textes faisant plus de 255 caractères on
        utilisera TEXT  

        La donnée ne doit pas être vide ou "null" (NOT NULL)  
    */
    `street` VARCHAR(255) NOT NULL,

    /*
        zipcode correpond au Code Postal
        les codes postaux français ayant 5 caractères
        maximum j'utilise VARCHAR et limite à 5 caractères maximum
        VARCHAR(5) 
    */
    `zipcode` VARCHAR(5) NOT NULL,
    `city` VARCHAR(255) NOT NULL,

    /* 
        Pour indiquer à notre table que la donnée "idAddress" 
        sera la "clé primaire" on utilise les mots-clés 
        "PRIMARY KEY" suivi de la donnée
    */
    PRIMARY KEY (`idAddress`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
    On utilise ENGINE pour définir le moteur SQL utilisé
    Ainsi que CHARSET pour définir le type d'encodage

    Pour des données française on utilisera généralement
    l'encodage CHARSET=utf8

    Pour des données plus diversifiés 
    (arabe, grec, russe, ...) on utilisera 
    CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
*/

CREATE TABLE users (
    `id` INT AUTO_INCREMENT,
    `lastname` VARCHAR(255) NOT NULL,
    `firstname` VARCHAR(255) NOT NULL,
    `mail` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `roleuser` INT NOT NULL,
    `idAddress` INT NOT NULL,
    PRIMARY KEY (`id`),

    /* 
        La table users aura une donnée "idAddress 
        cette donnée fera référence à l'une des adresse
        de la table addressusers grâce à la clé primaire de adresseusers
        qui s'appel également "idAddress"

        Lorsqu'on fait appel à une clé primaire issue d'une 
        autre table, cette clé est appelé "clé étrangère" 
        pour la différencier de la clé primaire de la table 
        users

        Pour créer une liaison entre la table users et addressusers
        on utilise le mot-clé CONSTRAINT suivi d'un nom pour nommer 
        la liaison "FK_users_addressusers"

        On indique ensuite avec "FOREIGN KEY" le nom de la donnée qui
        sera la "clé étrangère", ici il s'agit de "idAddress"

        Puis on lui réfère sa correspondante dans l'autre table
        "REFRENCES addresssusers (idAddress)"
    */
    CONSTRAINT `FK_users_addressusers` FOREIGN KEY (`idAddress`) REFERENCES addressusers (`idAddress`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- CREATE : Premières données
/* 
    Pour ajouter une ligne de données dans une table 
    on utilise les mot-clé INSERT INTO pour "insérer dans"
    la table "addressusers" dans les champs "street, zipcode, city"
    les valeurs "VALUES" que l'on souhaite ajouter

    Pour ajouter plusieurs lignes, on met à la suite du premier ajout
    une virgule suivi d'une paire de parenthèse contenant les infomations
    sous le même format (street, zipcode, city).
*/
INSERT INTO addressusers(street, zipcode, city) VALUES (
    '1 rue du Général de Gaulle',
    59400,
    'Cambrai'
),
(
    '3 rue du Général de Gaulle',
    59400,
    'Cambrai'
)

INSERT INTO users (lastname, firstname, mail, password, roleuser, idAddress) VALUES (
    'Doe',
    'John',
    'jd@mail.com',
    '$2y$10$bba3T4yBC5/E4cNJJ.VSNeyFGFFXepQ7VMfosHtpVjsyx96687U1K',
    0,
    1
),
(
    'adminLast',
    'adminFirst',
    'admin@mail.com',
    '$2y$10$ItwglMXr4dvlVvuUOX3A8e0zrfN9Gb557hjtWJjEkiFVyGk1O57GG',
    1,
    2
)

-- UPDATE : Mise à jour
/* 
    Pour effectuer une modification/mise à jour d'une ou plusieurs données
    on utilise les mot-clé UPDATE suivi du nom de la table
    dans laquelle on veut modifier des informations

    On définit après SET les champs à modifier avec leurs nouvelles valeurs
    si on veut modifier plusieurs informations on les sépare par des virgules
    (champ = valeur, champ = valeur)

    Puis on utilise WHERE pour limiter le nombre de ligne à modifier
    On complètera avec AND pour pousser la limitation dans le cas où par 
    exemple plusieurs utilisateur se nommerai "Doe"
*/
UPDATE users SET mail = 'john-doe@mail.com' WHERE lastname = 'Doe' AND id = 1;

-- DELETE : Supprimer
INSERT INTO users (lastname, firstname, mail, password, roleuser, idAddress) VALUES (
    'deleteLast',    'deleteFirst',    'delete@mail.com',
    '$2y$10$bba3T4yBC5/E4cNJJ.VSNeyFGFFXepQ7VMfosHtpVjsyx96687U1K',    0,
    1
);

/* 
    Pour supprimer un élément on utilise les mot-clé 
    DELETE FROM suivi du nom de la table dans laquelle 
    on va supprimer une ligne d'informations

    Puis on utilise WHERE pour définir précisément la ligne à supprimer
*/
DELETE FROM users WHERE id = 3;

-- READ
/*
    Pour récupérer et lire des données on utilise le mot-clé 
    SELECT suivi des champs que l'on souhaite afficher séparés par des virgules

    on utilise ensuite FROM pour définir la table où l'on souhaite récupérer
    des données

    Si l'on veut afficher l'intégraliter des données on peut s'arrêter là 
    Si l'on veut filtrer en fonction de certaines informations
    on utilise WHERE suivi d'un champ et d'un valeur de filtrage
*/
SELECT mail FROM users WHERE id = 2;
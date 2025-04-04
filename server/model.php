<?php
/**
 * Ce fichier contient toutes les fonctions qui réalisent des opérations
 * sur la base de données, telles que les requêtes SQL pour insérer, 
 * mettre à jour, supprimer ou récupérer des données.
 */

/**
 * Définition des constantes de connexion à la base de données.
 *
 * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
 * DBNAME : Nom de la base de données
 * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
 * DBPWD : Mot de passe pour se connecter à la base de données.
 */
define("HOST", "localhost");
define("DBNAME", "reich2");
define("DBLOGIN", "reich2");
define("DBPWD", "reich2");

function getAllFilm(){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = "SELECT * FROM Movie";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

function addFilm($Titre, $Réalisateur, $Année, $Durée, $Description, $categorie, $file, $URL, $Restrictions) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD); 
    
    $stmtCat = $cnx->prepare("SELECT id FROM Category WHERE name = :name");
    $stmtCat->bindParam(':name', $categorie);
    $stmtCat->execute();
    $cat = $stmtCat->fetch(PDO::FETCH_ASSOC);
    
    // Si la catégorie existe
    if ($cat) {
        $id_categorie = $cat['id'];

        // Requête SQL d'insertion du film
        $sql = "INSERT INTO Movie (name, director, year, length, description, id_category, image, trailer, min_age)
                VALUES (:name, :director, :year, :length, :description, :id_category, :image, :trailer, :min_age)";
        $stmt = $cnx->prepare($sql);

        // Lie les paramètres
        $stmt->bindParam(':name', $Titre);
        $stmt->bindParam(':director', $Réalisateur);
        $stmt->bindParam(':year', $Année);
        $stmt->bindParam(':length', $Durée);
        $stmt->bindParam(':description', $Description);
        $stmt->bindParam(':id_category', $id_categorie);
        $stmt->bindParam(':image', $file);
        $stmt->bindParam(':trailer', $URL);
        $stmt->bindParam(':min_age', $Restrictions);

        // Exécute la requête SQL
        $stmt->execute();

        // Retourne le nombre de lignes affectées
        return $stmt->rowCount();
    }
    return 0; // Catégorie non trouvée, rien ajouté
}
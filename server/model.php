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

function getAllFilm($Age) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM Movie WHERE min_age <= :age";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':age', $Age, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $res; 
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

function getFilm($id) {
        $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
        $sql = "SELECT 
                    Movie.id, 
                    Movie.name, 
                    Movie.year, 
                    Movie.length, 
                    Movie.description, 
                    Movie.director, 
                    Movie.image, 
                    Movie.trailer, 
                    Movie.min_age, 
                    Category.name AS category
                FROM Movie 
                JOIN Category ON Movie.id_category = Category.id 
                WHERE Movie.id = :id";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
}


function getFilmCategorie($name_category, $age) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sqlCategory = "SELECT id FROM Category WHERE name = :name";
    $stmtCategory = $cnx->prepare($sqlCategory);
    $stmtCategory->bindParam(':name', $name_category, PDO::PARAM_STR);
    $stmtCategory->execute();
    $category = $stmtCategory->fetch(PDO::FETCH_ASSOC);
    $id_category = $category['id'];
    $sql = "SELECT *
            FROM Movie 
            WHERE id_category = :id_category AND min_age <= :age";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_category', $id_category, PDO::PARAM_INT);
    $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $res; // Retourne les films correspondant à la catégorie et à la restriction d'âge
}



function addProfil($Nom, $Age, $file) {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    // Requête SQL d'insertion du profil
    $sql = "INSERT INTO Profil (name, age, image) 
            VALUES (:name, :age, :image) 
            ON DUPLICATE KEY 
            UPDATE age = VALUES(age), 
            image = VALUES(image);";
    $stmt = $cnx->prepare($sql);

    // Lie les paramètres
    $stmt->bindParam(':name', $Nom, PDO::PARAM_STR);
    $stmt->bindParam(':age', $Age, PDO::PARAM_INT);
    $stmt->bindParam(':image', $file, PDO::PARAM_STR);

    // Exécute la requête SQL
    $stmt->execute();

    // Retourne le nombre de lignes affectées
    return $stmt->rowCount();
}


function getAllProfil(){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = "SELECT * FROM Profil";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}
function getunProfil($id){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = "SELECT * FROM Profil WHERE id = :id";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Lie le paramètre :id à la valeur de $id
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

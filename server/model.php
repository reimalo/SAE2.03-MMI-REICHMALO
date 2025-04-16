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

function addFavoris($id_film, $id_profil) {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL d'insertion du film
    $sql = "INSERT INTO Favoris (id_film, id_profil) 
            VALUES (:id_film, :id_profil)";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Lie les paramètres
    $stmt->bindParam(':id_film', $id_film, PDO::PARAM_INT);
    $stmt->bindParam(':id_profil', $id_profil, PDO::PARAM_INT);
    // Exécute la requête SQL
    $stmt->execute();
    // Retourne le nombre de lignes affectées
    return $stmt->rowCount();
}

function delFavoris($id_film, $id_profil) {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL d'insertion du film
    $sql = "DELETE FROM Favoris WHERE id_film = :id_film AND id_profil = :id_profil";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Lie les paramètres
    $stmt->bindParam(':id_film', $id_film, PDO::PARAM_INT);
    $stmt->bindParam(':id_profil', $id_profil, PDO::PARAM_INT);
    // Exécute la requête SQL
    $stmt->execute();
    // Retourne le nombre de lignes affectées
    return $stmt->rowCount();
}

function getFavoris($id_profil) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT Movie.id
            FROM Favoris 
            JOIN Movie ON Favoris.id_film = Movie.id 
            WHERE Favoris.id_profil = :id_profil";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_profil', $id_profil, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    return $res;
}

function getAllFilmFavoris($id_profil) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT Movie.*
            FROM Favoris
            JOIN Movie ON Favoris.id_film = Movie.id
            WHERE Favoris.id_profil = :id_profil";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_profil', $id_profil, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getAllFilmEnAvant($age) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT Movie.*
            FROM En_avant
            JOIN Movie ON En_avant.id_film = Movie.id
            WHERE Movie.min_age <= :age";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getAllFilm_char($age, $char) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $char = strtolower($char);
    $sql = "SELECT * FROM Movie WHERE min_age <= :age AND LOWER(name) LIKE :char";

    $stmt = $cnx->prepare($sql);
    $stmt->execute([
        ':age' => $age,
        ':char' => '%' . $char . '%'
    ]);

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


function getAllFilmFavoris_char($id_profil, $char) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $char = strtolower($char);
    $sql = "SELECT Movie.* 
            FROM Favoris 
            JOIN Movie ON Favoris.id_film = Movie.id 
            WHERE Favoris.id_profil = :id_profil 
            AND LOWER(Movie.name) LIKE :char";

    $stmt = $cnx->prepare($sql);
    $stmt->execute([
        ':id_profil' => $id_profil,
        ':char' => '%' . $char . '%'
    ]);

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

//strtolower et LOWER => pour mettre en minuscule

function getAllFilm_char_forForm($char) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $char = strtolower($char);
    
    // Requête modifiée pour inclure les films "En_avant"
    $sql = "SELECT Movie.*, En_avant.id_film AS en_avant
            FROM Movie
            LEFT JOIN En_avant ON Movie.id = En_avant.id_film
            WHERE LOWER(Movie.name) LIKE :char";

    $stmt = $cnx->prepare($sql);
    $stmt->execute([
        ':char' => '%' . $char . '%'
    ]);

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function add_Avant($id_film_add_avant) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql_add = "INSERT INTO En_avant (id_film) VALUES (:id_film)";
    $stmt = $cnx->prepare($sql_add);
    $stmt->bindParam(':id_film', $id_film_add_avant, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount();
}


function del_Avant($id_film_del_avant) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql_del = "DELETE FROM En_avant WHERE id_film = :id_film";
    $stmt = $cnx->prepare($sql_del);
    $stmt->bindParam(':id_film', $id_film_del_avant, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount();
}

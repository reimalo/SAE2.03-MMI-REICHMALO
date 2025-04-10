<?php


require("model.php");
function readController(){
    $film_list = getAllFilm();
    return $film_list;
}


function addController() {
    if (empty($_REQUEST['Titre'])) {
        return "Erreur : Le titre est obligatoire.";
    }
    if (empty($_REQUEST['Réalisateur'])) {
        return "Erreur : Le réalisateur est obligatoire.";
    }
    if (empty($_REQUEST['Année']) || !is_numeric($_REQUEST['Année'])) {
        return "Erreur : L'année est obligatoire et doit être un nombre.";
    }
    if (empty($_REQUEST['Durée']) || !is_numeric($_REQUEST['Durée'])) {
        return "Erreur : La durée est obligatoire et doit être un nombre.";
    }
    if (empty($_REQUEST['Description'])) {
        return "Erreur : La description est obligatoire.";
    }
    if (empty($_REQUEST['categorie'])) {
        return "Erreur : La catégorie est obligatoire.";
    }

    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['file']['tmp_name'];
        $filename = basename($_FILES['file']['name']);
        $upload_dir = "./images/";

        if (move_uploaded_file($tmp_name, $upload_dir . $filename)) {
            $file = $filename;
        } else {
            return "Erreur lors de l'enregistrement de l'image.";
        }
    } else {
        return "Aucun fichier image reçu.";
    }

    if (empty($_REQUEST['URL'])) {
        return "Erreur : L'URL est obligatoire et doit être valide.";
    }
    if (empty($_REQUEST['Restrictions']) || !is_numeric($_REQUEST['Restrictions'])) {
        return "Erreur : Les restrictions sont obligatoires et doivent être un nombre.";
    }

    $Titre = $_REQUEST['Titre'];
    $Réalisateur = $_REQUEST['Réalisateur'];
    $Année = $_REQUEST['Année'];
    $Durée = $_REQUEST['Durée'];
    $Description = $_REQUEST['Description'];
    $categorie = $_REQUEST['categorie'];
    $URL = $_REQUEST['URL'];
    $Restrictions = $_REQUEST['Restrictions'];

    $ok = addFilm($Titre, $Réalisateur, $Année, $Durée, $Description, $categorie, $file, $URL, $Restrictions);
    if ($ok != 0) {
        return "Le Film $Titre à été ajouté";
    } else {
        return "Erreur, le film n'a pas été ajouté";
    }
}

function infoController(){
    if (empty($_REQUEST['num_carte'])) {
        return "Erreur : L'id du film est obligatoire.";
    }
    $id = $_REQUEST['num_carte'];
    $film = getFilm($id);
    return $film;

}

function categorie_selectionController(){
    $category_name = $_REQUEST['category'];
    if ($category_name === "none") {
        $categories = getAllFilm();
    } else {
        $categories = getFilmCategorie($category_name);
    }
    return $categories;
}


function add_profilController() {
    if (empty($_REQUEST['Nom'])) {
        return "Erreur : Le Nom est obligatoire.";
    }
    if (empty($_REQUEST['Age']) || !is_numeric($_REQUEST['Age'])) {
        return "Erreur : L'age est obligatoire et doit être un nombre.";
    }
    $file = null;
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['file']['tmp_name'];
        $filename = basename($_FILES['file']['name']);
        $upload_dir = "./images/";

        if (move_uploaded_file($tmp_name, $upload_dir . $filename)) {
            $file = $filename;
        } else {
            return "Erreur lors de l'enregistrement de l'image.";
        }
    }

    $Nom = $_REQUEST['Nom'];
    $Age = $_REQUEST['Age'];

    $ok = addProfil($Nom, $Age, $file);
    if ($ok != 0) {
        return "Le profil $Nom à été ajouté";
    } else {
        return "Erreur, le profil n'a pas été ajouté";
    }
}


function getprofilController(){
    $profil_list = getAllProfil();
    return $profil_list;
}

function getunprofilController(){
    $id = $_REQUEST['id'];
    $profil = getunProfil($id);
    return $profil;
}

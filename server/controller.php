<?php


require("model.php");
function readController(){
    $film_list = getAllFilm();
    return $film_list;
}

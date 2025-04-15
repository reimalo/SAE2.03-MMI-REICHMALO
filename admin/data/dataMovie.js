let HOST_URL = "https://mmi.unilim.fr/~reich2"
let DataMovie = {};

DataMovie.add_film = async function (fdata) {
    let config = {
        method: "POST", // méthode HTTP à utiliser
        body: fdata // données à envoyer sous forme d'objet FormData
    };
    let answer = await fetch(HOST_URL + "/SAE2.03-MMI-REICHMALO/server/script.php?todo=add", config);
    let data = await answer.json();
    return data;
}

DataMovie.add_profil = async function (fdata) {
    let config = {
        method: "POST", // méthode HTTP à utiliser
        body: fdata // données à envoyer sous forme d'objet FormData
    };
    let answer = await fetch(HOST_URL + "/SAE2.03-MMI-REICHMALO/server/script.php?todo=add_profil", config);
    let data = await answer.json();
    return data;
}

DataMovie.request_char = async function (char = "") {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=read_forForm&char=${char}`);
    let data = await answer.json();
    return data;
}

DataMovie.add_Avant = async function (liste_id_film_add_avant = [], liste_id_film_del_avant = []) {
    let config = {
        method: "POST", // méthode HTTP à utiliser
    };
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=add_Avant&${liste_id_film_add_avant}&del_avant${liste_id_film_del_avant}`, config);
    let data = await answer.json();
    return data;
}

export { DataMovie };
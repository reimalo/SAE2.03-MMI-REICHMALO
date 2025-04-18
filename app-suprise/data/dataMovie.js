let HOST_URL = "https://mmi.unilim.fr/~reich2"
let DataMovie = {};

DataMovie.request = async function (age, favoris_profil_id = "", char = "") {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=read&age=${age}&favoris_profil_id=${favoris_profil_id}&char=${char}`);
    let data = await answer.json();
    return data;
}

DataMovie.info = async function (num_card) {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=info&num_carte=${num_card}`);
    let data = await answer.json();
    return data;
}

DataMovie.categorie = async function (category, age) {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=categorie_selection&category=${category}&age=${age}`);
    let data = await answer.json();
    return data;
}

DataMovie.request_enAvant = async function (age) {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=read_enAvant&age=${age}`);
    let data = await answer.json();
    return data;
}

export { DataMovie };
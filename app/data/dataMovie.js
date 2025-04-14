let HOST_URL = "https://mmi.unilim.fr/~reich2"
let DataMovie = {};

DataMovie.request = async function (age, favoris_profil_id = "") {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=read&age=${age}&favoris_profil_id=${favoris_profil_id}`);
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

DataMovie.getprofil = async function () {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=getprofil`);
    let data = await answer.json();
    return data;
}

DataMovie.getunprofil = async function (id) {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=getunprofil&id=${id}`);
    let data = await answer.json();
    return data;
}

DataMovie.addFavoris = async function (id_user, id_film) {
    let config = {
        method: "POST",
    };
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=addFavoris&id_user=${id_user}&id_film=${id_film}`, config);
    let data = await answer.json();
    return data;
}

DataMovie.delFavoris = async function (id_user, id_film) {
    let config = {
        method: "POST",
    };
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=delFavoris&id_user=${id_user}&id_film=${id_film}`, config);
    let data = await answer.json();
    return data;
}

DataMovie.getFavoris = async function (id_user) {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=getFavoris&id_user=${id_user}`);
    let data = await answer.json();
    return data;
}

DataMovie.request_enAvant = async function (age) {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=read_enAvant&age=${age}`);
    let data = await answer.json();
    return data;
}
export { DataMovie };
let HOST_URL = "https://mmi.unilim.fr/~reich2"
let DataMovie = {};

DataMovie.request = async function () {
    let answer = await fetch(HOST_URL + "/SAE2.03-MMI-REICHMALO/server/script.php?todo=read");
    let data = await answer.json();
    return data;
}

DataMovie.info = async function (num_card) {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=info&num_carte=${num_card}`);
    let data = await answer.json();
    return data;
}

DataMovie.categorie = async function (category) {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=categorie_selection&category=${category}`);
    let data = await answer.json();
    return data;
}

export { DataMovie };
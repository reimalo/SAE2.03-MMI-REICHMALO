let HOST_URL = "https://mmi.unilim.fr/~reich2"
let DataProfile = {};


DataProfile.getprofil = async function () {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=getprofil`);
    let data = await answer.json();
    return data;
}

DataProfile.getunprofil = async function (id) {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=getunprofil&id=${id}`);
    let data = await answer.json();
    return data;
}

DataProfile.addFavoris = async function (id_user, id_film) {
    let config = {
        method: "POST",
    };
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=addFavoris&id_user=${id_user}&id_film=${id_film}`, config);
    let data = await answer.json();
    return data;
}

DataProfile.delFavoris = async function (id_user, id_film) {
    let config = {
        method: "POST",
    };
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=delFavoris&id_user=${id_user}&id_film=${id_film}`, config);
    let data = await answer.json();
    return data;
}

DataProfile.getFavoris = async function (id_user) {
    let answer = await fetch(HOST_URL + `/SAE2.03-MMI-REICHMALO/server/script.php?todo=getFavoris&id_user=${id_user}`);
    let data = await answer.json();
    return data;
}

export { DataProfile };
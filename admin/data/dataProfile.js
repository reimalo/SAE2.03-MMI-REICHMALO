let HOST_URL = "https://mmi.unilim.fr/~reich2"
let DataProfil = {};

DataProfil.add_profil = async function (fdata) {
    let config = {
        method: "POST", // méthode HTTP à utiliser
        body: fdata // données à envoyer sous forme d'objet FormData
    };
    let answer = await fetch(HOST_URL + "/SAE2.03-MMI-REICHMALO/server/script.php?todo=add_profil", config);
    let data = await answer.json();
    return data;
}

export { DataProfil };
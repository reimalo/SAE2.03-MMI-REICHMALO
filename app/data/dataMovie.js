let HOST_URL = "https://mmi.unilim.fr/~reich2"
let DataMovie = {};

DataMovie.request = async function () {
    let answer = await fetch(HOST_URL + "/SAE2.03-MMI-REICHMALO/server/script.php?todo=read");
    let data = await answer.json();
    return data;
}


export { DataMovie };
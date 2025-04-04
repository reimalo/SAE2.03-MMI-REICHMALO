let HOST_URL = "https://mmi.unilim.fr/~reich2"
let DataMenu = {};

DataMenu.request = async function (week, day) {
    let answer = await fetch(HOST_URL + "/SAE2.03-MMI-REICHMALO/server/script.php?todo=read&semaine=" + week + "&jour=" + day);
    let data = await answer.json();
    return data;
}


export { DataMenu };
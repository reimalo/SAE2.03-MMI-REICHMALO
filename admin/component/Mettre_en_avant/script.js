let templateFile = await fetch('./component/Mettre_en_avant/template.html');
let template = await templateFile.text();
let NewAvantForm = {};

NewAvantForm.format = function () {
    let html = template;
    return html;
}


export { NewAvantForm };


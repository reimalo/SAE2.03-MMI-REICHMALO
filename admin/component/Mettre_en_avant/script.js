let templateFile = await fetch('./component/Mettre_en_avant/template.html');
let template = await templateFile.text();
let NewAvantForm = {};

NewAvantForm.format = function (handler) {
    let html = template;
    html = html.replace('{{handler}}', handler);
    return html;
}


export { NewAvantForm };


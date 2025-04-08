
let templateFile = await fetch('./component/categorie_selector/template.html');
let template = await templateFile.text();


let categorie_selectorForm = {};

categorie_selectorForm.format = function(handler) {
    let html = template;
    html = html.replace('{{handler}}', handler);
    return html;
}

export { categorie_selectorForm };



let templateFile = await fetch('./component/age_filter/template.html');
let template = await templateFile.text();


let filtre_age = {};

filtre_age.format = function(age) {
    let html = template;
    html = html.replace('{{age}}', age);
    return html;
}

export { filtre_age };


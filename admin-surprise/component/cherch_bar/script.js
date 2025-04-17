let templateFile = await fetch('./component/cherch_bar/template.html');
let template = await templateFile.text();


let cherch_bar = {};

cherch_bar.format = function() {
    let html = template;
    return html;
}

export { cherch_bar };


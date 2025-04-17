let templateFile = await fetch("./component/titre_en_avant/template.html");
let template = await templateFile.text();

let titre_en_avant = {};

titre_en_avant.format = function () {
  let html = template;
  return html;
};

export { titre_en_avant };
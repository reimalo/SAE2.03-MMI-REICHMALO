let templateFile = await fetch("./component/film_favoris/template.html");
let template = await templateFile.text();

let film_favoris = {};

film_favoris.format = function () {
  let html = template;
  return html;
};

export { film_favoris };

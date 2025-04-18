let templateFile = await fetch("./component/film_card/template.html");
let template = await templateFile.text();

let film_card = {};

film_card.format = function (film) {
  let html = template;
  html = html.replace("{{chemin}}", "../server/images/" + film.image);
  html = html.replace("{{titre}}", film.name);
  html = html.replace("{{id}}", film.id);
  if (film.en_avant == null) {
    html = html.replace("{{chek}}", "");
  } else {
      html = html.replace("{{chek}}", "checked");
  }
  return html;
};

export { film_card };
let templateFile = await fetch("./component/film_info/template.html");
let template = await templateFile.text();

let film_info = {};

film_info.format = function (film) {
  let html = template;
  html = html.replace("{{image}}", "../server/images/" + film.image);
  html = html.replace("{{name}}", film.name);
  html = html.replace("{{description}}", film.description);
  html = html.replace("{{categorie}}", film.category);
  html = html.replace("{{director}}", film.director);
  html = html.replace("{{year}}", film.year);
  html = html.replace("{{min_age}}", film.min_age);
  html = html.replace("{{trailer}}", film.trailer);
  return html;
};

export { film_info };

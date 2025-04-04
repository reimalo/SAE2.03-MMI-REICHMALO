let templateFile = await fetch("./component/film_card/template.html");
let template = await templateFile.text();

let film_card = {};

film_card.format = function (hHome) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  return html;
};

export { film_card };

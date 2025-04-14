let templateFile = await fetch("./component/film_card_en_avant/template.html");
let template = await templateFile.text();

let film_card_en_avant = {};

film_card_en_avant.format = function (film, favoris_icon) {
  let html = template;

  // Vérifier si l'ID du film est dans la liste des favoris
  if (favoris_icon.includes(film.id)) {
    html = html.replace("{{path_star}}", "../assets/images/star_active.svg");
    html = html.replace("{{couleur_fond}}", "style='background-color: var(--color-white);'");
  } else {
    html = html.replace("{{path_star}}", "../assets/images/star_notactive.svg");
    html = html.replace("{{couleur_fond}}", "style='background-color: var(--color-yellow);'");
  }

  // Remplacer les autres valeurs dans le template
  html = html.replace("{{chemin}}", "../server/images/" + film.image);
  html = html.replace("{{titre}}", film.name);
  html = html.replace("{{description}}", film.description);
  html = html.replace("{{id}}", film.id);

  return html;
};

export { film_card_en_avant };
let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (profil) {
  let html = template;

  if (profil != "") {
    html = html.replace("{{chemin}}", "../server/images/" + profil.image);
    html = html.replace("{{name}}", profil.name);
    html = html.replace("{{Age}}", profil.age);
    html = html.replace("{{id}}", profil.id);
    html = html.replace("navbar__item--invisible", "navbar__item--visible"); // Profil visible
  } else {
    html = html.replace("navbar__item--visible", "navbar__item--invisible"); // Profil caché
  }

  return html;
};

export { NavBar };

let templateFile = await fetch("./component/profil_selector/template.html");
let template = await templateFile.text();

let profil_selector = {};

profil_selector.format = function (profil) {
  let html = template;
  html = html.replace("{{chemin}}", "../server/images/" + profil.image);
  html = html.replace("{{name}}", profil.name);
  html = html.replace("{{Age}}", profil.age);
  html = html.replace("{{id}}", profil.id);


  return html;
};

export { profil_selector };

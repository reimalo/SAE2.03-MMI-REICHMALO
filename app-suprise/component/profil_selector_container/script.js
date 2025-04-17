let templateFile = await fetch("./component/profil_selector_container/template.html");
let template = await templateFile.text();

let profil_selector_container = {};

profil_selector_container.format = function () {
  let html = template;
  return html;
};

export { profil_selector_container };

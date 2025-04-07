let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function () {
  let html = template;
  return html;
};

export { NavBar };

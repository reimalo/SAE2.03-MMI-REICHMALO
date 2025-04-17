let templateFile = await fetch("./component/footer/template.html");
let template = await templateFile.text();

let footer = {};

footer.format = function () {
  let html = template;
  return html;
};

export { footer };

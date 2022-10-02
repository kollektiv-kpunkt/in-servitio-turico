import tippy from "tippy.js";
import "tippy.js/dist/tippy.css";
import "tippy.js/animations/perspective.css";

if (document.querySelector("g.ist-constituency")) {
  let constituencies = document.querySelectorAll("g.ist-constituency");
  constituencies.forEach((constituency) => {
    let name = constituency.getAttribute("data-constituency-name");
    tippy(constituency, {
      content: name,
      animation: "perspective",
    });

    constituency.addEventListener("click", (e) => {
      let slug = constituency.getAttribute("data-ist-constituency-slug");
      e.preventDefault();
      alert(
        "You clicked on " +
          name +
          ". The link would take you to the page for that constituency. This functionality is not yet implemented."
      );
    });
  });
}

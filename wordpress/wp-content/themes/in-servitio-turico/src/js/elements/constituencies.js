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
      e.preventDefault();
      let slug = constituency.getAttribute("data-ist-constituency-slug");
      slug = slug.replace("_", "");
      // if (slug.startsWith("zuerich")) {
      //   let kreisNum = slug.split("-")[1].replace("_", "");
      //   let slug = "zuerich-" + kreisNum;
      // }
      let url = "/bezirk/" + slug;
      window.location.href = url;
    });
  });
}

if (document.querySelector(".ist-kandi")) {
  document.querySelectorAll(".ist-kandi").forEach(function (kandi) {
    kandi.addEventListener("click", function (e) {
      let kandi = e.target.closest(".ist-kandi");
      let kandiID = kandi.getAttribute("data-kandi-id");

      if (document.querySelector(".ist-kandi.ist-kandi-open")) {
        let openKandi = document
          .querySelector(".ist-kandi.ist-kandi-open")
          .getAttribute("data-kandi-id");
        if (openKandi == kandiID) {
          toggleKandiOff(kandiID);
          setTimeout(() => {
            GridClass("off");
          }, 600);
        } else {
          toggleKandiOff(openKandi);
          setTimeout(() => {
            toggleKandiOn(kandiID);
          }, 600);
        }
      } else {
        toggleKandiOn(kandiID);
        GridClass("on");
      }
    });
  });
}

function toggleKandiOn(kandiID) {
  let kandi = document.querySelector(
    ".ist-kandi[data-kandi-id='" + kandiID + "']"
  );
  history.pushState(
    {},
    null,
    "/kandi/" + kandi.getAttribute("data-kandi-slug")
  );
  kandi.classList.add("ist-kandi-open");
  let kandiArrow = kandi.querySelector(".ist-kandi-arrow");
  kandiArrow.style.maxHeight = "2rem";
  let kandiDetailsWrapper = kandi.querySelector(".ist-kandi-details-wrapper");
  let kandiDetailsOuter = kandi.querySelector(".ist-kandi-details-outer");
  kandiDetailsWrapper.style.maxHeight = kandiDetailsOuter.offsetHeight + "px";
  setTimeout(() => {
    kandiDetailsWrapper.style.maxHeight = "unset";
    kandi.scrollIntoView({ behavior: "smooth" });
  }, 500);
}

function toggleKandiOff(kandiID) {
  let kandi = document.querySelector(
    ".ist-kandi[data-kandi-id='" + kandiID + "']"
  );
  let bezirk = document
    .querySelector(".ist-kandigrid-inner")
    .getAttribute("data-bezirk");
  history.pushState({}, null, "/bezirk/" + bezirk);
  let kandiArrow = kandi.querySelector(".ist-kandi-arrow");
  kandiArrow.style.maxHeight = "0rem";
  let kandiDetailsWrapper = kandi.querySelector(".ist-kandi-details-wrapper");
  let kandiDetailsOuter = kandi.querySelector(".ist-kandi-details-outer");
  kandiDetailsWrapper.style.maxHeight = kandiDetailsOuter.offsetHeight + "px";
  setTimeout(() => {
    kandiDetailsWrapper.style.maxHeight = "0px";
    setTimeout(() => {
      kandi.classList.remove("ist-kandi-open");
    }, 500);
  }, 100);
}

function GridClass(type) {
  let grid = document.querySelector(".ist-kandigrid-inner");

  if (type == "on") {
    grid.classList.add("ist-kandigrid-inner-open");
  } else {
    grid.classList.remove("ist-kandigrid-inner-open");
  }
}

window.addEventListener("DOMContentLoaded", function () {
  if (
    document.querySelector(".ist-kandi") &&
    window.location.href.includes("##kandi")
  ) {
    const slug = window.location.href.split("##kandi=")[1];
    const kandi = document
      .querySelector(`.ist-kandi[data-kandi-slug=${slug}]`)
      .getAttribute("data-kandi-id");
    toggleKandiOn(kandi);
    GridClass("on");
  }
});

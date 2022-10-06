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
          GridClass("off");
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
  let kandiDetailsWrapper = kandi.querySelector(".ist-kandi-details-wrapper");
  let kandiDetailsOuter = kandi.querySelector(".ist-kandi-details-outer");
  kandi.classList.add("ist-kandi-open");
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
  let kandiDetailsWrapper = kandi.querySelector(".ist-kandi-details-wrapper");
  let kandiDetailsOuter = kandi.querySelector(".ist-kandi-details-outer");
  kandi.classList.remove("ist-kandi-open");
  kandiDetailsWrapper.style.maxHeight = kandiDetailsOuter.offsetHeight + "px";
  setTimeout(() => {
    kandiDetailsWrapper.style.maxHeight = "0px";
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

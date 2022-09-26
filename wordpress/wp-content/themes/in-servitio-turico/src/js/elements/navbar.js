if (document.querySelector(".ist-nav-mobilemenu-tofuburger")) {
  document
    .querySelector(".ist-nav-mobilemenu-tofuburger")
    .addEventListener("click", function () {
      document
        .querySelector(".ist-nav-outer")
        .classList.toggle("ist-nav-mobilemenu-open");
    });
}

let prevScroll = window.scrollY;
if (document.querySelector(".ist-nav-wrapper")) {
  document.addEventListener("scroll", function () {
    if (window.scrollY > 100) {
      document.querySelector(".ist-nav-wrapper").classList.add("bg-spred");
    }
    if (window.scrollY < 100) {
      document.querySelector(".ist-nav-wrapper").classList.remove("bg-spred");
    }
    if (window.scrollY > prevScroll) {
      document.querySelector(".ist-nav-wrapper").classList.add("scrollup");
    }
    if (window.scrollY < prevScroll) {
      document.querySelector(".ist-nav-wrapper").classList.remove("scrollup");
    }
    prevScroll = window.scrollY;
  });
}

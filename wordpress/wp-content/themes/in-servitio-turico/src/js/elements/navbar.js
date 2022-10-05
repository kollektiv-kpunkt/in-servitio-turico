if (document.querySelector(".ist-nav-mobilemenu-tofuburger")) {
  document
    .querySelector(".ist-nav-mobilemenu-tofuburger")
    .addEventListener("click", function () {
      document.documentElement.classList.toggle("noscroll");
      document
        .querySelector(".ist-nav-outer")
        .classList.toggle("ist-nav-mobilemenu-open");
      if (
        document
          .querySelector(".ist-nav-outer")
          .classList.contains("ist-nav-mobilemenu-open")
      ) {
        document.querySelector(".ist-nav-wrapper").classList.add("bg-spred");
      } else {
        if (window.scrollY < 100) {
          if (
            !document
              .querySelector(".ist-nav-wrapper")
              .classList.contains("bg-nogradient")
          ) {
            document
              .querySelector(".ist-nav-wrapper")
              .classList.remove("bg-spred");
          }
        }
      }
    });
}

let prevScroll = window.scrollY;
if (document.querySelector(".ist-nav-wrapper")) {
  document.addEventListener("scroll", function () {
    var menuWrapper = document.querySelector(".ist-nav-wrapper");
    if (window.scrollY > 100) {
      menuWrapper.classList.add("bg-spred");
    }
    if (window.scrollY < 100) {
      if (!menuWrapper.classList.contains("bg-nogradient")) {
        menuWrapper.classList.remove("bg-spred");
      }
    }
    if (window.scrollY > prevScroll) {
      menuWrapper.classList.add("scrollup");
    }
    if (window.scrollY < prevScroll) {
      menuWrapper.classList.remove("scrollup");
    }
    prevScroll = window.scrollY;
  });
}

if (document.querySelector(".ist-nav-mobilemenu-tofuburger")) {
    document.querySelector(".ist-nav-mobilemenu-tofuburger").addEventListener("click", function() {
        document
          .querySelector(".ist-nav-outer")
          .classList.toggle("ist-nav-mobilemenu-open");
    });
}
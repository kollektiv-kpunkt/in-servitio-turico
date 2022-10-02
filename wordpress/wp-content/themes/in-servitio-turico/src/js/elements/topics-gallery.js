if (document.querySelector(".ist-gallery-more-button")) {
  document
    .querySelector(".ist-gallery-more-button")
    .addEventListener("click", function (e) {
      let button = document.querySelector(".ist-gallery-more-button");
      let galleryWrapper = button.closest(".ist-topics-gallery-wrapper");
      let galleryContainer = galleryWrapper.querySelector(
        ".ist-topics-gallery-container"
      );
      let gallery = galleryWrapper.querySelector(".ist-topics-gallery");
      galleryContainer.style.paddingBottom = gallery.offsetHeight + "px";
      setTimeout(() => {
        galleryContainer.style["-webkit-mask-image"] = "none";
        button.remove();
      }, 250);

      setTimeout(() => {
        galleryContainer.style.paddingBottom = "0px";
        gallery.style.position = "unset";
      }, 500);
    });
}

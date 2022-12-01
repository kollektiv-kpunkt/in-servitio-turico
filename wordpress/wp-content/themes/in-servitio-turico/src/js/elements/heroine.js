if (document.querySelector('[data-block-name="acf/heroine"]')) {
  var swiper = swiperFunction();

  document
    .querySelectorAll(".ist-fp-slide .ist-fp-slide-preview a")
    .forEach((slide) => {
      slide.addEventListener("click", (e) => {
        e.preventDefault();
        console.log("clicked");
        clearInterval(swiper);

        let elements = getElementsBySlug(
          slide.closest("[data-slide-slug]").getAttribute("data-slide-slug")
        );
        swiper = swiperFunction(elements);
      });
    });
  document.querySelectorAll(".ist-fp-mobile-preview img").forEach((slide) => {
    slide.addEventListener("click", (e) => {
      e.preventDefault();
      console.log("clicked");
      clearInterval(swiper);

      let elements = getElementsBySlug(
        slide.closest("[data-slide-slug]").getAttribute("data-slide-slug")
      );
      swiper = swiperFunction(elements);
    });
  });
}

function swiperFunction(nodelist = []) {
  let nextSlide;
  let nextSlideMobile;
  if (typeof nodelist[0] !== "undefined") {
    nextSlide = nodelist[0];
    nextSlideMobile = nodelist[1];
    nodelist = [];
    changeSlide(nextSlide, nextSlideMobile);
  }
  let interval = setInterval(() => {
    console.log("no nodelist");
    let hero = document.querySelector('[data-block-name="acf/heroine"]');
    let deskSlides = hero.querySelectorAll(".ist-fp-slides .ist-fp-slide");
    let mobileSlides = hero.querySelectorAll(
      ".ist-fp-slides-mobile .ist-fp-mobile-slide"
    );
    nextSlide = deskSlides[0];
    nextSlideMobile = mobileSlides[0];
    changeSlide(nextSlide, nextSlideMobile);
  }, 7000);
  return interval;
}

function changeSlide(nextSlide, nextSlideMobile) {
  console.log("change slide");
  let heroine = document.querySelector('[data-block-name="acf/heroine"]');
  heroine.classList.add("ist-fp-slide-change");
  var slideContent = JSON.parse(
    window.atob(nextSlide.getAttribute("data-slide-content"))
  );

  setTimeout(() => {
    document.querySelector(".ist-fp-featured-topic-title").innerHTML =
      slideContent.title;
    document.querySelector(".ist-fp-featured-topic-slogan").innerHTML =
      slideContent.slogan;
    document.querySelector(".ist-fp-featured-topic-link").href =
      slideContent.link;
    var featuredImg = document.querySelector(".ist-fp-featured-topic-img img");
    featuredImg.src = slideContent.thumbnail.src;
    featuredImg.alt = slideContent.thumbnail.alt;
    featuredImg.srcset = slideContent.thumbnail.srcset;
  }, 550);

  var slideCopy = nextSlide.cloneNode(true);
  slideCopy = addClickEventListener(slideCopy, "desk");
  nextSlide.querySelector(".ist-fp-slide-preview").style.paddingBottom = "0";

  var slideCopyMobile = nextSlideMobile.cloneNode(true);
  slideCopyMobile = addClickEventListener(slideCopyMobile, "mobile");
  nextSlideMobile.style.width = 0;

  setTimeout(() => {
    nextSlide.remove();
    document.querySelector(".ist-fp-slides").appendChild(slideCopy);
    document
      .querySelector(".ist-fp-slides-mobile")
      .appendChild(slideCopyMobile);
    nextSlideMobile.remove();
  }, 500);

  setTimeout(() => {
    heroine.classList.remove("ist-fp-slide-change");
  }, 600);
}

function getElementsBySlug(slug) {
  var elements = document.querySelectorAll('[data-slide-slug="' + slug + '"]');
  return elements;
}

function addClickEventListener(element, type) {
  if (type === "desk") {
    element.querySelector("a").addEventListener("click", (e) => {
      e.preventDefault();
      console.log("clicked");
      clearInterval(swiper);

      let elements = getElementsBySlug(
        element.closest("[data-slide-slug]").getAttribute("data-slide-slug")
      );
      swiper = swiperFunction(elements);
    });
  } else {
    element.querySelector("img").addEventListener("click", (e) => {
      e.preventDefault();
      console.log("clicked");
      clearInterval(swiper);

      let elements = getElementsBySlug(
        element.closest("[data-slide-slug]").getAttribute("data-slide-slug")
      );
      swiper = swiperFunction(elements);
    });
  }
  return element;
}

if (document.querySelector(".wp-block-spacer")) {
  let spacers = document.querySelectorAll(".wp-block-spacer");
  spacers.forEach((spacer) => {
    let emHeight = parseInt(spacer.style.height) / 18;
    spacer.style.height = emHeight + "em";
  });
}

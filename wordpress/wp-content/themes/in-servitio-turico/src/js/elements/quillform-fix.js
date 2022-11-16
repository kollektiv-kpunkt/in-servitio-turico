
const container = document.querySelector('div#ist-quillform');
container.style = "padding-bottom: 0; transition: padding-bottom 0.5s ease-in-out; position: relative;";
const iFrame = container.querySelector('iframe');
iFrame.style = "position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;";
let wrapper;
let fieldWrapper;
let fieldScroller;
let fieldContent;


const mutationObserver = new MutationObserver((mutations) => {
  mutations.forEach((mutation) => {
    console.log(mutation);
    if (mutation.attributeName == "class") {

      if (!mutation.target.classList.contains('is-moving-down') && mutation.target.classList.contains('active')) {
        fieldWrapper = iFrame.contentDocument.querySelector('div.renderer-components-field-wrapper.active');
        scroller = fieldWrapper.querySelector('div.renderer-core-block-scroller');
        content = fieldWrapper.querySelector('div.renderer-components-field-content');
        let height = content.offsetHeight;
        let padding = parseInt(window.getComputedStyle(scroller).paddingBottom) + parseInt(window.getComputedStyle(scroller).paddingTop);
        let offset = height + padding + 20;
        container.style.paddingBottom = offset + 'px';
        let isFirst = false;
        if (fieldWrapper.previousElementSibling == null) {
          isFirst = true;
        }
        if (!isFirst) {
          setTimeout(() => {
            iFrame.scrollIntoView(false, {
              behavior: 'smooth',
              block: "center",
            });
          }, 600);
        }
      }
    }
  });
});


let quillformDetector = setInterval(() => {
  if (iFrame.contentWindow.document.querySelector('div.renderer-core-fields-wrapper')) {
    wrapper = iFrame.contentWindow.document.querySelector('div.renderer-core-fields-wrapper');
    mutationObserver.observe(wrapper, { attributes: true, childList: false, subtree: false });
    console.log(wrapper);
    clearInterval(quillformDetector);
  } else {
    return;
  }
}, 200);
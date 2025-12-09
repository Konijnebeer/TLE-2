window.addEventListener('load', init);

let nextBtn;
let inputField;

function init() {
    nextBtn = document.querySelector("button");
    inputField = document.querySelector("textarea");

    nextBtn.disabled = true;
    inputField.addEventListener('input', checkInput);
}

function checkInput(e) {
    e.preventDefault();

    if (inputField.value.length >= 3) {
        nextBtn.disabled = false;
    } else {
        nextBtn.disabled = true;
    }
}

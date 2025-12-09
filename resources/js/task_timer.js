window.addEventListener('load', init);

let nextBtn;
let countdown;

function init() {
    nextBtn = document.querySelector("button");
    countdown = nextBtn.parentElement.dataset["condition"];

    nextBtn.disabled = true;

    timer();
}

function timer() {
    let time = parseInt(countdown, 10);

    const interval = setInterval(() => {
        if (time > 1) {
            time--;
            nextBtn.textContent = `Volgende (${time}s)`;
        } else {
            clearInterval(interval);
            nextBtn.disabled = false;
            nextBtn.innerHTML = "Volgende <i class=\"fa-solid fa-arrow-right pl-2\"></i>";
        }
    }, 1000);
}

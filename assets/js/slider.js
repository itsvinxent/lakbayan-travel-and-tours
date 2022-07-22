// Automatic Page Movement
// var counter = 1;
// setInterval(function () {
//     document.getElementById('btn' + counter).checked = true;
//     counter++;
//     if (counter > 3) {
//         counter = 1;
//     }
// }, 5000);

var count = 1;
document.getElementById('btn' + count).checked = true;

document.getElementById("next-btn").onclick = function () { nextFunction() };
document.getElementById("prev-btn").onclick = function () { prevFunction() };

function nextFunction() {
    if (count > 2) {
        count = 1;
    } else {
        count++;
    }
    document.getElementById('btn' + count).checked = true;
}

function prevFunction() {
    if (count == 1) {
        count = 3
    } else {
        count--;
    }
    document.getElementById('btn' + count).checked = true;
}

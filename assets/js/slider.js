// Automatic Page Movement
// var counter = 1;
// setInterval(function () {
//     document.getElementById('btn' + counter).checked = true;
//     counter++;
//     if (counter > 3) {
//         counter = 1;
//     }
// }, 5000);

function nextFunction(imgCount) {
    if (count >= imgCount) {
        count = 1;
    } else {
        count++;
    }
    document.getElementById('btn' + count).checked = true;
}

function prevFunction(imgCount) {
    if (count == 1) {
        count = imgCount;
    } else {
        count--;
    }
    document.getElementById('btn' + count).checked = true;
}

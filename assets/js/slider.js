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

function nextFunction(imgCount) {
    if (count >= imgCount) {
        count = 1;
    } else {
        count++;
    }
    console.log(count, imgCount)
    document.getElementById('btn' + count).checked = true;
}

function prevFunction(imgCount) {
    if (count == 1) {
        count = imgCount;
    } else {
        count--;
    }
    console.log(count, imgCount)
    document.getElementById('btn' + count).checked = true;
}

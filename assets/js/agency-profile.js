const tabs = document.querySelectorAll('[data-tab-target]')
// const tabContents = document.querySelectorAll('[data-tab-content]')
const tabContents = document.querySelectorAll('.data-tab-content')
const saveChBtn = document.getElementById('save-ch-btn');
var editcount = 0;

tabs.forEach(tab => {
    const target = document.querySelector(tab.dataset.tabTarget);
    var reset = document.querySelectorAll('.resetting');
    var selector = null;
    if (tab == document.getElementById('package-create') || tab == document.querySelector('.pack-edit-btn')) {
        tab == document.getElementById('package-create') ? selector = '#package-create' : selector = '.pack-edit-btn';
        tab = document.getElementById('full-table');
    } 
    $(tab).on('click', selector, () => {
        tabContents.forEach(tabContent => {
            tabContent.classList.remove('active')
        })
        tabs.forEach(tab => {
            tab.classList.remove('active')
        })
        tab.classList.add('active')
        target.classList.add('active')

        if (tab == document.getElementById('pack-active') || 
        tab == document.getElementById('sub-pack-active') ||
        tab == document.getElementById('sub-book-active')) {
            document.getElementById('tab-content').classList.add('pack-active')
        } else {
            document.getElementById('tab-content').classList.remove('pack-active')
        }
        if (tab != document.getElementById('acc-active')) {
            saveChBtn.style.display = "none";
        } else {
            checkeditcount();
        }
    });
});


const editBtn = document.querySelectorAll('.col-edit');
var previousValue;
var currValue;

function resetElements() {
    editBtn.forEach(edits => {
        const editF = edits.previousElementSibling;
        const saveB = edits.nextElementSibling;
        editF.previousElementSibling.classList.add('active');
        editF.classList.remove('active');
        edits.classList.add('active');
        saveB.classList.remove('active');
        previousValue = "";
        currValue = "";
    })
}

// For displaying the correct button (Edit or Save)
editBtn.forEach(edit => {
    edit.addEventListener('click', () => {
        resetElements();
        const editField = edit.previousElementSibling;
        const saveBtn = edit.nextElementSibling;
        if (editField.previousElementSibling.childNodes[1] != undefined) {
            previousValue = editField.previousElementSibling.childNodes[1].innerHTML;
        } else {
            previousValue = editField.previousElementSibling.childNodes[0].innerHTML;   
        }
        editField.previousElementSibling.classList.remove('active');
        if (editField.childNodes[1] === document.getElementById('bday')) {
            flatpickr("#bday", {
                dateFormat: "M-d-Y",
                defaultDate: previousValue
            });
        } else {
            editField.childNodes[1].value = previousValue;
        }
        editField.classList.add('active');

        edit.classList.remove('active');
        saveBtn.classList.add('active');
    })
})

const saveBtn = document.querySelectorAll('.col-save');

function checkeditcount() {
    if (editcount > 0) {
        saveChBtn.style.display = "block";
    } else {
        saveChBtn.style.display = "none";
    }
}

saveBtn.forEach(save => {
    save.addEventListener('click', () => {
        const editBtn = save.previousElementSibling;
        const editField = editBtn.previousElementSibling;
        const valueCell = editField.previousElementSibling;
        currValue = editField.childNodes[1].value;

        save.classList.remove('active');
        editBtn.classList.add('active');
        editField.classList.remove('active');
        valueCell.classList.add('active');
        if(valueCell.childNodes[1] != undefined) {
            valueCell.childNodes[1].innerHTML = currValue;
        } else {
            valueCell.childNodes[0].innerHTML = currValue;
        }


        if (currValue.length === 0) {
            alert("ERROR. Empty Field");
            if(valueCell.childNodes[1] != undefined) {
                valueCell.childNodes[1].innerHTML = previousValue;
            } else {
                valueCell.childNodes[0].innerHTML = previousValue;
            }
        } else if (editField.children[1].value != currValue) {
            editcount++;
        } else {      
            editcount === 0 ? editcount = 0 : editcount--;
        }

        checkeditcount();
    })
})


const editDescBtn = document.getElementById('edit-desc-btn');
const saveDescBtn = document.getElementById('save-desc-btn');
const descBody = document.getElementById('desc-body');
const descEdit = document.getElementById('desc-textarea');
if (editDescBtn != undefined) {
    editDescBtn.addEventListener('click', () => {
        descBody.classList.remove('active');
        descEdit.classList.add('active');
        descEdit.innerHTML = descEdit.nextElementSibling.value;
        editDescBtn.classList.remove('active');
        saveDescBtn.classList.add('active');
    });
}
if (saveDescBtn != undefined) {
    saveDescBtn.addEventListener('click', () => {
        descBody.classList.add('active');
        descEdit.classList.remove('active');
        currValue = descEdit.value;
        descBody.innerHTML = currValue;
        editDescBtn.classList.add('active');
        saveDescBtn.classList.remove('active');

        if (currValue.length === 0) {
            alert("ERROR. Empty Field");
            descBody.innerHTML = descEdit.nextElementSibling.value;
            descEdit.value = descEdit.nextElementSibling.value;
        } else if (descEdit.nextElementSibling.value != currValue) {
            editcount++;   
        } else {      
            editcount === 0 ? editcount = 0 : editcount--;
        }

        checkeditcount();
    });
}

// Image Upload Preview
$('#aPicture').on('change', function(e) {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(event) {
            $('#img-pic').attr('src', event.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        $('#picturefile').val(e.target.value.split('\\').pop());
        editcount++;
        checkeditcount();
    }
});

$('#aBanner').on('change', function(e) {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(event) {
            $('#img-banner').attr('src', event.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        // $('#bannerfile').val(e.target.value.split('\\').pop());
        editcount++;
        checkeditcount();
    }
});

// Reset Form My Account Form
$(document.querySelector('.discardform-btn')).on('click', function(e) {
    var rows = document.querySelectorAll('#info .row');

    rows.forEach(row => {
        console.log(row.children[1].children[0].innerHTML)

        // if (row.children[1].children[1] === undefined) {
            row.children[1].children[0].innerHTML = row.children[2].children[1].value;
        // } else {
        //     row.children[1].children[1].innerHTML = row.children[2].children[1].value;
        // }

    });
    editcount = 0;
    checkeditcount();

});


// Calendars
var durations = [], duration = [], dates = [];
var cutoff, cutoffObj;

var displayCal = $('#date-display').flatpickr({
    monthSelectorType: "static",
    yearSelectorType: "static",
    dateFormat: "D, M d Y h:i K",
    mode: "multiple",
    inline: true
});

var schedCal = $("#tourduration").flatpickr({
    altInput: true,
    altFormat: "D, F j, Y h:i K",
    dateFormat: "M-d-Y H:i:S",
    minDate: "today",
    mode: "range",
    enableTime: true,
    onChange: function (selectedDates, dateStr, instance) {
        $('.right .flatpickr-innerContainer').css("pointer-events", "all");
        dates.length = 0;
        durations.length = 0;
        dates.push(cutoff);
        selectedDates.forEach(element => {
            dates.push(element);
            durations.push(element);
        });
        displayCal.setDate(dates.reverse(), "M-d-Y H:i:S");

        if (duration.length === 2) {
            duration.length = 0;
        }
        duration.push(instance.selectedDateElem.innerHTML);

        // var listDate = [];
        var starting;
        if (dates[0] < dates[1]) {
            starting = dates[0];
        } else {
            starting = dates[1];
        }
        // let loop = new Date(starting);
        // listDate.push(starting);

        // while (loop < ending) {
        //     listDate.push(loop);
        //     let newDate = loop.setDate(loop.getDate() + 1);
        //     loop = new Date(newDate);
        // }
        cutoffCal.set('maxDate', starting);

        $('.right .flatpickr-innerContainer .selected').each(function () {
            if (duration.includes($(this)[0].innerHTML)) {
                $(this).addClass("duration");
            }
            if (cutoffObj === $(this)[0].innerHTML) {
                $(this).addClass("cutoff");
            }
        });
        $('.right .flatpickr-innerContainer').css("pointer-events", "none");
    }
});

var cutoffCal = $("#cutdate").flatpickr({
    altInput: true,
    altFormat: "D, F j, Y h:i K",
    dateFormat: "M-d-Y H:i:S",
    minDate: "today",
    enableTime: true,
    mode: "single",
    onChange: function (selectedDates, dateStr, instance) {
        $('.right .flatpickr-innerContainer').css("pointer-events", "all");
        dates.length = 0;
        cutoff = selectedDates[0];
        durations.forEach(element => {
            dates.push(element);
        });
        dates.push(cutoff);
        displayCal.setDate(dates.reverse(), "M-d-Y H:i:S");
        cutoffObj = instance.selectedDateElem.innerHTML;

        let cutDisable = new Date(cutoff);
        console.log(typeof(cutDisable));
        schedCal.set('disable', [cutDisable]);

        $('.right .flatpickr-innerContainer .selected').each(function () {
            if (duration.includes($(this)[0].innerHTML)) {
                $(this).addClass("duration");
            }
            if (cutoffObj === $(this)[0].innerHTML) {
                $(this).addClass("cutoff");
            }
        });
        $('.right .flatpickr-innerContainer').css("pointer-events", "none");
    }
});

$(document).ready(function() {
    $('.right .flatpickr-innerContainer').css("pointer-events", "none");
});


// File Upload Labels
var inputs = document.querySelectorAll('.inputfile');
Array.prototype.forEach.call(inputs, function (input) {
    

    input.addEventListener('change', function (e) {
        // label.style.display = none;
        // input.style.display = block;
        var label = input.nextElementSibling.nextElementSibling.nextElementSibling,
        labelVal = label.nextElementSibling.value;
        console.log("detected");
        var fileName = e.target.value.split('\\').pop();
        if (fileName) {
            label.innerHTML = fileName;
            // console.log(input.nextElementSibling)
            // console.log(input.nextElementSibling.children[1])
            input.nextElementSibling.style.display = "none";
            input.nextElementSibling.nextElementSibling.style.display = "flex";
        }
        else
            label.innerHTML = labelVal;
    });
});

var removeupload = document.querySelectorAll('.uploaded');
removeupload.forEach(remover => {
    $(remover).click(function (e) { 
        removeuploadimg(this);
    });
})

function removeuploadimg(removebtn) {
    var target = removebtn.previousElementSibling.previousElementSibling;
    $(target).val('');
    removebtn.previousElementSibling.style.display = "flex"
    removebtn.nextElementSibling.innerHTML = removebtn.nextElementSibling.nextElementSibling.value;
    removebtn.style.display = "none";
}